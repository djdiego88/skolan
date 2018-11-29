@extends('layouts.app')
@section('title', 'Añadir Coordinador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'add-co'))
@section('breadcrumbs', Breadcrumbs::render('add-co'))
@section('content')
	<co-add :countries="{{ json_encode($countries) }}"></co-add>
@endsection
