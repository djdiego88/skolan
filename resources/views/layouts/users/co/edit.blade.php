@extends('layouts.app')
@section('title', 'Editar Coordinador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'edit-co', $user))
@section('breadcrumbs', Breadcrumbs::render('edit-co', $user))
@section('content')
	<co-edit :user-info="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}"></co-edit>
@endsection

