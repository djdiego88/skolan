@extends('layouts.app')
@section('title','Coordinadores')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'coordinators'))
@section('breadcrumbs', Breadcrumbs::render('coordinators'))
@section('content')
	<co-index></co-index>
@endsection
