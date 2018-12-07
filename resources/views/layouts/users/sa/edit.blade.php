@extends('layouts.app')
@section('title', 'Editar Super Administrador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'edit-sa', $user))
@section('breadcrumbs', Breadcrumbs::render('edit-sa', $user))
@section('content')
	<sa-edit :user-info="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}"></sa-edit>
@endsection

