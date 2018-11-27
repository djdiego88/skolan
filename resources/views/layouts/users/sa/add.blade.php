@extends('layouts.app')
@section('title', 'Añadir Super Administrador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'add-sa'))
@section('breadcrumbs', Breadcrumbs::render('add-sa'))
@section('content')
	<sa-add :countries="{{ json_encode($countries) }}"></sa-add>
@endsection
