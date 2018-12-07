@extends('layouts.app')
@section('title', 'Editar Docente')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'edit-te', $user))
@section('breadcrumbs', Breadcrumbs::render('edit-te', $user))
@section('content')
	<te-edit :user-info="{{ json_encode($user) }}" :teacher-info="{{ json_encode($teacher) }}" :countries="{{ json_encode($countries) }}"></te-edit>
@endsection

