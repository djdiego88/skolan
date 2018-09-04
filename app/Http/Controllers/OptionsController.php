<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use Laracasts\Flash\Flash;
use App\Watchdog;

class OptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin'])->only(['create', 'store']);
        $this->middleware(['role:superadmin|administrative'])->only(['index', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::all();
        $styles = [
            'primary'=>'Principal',
            'style2'=>'Estilo 2', 
            'style3'=>'Estilo 3', 
            'style4'=>'Estilo 4'
        ];
        return view('layouts.options.index')
            ->with('options', $options)
            ->with('styles', $styles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.options.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        $option = new Option($request->all());
        $option->save();
        $watchdog = new Watchdog();
        $watchdog->user_id = Auth::id();
        $watchdog->type = 'create';
        $watchdog->text = 'Se ha creado la opción '.$option->display_name.' con el valor: '.$option->value;
        $watchdog->ip = $request->ip();
        $watchdog->save();
        Flash::success('Se ha creado la opción '.$option->display_name.' de forma exitosa');
        return redirect()->route('options.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request)
    {
        //$options = Option::where('name', 'site_name')->get();
        //dd($request->all());
        $data = $request->all();
        foreach ($data as $name => $valor) {
            if($name != '_method' && $name != '_token' && $name != 'site_logo'){
                $option = Option::where('name', $name)->get()->first();
                if($option->value != $valor){
                    $option->value = $valor;
                    $option->save();
                    $watchdog = new Watchdog();
                    $watchdog->user_id = Auth::id();
                    $watchdog->type = 'edit';
                    $watchdog->text = 'Se ha editado la opción '.$option->display_name.' con el valor: '.$option->value;
                    $watchdog->ip = $request->ip();
                    $watchdog->save();
                }
            }
        }
        if($request->file('site_logo')){
            $file = $request->file('site_logo');
            $name=basename($file->getClientOriginalName(),'.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            Storage::put(
                'public/images/logo/'.$imgname,
                file_get_contents($request->file('site_logo')->getRealPath())
            );
            $logo = Option::where('name', 'site_logo')->get()->first();
            $logo->value = 'storage/images/logo/'.$imgname;
            $logo->save();
            $watchdog = new Watchdog();
            $watchdog->user_id = Auth::id();
            $watchdog->type = 'edit';
            $watchdog->text = 'Se ha editado el logo de la institución con el valor: '.$logo->value;
            $watchdog->ip = $request->ip();
            $watchdog->save();
        }
        Flash::success('Se han actualizado las opciones');
        return redirect()->route('options.index');
    }
}
