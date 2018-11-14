@extends('layouts.app')
@section('title', 'Opciones Generales')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'configs'))
@section('breadcrumbs', Breadcrumbs::render('configs'))
@section('content')
	<div class="row justify-content-center">
        <div class="col-md-12">
            <options></options>
        </div>
    </div>
@endsection
