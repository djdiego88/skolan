@extends('layouts.app')
@section('title', 'Añadir Docente')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'add-te'))
@section('breadcrumbs', Breadcrumbs::render('add-te'))
@section('content')
	<te-add :countries="{{ json_encode($countries) }}"></te-add>
@endsection
