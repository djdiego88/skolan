@extends('layouts.app')
@section('title', 'Añadir Personal Administrativo')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'add-ad'))
@section('breadcrumbs', Breadcrumbs::render('add-ad'))
@section('content')
	<ad-add :countries="{{ json_encode($countries) }}"></ad-add>
@endsection
