<?php

namespace App\Http\Controllers;

use App\User;
use App\Option;
use App\Usermeta;
use App\Teacher;
use App\Student;
use App\Area;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\StoreTeacher;
use App\Http\Requests\EditTeacher;
use App\Http\Requests\StoreStudent;
use App\Http\Requests\EditStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('es');

        $this->pagination = Option::where('name', 'items_per_page')->firstOrFail();

        $countryjson = 'https://cdn.jsdelivr.net/gh/umpirsky/country-list/data/es_CO/country.json';
        $json = file_get_contents($countryjson);
        $this->countries = json_decode($json, true);
        $this->allowedTags = '<p><ol><ul><li><strong><em><br>';

        $this->middleware(['role:superadmin'])->only(
            [
            'indexSuperAdmin',
            'createSuperAdmin',
            'storeSuperAdmin',
            'showSuperAdmin',
            'editSuperAdmin',
            'updateSuperAdmin',
            'destroySuperAdmin',
            'massChangesSuperAdmin',
            ]
        );
        $this->middleware(['role:superadmin|administrative'])->only(
            [
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
            'createGuardian',
            'storeGuardian',
            'editGuardian',
            'updateGuardian',
            'destroyGuardian',
            'massChangesGuardian',
            ]
        );
        $this->middleware(['role:superadmin|administrative|coordinator'])->only(
            [
            'indexCoordinator',
            'showTeacher',
            ]
        );
        $this->middleware(['role:superadmin|administrative|coordinator|teacher'])->only(
            [
            'index',
            'indexTeacher',
            'indexStudent',
            'indexGuardian',
            'showStudent',
            'showGuardian',
            ]
        );
    }
    /**
     * Format the countries json in an array
     *
     * @return array Countries Array
     */
    private function countriesArray() : array
    {
        $callback = function ($key, $value) {
            return ['value'=> $key, 'label'=> $value];
        };
        return array_map($callback, array_keys($this->countries), $this->countries);
    }
    /**
     * Format the diplay name
     *
     * @param string $firstname
     * @param string $lastname
     * @return string
     */
    private function _getDisplayName(string $firstname, string $lastname): string
    {
        $display_name = $firstname . ' '. $lastname;
        $display_name = explode(" ", $display_name);
        $countnames = count($display_name);
        if ($countnames == 1) {
            $display_name = $display_name[0];
        } elseif ($countnames == 2) {
            $display_name = $display_name[0].' '.$display_name[1];
        } elseif ($countnames == 3 || $countnames == 4) {
            $display_name = $display_name[0].' '.$display_name[2];
        }
        return $display_name;
    }
    /**
     * Save an user to Database
     *
     * @param Request $request
     * @param string $rol
     * @return User
     */
    private function _storeUser($request, string $rol) : User
    {
        $user = new User();
        $user->it = $request->it;
        $user->nid = $request->nid;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        $user->password = Hash::make($request->password);
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        if ($request->filled('cellphone_number')) {
            $user->cellphone_number = $request->cellphone_number;
        }
        $user->nacionality = $request->nacionality;
        $user->location = $request->location;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->last_access = date('Y-m-d H:i:s');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name=basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            Image::make($request->file('photo')->getRealPath())->fit(200)->save('storage/images/photos/'.$imgname);
            $user->photo = $imgname;
        }
        $user->save();

        $user->assignRole($rol);
        
        $display_name = $this->_getDisplayName($user->first_name, $user->last_name);
        $displayname = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
        $user->usermeta()->save($displayname);

        return $user;
    }
    /**
     * Updates a user data
     *
     * @param Request $request
     * @param integer $id
     * @param string $rol
     * @return User
     */
    private function _updateUser($request, int $id, string $rol) : User
    {
        $user = User::role($rol)->findOrFail($id);
        if ($user->first_name != $request->first_name || $user->last_name != $request->last_name) {
            $display_name = $this->_getDisplayName($request->first_name, $request->last_name);
            $displayname = Usermeta::where('user_id', $user->id)->where('name', 'display_name')->firstOrFail();
            $displayname->value = $display_name;
            $displayname->save();
        }
        $user->it = ($user->it != $request->it) ? $request->it : $user->it;
        $user->nid = ($user->nid != $request->nid) ? $request->nid : $user->nid;
        $user->first_name = ($user->first_name != $request->first_name) ? $request->first_name : $user->first_name;
        $user->last_name = ($user->last_name != $request->last_name) ? $request->last_name : $user->last_name;
        $user->email = ($request->filled('email') && $user->email != $request->email) ? $request->email : $user->email;
        $user->password = ($request->filled('password') && $user->password != Hash::make($request->password)) ? Hash::make($request->password) : $user->password;
        $user->birth_date = ($user->birth_date != $request->birth_date) ? $request->birth_date : $user->birth_date;
        $user->gender = ($user->gender != $request->gender) ? $request->gender : $user->gender;
        $user->phone_number = ($user->phone_number != $request->phone_number) ? $request->phone_number : $user->phone_number;
        $user->cellphone_number = ($request->filled('cellphone_number') && $user->cellphone_number != $request->cellphone_number) ? $request->cellphone_number : $user->cellphone_number;
        $user->nacionality = ($user->nacionality != $request->nacionality) ? $request->nacionality : $user->nacionality;
        $user->location = ($user->location != $request->location) ? $request->location : $user->location;
        $user->address = ($user->address != $request->address) ? $request->address : $user->address;
        $user->status = ($user->status != $request->status) ? $request->status : $user->status;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name=basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            Image::make($request->file('photo')->getRealPath())->fit(200, 266)->save('storage/images/photos/'.$imgname);
            $user->photo = $imgname;
        }
        $user->save();

        if ($request->filled('roles')) {
            $rolesNames = Arr::pluck(json_decode($request->roles), ['name']);
            $user->syncRoles($rolesNames);
        }

        return $user;
    }
    /**
     * Get all users from Database
     *
     * @param Request $request
     * @param string $rol
     * @return JsonResponse
     */
    private function _indexUser($request, string $rol) : JsonResponse
    {
        $query = User::role($rol)->with(
            ['usermeta' => function ($query1) {
                        $query1->where('name', '=', 'display_name');
            }]
        );
        if ($request->search) {
            $query->searchByName($request->search);
        }
        $users = $query->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
            ->paginate($request->input('pagination.per_page'));
        return response()->json(['users' => $users], 200);
    }
    /**
     * Updates many users at once
     *
     * @param Request $request
     * @param string $rol
     * @return JsonResponse
     */
    private function _massChangesUser($request, string $rol) : JsonResponse
    {
        if (!empty($request->users)) {
            $usersids = $request->users;
            if ($request->status != "") {
                foreach ($usersids as $userid) {
                    if ($userid != "1") {
                        $user = User::role($rol)->findOrFail(intval($userid));
                        $user->status = $request->status;
                        $user->save();
                    } else {
                        return response()->json(['message' => 'No tienes los permisos suficientes para actualizar el estado de este usuario'], 200);
                    }
                }
                return response()->json(['message' => 'Se ha actualizado el estado de los usuarios seleccionados'], 200);
            } elseif ($request->action != "") {
                if ($request->action == 'delete') {
                    foreach ($usersids as $userid) {
                        if ($userid != "1") {
                            $user = User::role($rol)->findOrFail(intval($userid));
                            $user->delete();
                        } else {
                            return response()->json(['message' => 'No tienes los permisos suficientes para eliminar este usuario'], 200);
                        }
                    }
                    return response()->json(['message' => 'Se han eliminado los usuarios seleccionados'], 200);
                }
            }
        } else {
            return response()->json(['message' => 'Debes seleccionar al menos un usuario para realizar esta acción'], 200);
        }
        return response()->json($request->all(), 200);
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
    /**
     * Get all users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function indexSuperAdmin(Request $request) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_indexUser($request, 'superadmin');
    }
    /**
     * Updates many users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function massChangesSuperAdmin(Request $request) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_massChangesUser($request, 'superadmin');
    }
    /**
     * Show page for create SuperAdmin
     *
     * @return \Illuminate\Http\Response
     */
    public function createSuperAdmin()
    {
        $countries = $this->countriesArray();
        return view('layouts.users.sa.add')
            ->with('countries', $countries);
    }
    /**
     * Create a SuperAdmin user
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function storeSuperAdmin(CreateUserRequest $request) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_storeUser($request, 'superadmin');
        
        return response()->json(null, 200);
    }
    /**
     * Show a SuperAdmin user
     *
     * @param integer $id
     * @return mix 
     */
    public function showSuperAdmin(int $id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $user = User::role('superadmin')->with(
                ['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
                }]
            )->findOrFail($id);
            $user->load('roles');
            return view('layouts.users.sa.show')
                ->with('user', $user)
                ->with('countries', $this->countries);
        } else {
            Flash::error('No tienes los permisos suficientes para ver esta información.');
            return redirect()->route('users.sa');
        }
    }
    /**
     * Show SuperAdmin edit form
     *
     * @param integer $id
     * @return mix
     */
    public function editSuperAdmin(int $id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $countries = $this->countriesArray();
            $user = User::role('superadmin')->with(
                ['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
                }]
            )->findOrFail($id);
            $user->load('roles');
            return view('layouts.users.sa.edit')
                ->with('user', $user)
                ->with('countries', $countries);
        } else {
            Flash::error('No tienes los permisos suficientes para editar a este usuario.');
            return redirect()->route('users.sa');
        }
    }
    /**
     * Update SuperAdmin user
     *
     * @param EditUserRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function updateSuperAdmin(EditUserRequest $request, int $id) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_updateUser($request, $id, 'superadmin');
                
        return response()->json(null, 200);
    }
    /**
     * Delete SuperAdmin user
     *
     * @param Request $request
     * @param integer $id
     * @return JsonResponse
     */
    public function destroySuperAdmin(Request $request, int $id) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::role('superadmin')->findOrFail(intval($id));
        $name = $user->first_name.' '.$user->last_name;
        $user->removeRole('superadmin');
        $user->delete();
        return response()->json(['message' => 'Se ha eliminado al usuario '.$name], 200);
    }
    /**
     * Get all Administrative users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAdministrative(Request $request) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_indexUser($request, 'administrative');
    }
    /**
     * Updates many Administrative users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function massChangesAdministrative(Request $request) : JsonResponse
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_massChangesUser($request, 'administrative');
    }
    
    public function createAdministrative()
    {
        $countries = $this->countriesArray();
        return view('layouts.users.ad.add')
            ->with('countries', $countries);
    }

    public function storeAdministrative(CreateUserRequest $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_storeUser($request, 'administrative');
        
        return response()->json(null, 200);
    }

    public function showAdministrative($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $user = User::role('administrative')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles');
            return view('layouts.users.ad.show')
            ->with('user', $user)
            ->with('countries', $this->countries);
        } else {
            Flash::error('No tienes los permisos suficientes para ver esta información.');
            return redirect()->route('users.ad.index');
        }
    }

    public function editAdministrative($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $countries = $this->countriesArray();
            $user = User::role('administrative')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles');
            return view('layouts.users.ad.edit')
            ->with('user', $user)
            ->with('countries', $countries);
        } else {
            Flash::error('No tienes los permisos suficientes para editar a este usuario.');
            return redirect()->route('users.ad.index');
        }
    }

    public function updateAdministrative(EditUserRequest $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_updateUser($request, $id, 'administrative');
                
        return response()->json(null, 200);
    }

    public function destroyAdministrative(Request $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::role('administrative')->findOrFail(intval($id));
        $name = $user->first_name.' '.$user->last_name;
        $user->removeRole('administrative');
        $user->delete();
        return response()->json(['message' => 'Se ha eliminado al usuario '.$name], 200);
    }

    public function indexCoordinator(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_indexUser($request, 'coordinator');
    }

    public function massChangesCoordinator(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_massChangesUser($request, 'coordinator');
    }

    public function createCoordinator()
    {
        $countries = $this->countriesArray();
        return view('layouts.users.co.add')
            ->with('countries', $countries);
    }

    public function storeCoordinator(CreateUserRequest $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_storeUser($request, 'coordinator');
        
        return response()->json(null, 200);
    }

    public function showCoordinator($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $user = User::role('coordinator')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles');
            return view('layouts.users.co.show')
            ->with('user', $user)
            ->with('countries', $this->countries);
        } else {
            Flash::error('No tienes los permisos suficientes para ver esta información.');
            return redirect()->route('users.co.index');
        }
    }

    public function editCoordinator($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $countries = $this->countriesArray();
            $user = User::role('coordinator')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles');
            return view('layouts.users.co.edit')
            ->with('user', $user)
            ->with('countries', $countries);
        } else {
            Flash::error('No tienes los permisos suficientes para editar a este usuario.');
            return redirect()->route('users.co.index');
        }
    }

    public function updateCoordinator(EditUserRequest $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_updateUser($request, $id, 'coordinator');
                
        return response()->json(null, 200);
    }

    public function destroyCoordinator(Request $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::role('coordinator')->findOrFail(intval($id));
        $name = $user->first_name.' '.$user->last_name;
        $user->removeRole('coordinator');
        $user->delete();
        return response()->json(['message' => 'Se ha eliminado al usuario '.$name], 200);
    }

    public function indexTeacher(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_indexUser($request, 'teacher');
    }

    public function massChangesTeacher(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_massChangesUser($request, 'teacher');
    }

    public function createTeacher()
    {
        $countries = $this->countriesArray();
        return view('layouts.users.te.add')
            ->with('countries', $countries);
    }

    public function storeTeacher(StoreTeacher $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_storeUser($request, 'teacher');

        $areaid = data_get(json_decode($request->area), 'id');
        
        $area = Area::findOrFail($areaid);

        $teacher = new Teacher();
        $teacher->acronym = $request->acronym;
        $teacher->profession = $request->profession;
        $teacher->experience = ($request->filled('experience')) ? strip_tags($request->experience, $this->allowedTags) : null;
        $teacher->applied_studies = ($request->filled('applied_studies')) ? strip_tags($request->applied_studies, $this->allowedTags) : null;
        $teacher->scale = ($request->filled('scale')) ? $request->scale : null;
        $teacher->resolution = ($request->filled('resolution')) ? $request->resolution : null;
        $teacher->user()->associate($user);
        $teacher->area()->associate($area);
        $teacher->save();
        
        return response()->json(null, 200);
    }

    public function showTeacher($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $user = User::role('teacher')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles', 'teacher.area');
            return view('layouts.users.te.show')
            ->with('user', $user)
            ->with('countries', $this->countries);
        } else {
            Flash::error('No tienes los permisos suficientes para ver esta información.');
            return redirect()->route('users.te.index');
        }
    }

    public function editTeacher($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $countries = $this->countriesArray();
            $user = User::role('teacher')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles');
            $teacher = Teacher::where('user_id', $user->id)->firstOrFail();
            $teacher->load('area');
            return view('layouts.users.te.edit')
            ->with('user', $user)
            ->with('teacher', $teacher)
            ->with('countries', $countries);
        } else {
            Flash::error('No tienes los permisos suficientes para editar a este usuario.');
            return redirect()->route('users.te.index');
        }
    }

    public function updateTeacher(EditTeacher $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_updateUser($request, $id, 'teacher');

        $areaid = data_get(json_decode($request->area), 'id');
        
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();
        $teacher->acronym = ($teacher->acronym != $request->acronym) ? $request->acronym : $teacher->acronym;
        $teacher->profession = ($teacher->profession != $request->profession) ? $request->profession : $teacher->profession;
        $teacher->experience = ($request->filled('experience') && $teacher->experience != $request->experience) ? strip_tags($request->experience, $this->allowedTags) : $teacher->experience;
        $teacher->applied_studies = ($request->filled('applied_studies') && $teacher->applied_studies != $request->applied_studies) ? strip_tags($request->applied_studies, $this->allowedTags) : $teacher->applied_studies;
        $teacher->scale = ($request->filled('scale') && $teacher->scale != $request->scale) ? $request->scale : $teacher->scale;
        $teacher->resolution = ($request->filled('resolution') && $teacher->resolution != $request->resolution) ? $request->resolution : $teacher->resolution;
        if ($teacher->area_id != $areaid) {
            $area = Area::findOrFail($areaid);
            $teacher->area()->associate($area);
        }
        $teacher->save();
                
        return response()->json(null, 200);
    }

    public function destroyTeacher(Request $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::role('teacher')->findOrFail(intval($id));
        $name = $user->first_name.' '.$user->last_name;
        $teacher = Teacher::where('user_id', $user->id)->firstOrFail();
        $teacher->delete();
        $user->removeRole('teacher');
        $user->delete();
        return response()->json(['message' => 'Se ha eliminado al usuario '.$name], 200);
    }

    public function indexStudent(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_indexUser($request, 'student');
    }

    public function massChangesStudent(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->_massChangesUser($request, 'student');
    }

    public function createStudent()
    {
        $countries = $this->countriesArray();
        return view('layouts.users.st.add')
            ->with('countries', $countries);
    }

    public function storeStudent(StoreStudent $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_storeUser($request, 'student');

        $student = new Student();
        $student->neighborhood = ($request->filled('neighborhood')) ? $request->neighborhood : null;
        $student->commune = ($request->filled('commune')) ? $request->commune : null;
        $student->socioeconomic_level = ($request->filled('socioeconomic_level')) ? $request->socioeconomic_level : null;
        $student->health_care = ($request->filled('health_care')) ? $request->health_care : null;
        $student->blood_type = ($request->filled('blood_type')) ? $request->blood_type : null;
        $student->allergies = ($request->filled('allergies')) ? strip_tags($request->allergies, $this->allowedTags) : null;
        $student->diseases = ($request->filled('diseases')) ? strip_tags($request->diseases, $this->allowedTags) : null;
        $student->user()->associate($user);
        $student->save();
        
        return response()->json(null, 200);
    }

    public function showStudent($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $user = User::role('student')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles', 'student.guardians');
            return view('layouts.users.st.show')
            ->with('user', $user)
            ->with('countries', $this->countries);
        } else {
            Flash::error('No tienes los permisos suficientes para ver esta información.');
            return redirect()->route('users.st.index');
        }
    }

    public function editStudent($id)
    {
        if ($id != "1" || Auth::id() == 1) {
            $countries = $this->countriesArray();
            $user = User::role('student')->with(['usermeta' => function ($query) {
                        $query->where('name', '=', 'display_name');
            }])->findOrFail($id);
            $user->load('roles');
            $student = Student::where('user_id', $user->id)->firstOrFail();
            $student->load('guardians');
            return view('layouts.users.st.edit')
            ->with('user', $user)
            ->with('student', $student)
            ->with('countries', $countries);
        } else {
            Flash::error('No tienes los permisos suficientes para editar a este usuario.');
            return redirect()->route('users.st.index');
        }
    }

    public function updateStudent(EditStudent $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = $this->_updateUser($request, $id, 'student');

        $student = Student::where('user_id', $user->id)->firstOrFail();
        $student->neighborhood = ($student->neighborhood != $request->neighborhood) ? $request->neighborhood : $student->neighborhood;
        $student->commune = ($student->commune != $request->commune) ? $request->commune : $student->commune;
        $student->socioeconomic_level = ($student->socioeconomic_level != $request->socioeconomic_level) ? $request->socioeconomic_level : $student->socioeconomic_level;
        $student->health_care = ($student->health_care != $request->health_care) ? $request->health_care : $student->health_care;
        $student->blood_type = ($student->blood_type != $request->blood_type) ? $request->blood_type : $student->blood_type;
        $student->allergies = ($request->filled('allergies') && $student->allergies != $request->allergies) ? strip_tags($request->allergies, $this->allowedTags) : $student->allergies;
        $student->diseases = ($request->filled('diseases') && $student->diseases != $request->diseases) ? strip_tags($request->diseases, $this->allowedTags) : $student->diseases;
        $student->save();
                
        return response()->json(null, 200);
    }

    public function destroyStudent(Request $request, $id)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::role('student')->findOrFail(intval($id));
        $name = $user->first_name.' '.$user->last_name;
        $student = Student::where('user_id', $user->id)->firstOrFail();
        $student->delete();
        $user->removeRole('student');
        $user->delete();
        return response()->json(['message' => 'Se ha eliminado al usuario '.$name], 200);
    }

    public function indexGuardian(Request $request)
    {
        //
    }

    public function massChangesGuardian(Request $request)
    {
        //
    }

    public function createGuardian()
    {
        //
    }

    public function storeGuardian(Request $request)
    {
        //
    }

    public function showGuardian($id)
    {
        //
    }

    public function editGuardian($id)
    {
        //
    }

    public function updateGuardian(Request $request, $id)
    {
        //
    }

    public function destroyGuardian(Request $request, $id)
    {
        //
    }
}
