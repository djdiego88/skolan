<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use Laracasts\Flash\Flash;

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
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $options = Option::all();
        //dd($options);
        $styles = [
            'primary'=>'Principal',
            'style2'=>'Estilo 2',
            'style3'=>'Estilo 3',
            'style4'=>'Estilo 4'
        ];
        return ['options'=> $options, 'styles' => $styles];
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
        Flash::success('Se ha creado la opción '.$option->display_name.' de forma exitosa');
        return redirect()->route('options.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->all();
        foreach ($data as $name => $valor) {
            if ($name != '_method' && $name != '_token' && $name != 'site_logo') {
                $option = Option::where('name', $name)->get()->first();
                if ($option->value != $valor) {
                    $option->value = $valor;
                    $option->save();
                }
            }
        }
        if ($request->file('site_logo')) {
            $file = $request->file('site_logo');
            $name=basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $imgname = $name.'_'.time().'.'.$file->getClientOriginalExtension();
            Storage::put(
                'public/images/logo/'.$imgname,
                file_get_contents($request->file('site_logo')->getRealPath())
            );
            $logo = Option::where('name', 'site_logo')->get()->first();
            $logo->value = /*'storage/images/logo/'.*/$imgname;
            $logo->save();
        }
    }
}
