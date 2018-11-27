@extends('layouts.app')
@section('title', 'Editar Personal Administrativo')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'edit-ad', $user))
@section('breadcrumbs', Breadcrumbs::render('edit-ad', $user))
@section('content')
	<ad-edit :user-info="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}"></ad-edit>
@endsection

