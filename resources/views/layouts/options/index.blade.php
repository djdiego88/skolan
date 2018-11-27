@extends('layouts.app')
@section('title', 'Opciones Generales')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'configs'))
@section('breadcrumbs', Breadcrumbs::render('configs'))
@section('content')
	<options></options>
@endsection
