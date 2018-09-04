<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserSARequest;
use App\Http\Requests\EditUserSARequest;
use App\Http\Requests\CreateUserADRequest;
use App\Http\Requests\EditUserADRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use App\Option;
use App\Watchdog;
use App\Usermeta;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');

        $this->pagination = Option::where('name', 'items_per_page')->first();

        $countryjson = 'https://cdn.rawgit.com/umpirsky/country-list/master/data/es_CO/country.json';
        $json = file_get_contents($countryjson);
        $this->countries = json_decode($json, TRUE);

        $this->middleware(['role:superadmin'])->only([
            'indexSuperAdmin',
            'createSuperAdmin',
            'storeSuperAdmin',
            'showSuperAdmin',
            'editSuperAdmin',
            'updateSuperAdmin',
            'destroySuperAdmin',
            'massChangesSuperAdmin',
        ]);
        $this->middleware(['role:superadmin|administrative'])->only([
            'indexAdministrative',
            'createAdministrative',
            'storeAdministrative',
            'showAdministrative',
            'editAdministrative',
            'updateAdministrative',
            'destroyAdministrative',
            'massChangesAdministrative',
            'createCoordinator',
            'storeCoordinator',
            'showCoordinator',
            'editCoordinator',
            'updateCoordinator',
            'destroyCoordinator',
            'massChangesCoordinator',
            'createTeacher',
            'storeTeacher',
            'editTeacher',
            'updateTeacher',
            'destroyTeacher',
            'massChangesTeacher',
            'createStudent',
            'storeStudent',
            'editStudent',
            'updateStudent',
            'destroyStudent',
            'massChangesStudent',
            'createParent',
            'storeParent',
            'editParent',
            'updateParent',
            'destroyParent',
            'massChangesParent',
            
        ]);
        $this->middleware(['role:superadmin|administrative|coordinator'])->only([
            'indexCoordinator',
            'showTeacher',
        ]);
        $this->middleware(['role:superadmin|administrative|coordinator|teacher'])->only([
            'index',
            'indexTeacher',
            'indexStudent',
            'indexParent',
            'showStudent',
            'showParent',
        ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.users.index');
    }

    public function indexSuperAdmin(Request $request)
    {
        $users = User::role('superadmin')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
                    }])->searchByName($request->name)->orderBy('users.id','DESC')->paginate($this->pagination->value);
                    //dd($users);
        return view('layouts.users.sa.index')
            ->with('users',$users);
    }

    public function massChangesSuperAdmin(Request $request)
    {
        if(isset($request->users)){
            $usersids = $request->users;
            //dd($usersids);
            if($request->status != ""){
                foreach ($usersids as $userid) {
                    if($userid != "1"){
                        $user = User::find(intval($userid));
                        $user->status = $request->status;
                        $watchdog = new Watchdog();
                        $watchdog->user_id = Auth::id();
                        $watchdog->type = 'edit_user';
                        $watchdog->text = 'Se ha actualizado al usuario '.$user->first_name.' '.$user->last_name.' con el Estado: '.$request->status ;
                        $watchdog->ip = $request->ip();
                        $watchdog->save();
                        $user->save();
                    }else{
                        Flash::error('No tienes los permisos suficientes para actualizar el estado de este usuario');
                        return redirect()->route('users.sa.index');
                    }
                }
                Flash::success('Se ha actualizado el estado de los usuarios seleccionados');
                return redirect()->route('users.sa.index');
            }elseif($request->action != ""){
                if($request->action == 'delete'){
                    foreach ($usersids as $userid) {
                        if($userid != "1"){
                            $user = User::find(intval($userid));
                            $watchdog = new Watchdog();
                            $watchdog->user_id = Auth::id();
                            $watchdog->type = 'delete_user';
                            $watchdog->text = 'Se ha eliminado al usuario '.$user->first_name.' '.$user->last_name;
                            $watchdog->ip = $request->ip();
                            $watchdog->save();
                            $user->delete();
                        }else{
                            Flash::error('No tienes los permisos suficientes para eliminar este usuario');
                            Flash::important();
                            return redirect()->route('users.sa.index');
                        }
                    }
                    Flash::success('Se han eliminado los usuarios seleccionados');
                    return redirect()->route('users.sa.index');
                }
            }
        }else {
            Flash::error('Debes seleccionar al menos un usuario para realizar esta acción');
            return redirect()->route('users.sa.index');
        }
        return redirect()->route('users.sa.index');
    }

    public function createSuperAdmin()
    {
        return view('layouts.users.sa.add')
            ->with('countries', $this->countries);
    }

    public function storeSuperAdmin(CreateUserSARequest $request)
    {
        $user = new User();
        $user->it = $request->it;
        $user->nid = $request->nid;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->cellphone_number = $request->cellphone_number;
        $user->nacionality = $request->nacionality;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->last_access = date('Y-m-d H:i:s');
        if($request->file('photo')){
            $file = $request->file('photo');
            $name=basename($file->getClientOriginalName(),'.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            /*Storage::put(
                'public/images/photos/'.$imgname,
                file_get_contents($request->file('photo')->getRealPath())
            );*/
            Image::make($request->file('photo')->getRealPath())->fit(200, 266)->save('storage/images/photos/'.$imgname);
            $user->photo = 'storage/images/photos/'.$imgname;
        }
        $user->save();

        $user->assignRole('superadmin');

        $display_name = $user->first_name . ' '. $user->last_name;
        $display_name = explode(" ",$display_name);
        $countnames = count($display_name);
        if($countnames == 1){
            $display_name = $display_name[0];
        }elseif($countnames == 2){
            $display_name = $display_name[0].' '.$display_name[1];
        }elseif($countnames == 3 || $countnames == 4){
            $display_name = $display_name[0].' '.$display_name[2];
        }

        $displayname = new Usermeta();
        $displayname->user_id = $user->id;
        $displayname->name = 'display_name';
        $displayname->value = $display_name;
        $displayname->save();

        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'add_user';
        $watchdog->text = 'Se ha añadido el usuario '.$user->first_name.' '.$user->last_name.'.';
        $watchdog->ip = $request->ip();
        $watchdog->save();

        Flash::success('Se ha añadido el usuario '.$user->first_name.' '.$user->last_name.'.');
        return redirect()->route('users.sa.index');
    }

    public function showSuperAdmin($id)
    {
        if($id != "1"/* || Auth::id() == 1*/){
            $user = User::with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
                    }])->find($id);
            return view('layouts.users.sa.show')
            ->with('user', $user)
            ->with('countries', $this->countries);
        }else {
            Flash::error('No tienes los permisos suficientes para ver esta información.');
            return redirect()->route('users.sa.index');
        }
    }

    public function editSuperAdmin($id)
    {
        if($id != "1"){
            $user = User::with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
                    }])->find($id);
            return view('layouts.users.sa.edit')
            ->with('user', $user)
            ->with('countries', $this->countries);
        }else {
            Flash::error('No tienes los permisos suficientes para editar a este usuario.');
            return redirect()->route('users.sa.index');
        }
    }

    public function updateSuperAdmin(EditUserSARequest $request, $id)
    {
        $user = User::find($id);
        $user->it = $request->it;
        $user->nid = $request->nid;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->cellphone_number = $request->cellphone_number;
        $user->nacionality = $request->nacionality;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->last_access = date('Y-m-d H:i:s');
        if($request->file('photo')){
            $file = $request->file('photo');
            $name=basename($file->getClientOriginalName(),'.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            /*Storage::put(
                'public/images/photos/'.$imgname,
                file_get_contents($request->file('photo')->getRealPath())
            );*/
            Image::make($request->file('photo')->getRealPath())->fit(200, 266)->save('storage/images/photos/'.$imgname);
            $user->photo = 'storage/images/photos/'.$imgname;
        }
        $user->save();

        $display_name = $user->first_name . ' '. $user->last_name;
        $display_name = explode(" ",$display_name);
        $countnames = count($display_name);
        if($countnames == 1){
            $display_name = $display_name[0];
        }elseif($countnames == 2){
            $display_name = $display_name[0].' '.$display_name[1];
        }elseif($countnames == 3 || $countnames == 4){
            $display_name = $display_name[0].' '.$display_name[2];
        }

        $displayname = Usermeta::where('user_id', $user->id)->where('name', 'display_name')->first();
        $displayname->value = $display_name;
        $displayname->save();

        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'edit_user';
        $watchdog->text = 'Se ha actualizado el usuario '.$user->first_name.' '.$user->last_name.'.';
        $watchdog->ip = $request->ip();
        $watchdog->save();

        Flash::success('Se ha actualizado el usuario '.$user->first_name.' '.$user->last_name.'.');
        return redirect()->route('users.sa.show', $user->id);
    }

    public function destroySuperAdmin($id)
    {
        $user = User::find($id);
        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'delete_user';
        $watchdog->text = 'Se ha eliminado al usuario '.$user->first_name.' '.$user->last_name;
        Flash::success('Se ha eliminado al usuario '.$user->first_name.' '.$user->last_name);
        $watchdog->ip = \Request::ip();
        $watchdog->save();
        $user->delete();
        return redirect()->route('users.sa.index');
    }

    public function indexAdministrative(Request $request)
    {
        $users = User::role('administrative')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
                    }])->searchByName($request->name)->orderBy('users.id','DESC')->paginate($this->pagination->value);
        return view('layouts.users.ad.index')
            ->with('users',$users);
    }
    public function massChangesAdministrative(Request $request)
    {
        if(isset($request->users)){
            $usersids = $request->users;
            if($request->status != ""){
                foreach ($usersids as $userid) {
                    $user = User::find(intval($userid));
                    $user->status = $request->status;
                    $watchdog = new Watchdog();
                    $watchdog->user_id = Auth::id();
                    $watchdog->type = 'edit_user';
                    $watchdog->text = 'Se ha actualizado al usuario '.$user->first_name.' '.$user->last_name.' con el Estado: '.$request->status ;
                    $watchdog->ip = $request->ip();
                    $watchdog->save();
                    $user->save();
                }
                Flash::success('Se ha actualizado el estado de los usuarios seleccionados');
                return redirect()->route('users.ad.index');
            }elseif($request->action != ""){
                if($request->action == 'delete'){
                    foreach ($usersids as $userid) {
                        $user = User::find(intval($userid));
                        $watchdog = new Watchdog();
                        $watchdog->user_id = Auth::id();
                        $watchdog->type = 'delete_user';
                        $watchdog->text = 'Se ha eliminado al usuario '.$user->first_name.' '.$user->last_name;
                        $watchdog->ip = $request->ip();
                        $watchdog->save();
                        $user->delete();
                    }
                    Flash::success('Se han eliminado los usuarios seleccionados');
                    return redirect()->route('users.ad.index');
                }
            }
        }else {
            Flash::error('Debes seleccionar al menos un usuario para realizar esta acción');
            return redirect()->route('users.ad.index');
        }
        return redirect()->route('users.ad.index');
    }

    public function createAdministrative()
    {
        return view('layouts.users.ad.add')
            ->with('countries', $this->countries);
    }

    public function storeAdministrative(CreateUserADRequest $request)
    {
        $user = new User();
        $user->it = $request->it;
        $user->nid = $request->nid;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->cellphone_number = $request->cellphone_number;
        $user->nacionality = $request->nacionality;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->last_access = date('Y-m-d H:i:s');
        if($request->file('photo')){
            $file = $request->file('photo');
            $name=basename($file->getClientOriginalName(),'.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            /*Storage::put(
                'public/images/photos/'.$imgname,
                file_get_contents($request->file('photo')->getRealPath())
            );*/
            Image::make($request->file('photo')->getRealPath())->fit(200, 266)->save('storage/images/photos/'.$imgname);
            $user->photo = 'storage/images/photos/'.$imgname;
        }
        $user->save();

        $user->assignRole('administrative');

        $display_name = $user->first_name . ' '. $user->last_name;
        $display_name = explode(" ",$display_name);
        $countnames = count($display_name);
        if($countnames == 1){
            $display_name = $display_name[0];
        }elseif($countnames == 2){
            $display_name = $display_name[0].' '.$display_name[1];
        }elseif($countnames == 3 || $countnames == 4){
            $display_name = $display_name[0].' '.$display_name[2];
        }

        $displayname = new Usermeta();
        $displayname->user_id = $user->id;
        $displayname->name = 'display_name';
        $displayname->value = $display_name;
        $displayname->save();

        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'add_user';
        $watchdog->text = 'Se ha añadido el usuario '.$user->first_name.' '.$user->last_name.'.';
        $watchdog->ip = $request->ip();
        $watchdog->save();

        Flash::success('Se ha añadido el usuario '.$user->first_name.' '.$user->last_name.'.');
        return redirect()->route('users.ad.index');
    }

    public function showAdministrative($id)
    {
        $user = User::with(['usermeta' => function ($query) {
                    $query->where('name', '=', 'display_name');
                }])->find($id);
        return view('layouts.users.ad.show')
        ->with('user', $user)
        ->with('countries', $this->countries);
    }

    public function editAdministrative($id)
    {
        $user = User::with(['usermeta' => function ($query) {
                    $query->where('name', '=', 'display_name');
                }])->find($id);
        return view('layouts.users.ad.edit')
        ->with('user', $user)
        ->with('countries', $this->countries);
    }

    public function updateAdministrative(EditUserADRequest $request, $id)
    {
        $user = User::find($id);
        $user->it = $request->it;
        $user->nid = $request->nid;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->cellphone_number = $request->cellphone_number;
        $user->nacionality = $request->nacionality;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->last_access = date('Y-m-d H:i:s');
        if($request->file('photo')){
            $file = $request->file('photo');
            $name=basename($file->getClientOriginalName(),'.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            Image::make($request->file('photo')->getRealPath())->fit(200, 266)->save('storage/images/photos/'.$imgname);
            $user->photo = 'storage/images/photos/'.$imgname;
        }
        $user->save();

        $display_name = $user->first_name . ' '. $user->last_name;
        $display_name = explode(" ",$display_name);
        $countnames = count($display_name);
        if($countnames == 1){
            $display_name = $display_name[0];
        }elseif($countnames == 2){
            $display_name = $display_name[0].' '.$display_name[1];
        }elseif($countnames == 3 || $countnames == 4){
            $display_name = $display_name[0].' '.$display_name[2];
        }

        $displayname = Usermeta::where('user_id', $user->id)->where('name', 'display_name')->first();
        $displayname->value = $display_name;
        $displayname->save();

        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'edit_user';
        $watchdog->text = 'Se ha actualizado el usuario '.$user->first_name.' '.$user->last_name.'.';
        $watchdog->ip = $request->ip();
        $watchdog->save();

        Flash::success('Se ha actualizado el usuario '.$user->first_name.' '.$user->last_name.'.');
        return redirect()->route('users.ad.show', $user->id);
    }

    public function destroyAdministrative($id)
    {
        $user = User::find($id);
        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'delete_user';
        $watchdog->text = 'Se ha eliminado al usuario '.$user->first_name.' '.$user->last_name;
        Flash::success('Se ha eliminado al usuario '.$user->first_name.' '.$user->last_name);
        $watchdog->ip = \Request::ip();
        $watchdog->save();
        $user->delete();
        return redirect()->route('users.ad.index');
    }

    public function indexCoordinator(Request $request)
    {
        //
    }

    public function massChangesCoordinator(Request $request)
    {
        //
    }

    public function createCoordinator()
    {
        //
    }

    public function storeCoordinator(Request $request)
    {
        //
    }

    public function showCoordinator($id)
    {
        //
    }

    public function editCoordinator($id)
    {
        //
    }

    public function updateCoordinator(Request $request, $id)
    {
        //
    }

    public function destroyCoordinator($id)
    {
        //
    }

    public function indexTeacher(Request $request)
    {
        //
    }

    public function massChangesTeacher(Request $request)
    {
        //
    }

    public function createTeacher()
    {
        //
    }

    public function storeTeacher(Request $request)
    {
        //
    }

    public function showTeacher($id)
    {
        //
    }

    public function editTeacher($id)
    {
        //
    }

    public function updateTeacher(Request $request, $id)
    {
        //
    }

    public function destroyTeacher($id)
    {
        //
    }

    public function indexStudent(Request $request)
    {
        //
    }

    public function massChangesStudent(Request $request)
    {
        //
    }

    public function createStudent()
    {
        //
    }

    public function storeStudent(Request $request)
    {
        //
    }

    public function showStudent($id)
    {
        //
    }

    public function editStudent($id)
    {
        //
    }

    public function updateStudent(Request $request, $id)
    {
        //
    }

    public function destroyStudent($id)
    {
        //
    }

    public function indexParent(Request $request)
    {
        //
    }

    public function massChangesParent(Request $request)
    {
        //
    }

    public function createParent()
    {
        //
    }

    public function storeParent(Request $request)
    {
        //
    }

    public function showParent($id)
    {
        //
    }

    public function editParent($id)
    {
        //
    }

    public function updateParent(Request $request, $id)
    {
        //
    }

    public function destroyParent($id)
    {
        //
    }
}
