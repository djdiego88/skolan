@extends('layouts.app')
@section('title','Super Administradores')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'superadmins'))
@section('breadcrumbs', Breadcrumbs::render('superadmins'))
@section('content')
	<sa-index></sa-index>
@endsection
