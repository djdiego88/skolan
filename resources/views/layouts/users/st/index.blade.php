@extends('layouts.app')
@section('title','Alumnos')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'student'))
@section('breadcrumbs', Breadcrumbs::render('student'))
@section('content')
	<st-index></st-index>
@endsection
