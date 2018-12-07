@extends('layouts.app')
@section('title','Docentes')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'teacher'))
@section('breadcrumbs', Breadcrumbs::render('teacher'))
@section('content')
	<te-index></te-index>
@endsection
