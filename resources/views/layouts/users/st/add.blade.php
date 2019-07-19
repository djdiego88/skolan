@extends('layouts.app')
@section('title', 'Añadir Alumno')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'add-st'))
@section('breadcrumbs', Breadcrumbs::render('add-st'))
@section('content')
	<st-add :countries="{{ json_encode($countries) }}"></st-add>
@endsection
