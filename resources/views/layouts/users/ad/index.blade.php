@extends('layouts.app')
@section('title','Personal Administrativo')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'admins'))
@section('breadcrumbs', Breadcrumbs::render('admins'))
@section('content')
	<ad-index></ad-index>
@endsection
