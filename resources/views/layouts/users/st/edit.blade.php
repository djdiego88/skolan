@extends('layouts.app')
@section('title', 'Editar Alumno')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'edit-st', $user))
@section('breadcrumbs', Breadcrumbs::render('edit-st', $user))
@section('content')
	<st-edit :user-info="{{ json_encode($user) }}" :student-info="{{ json_encode($student) }}" :countries="{{ json_encode($countries) }}"></st-edit>
@endsection

