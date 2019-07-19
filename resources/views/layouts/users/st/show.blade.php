@extends('layouts.app')
@section('title', 'Alumno')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'show-st', $user))
@section('breadcrumbs', Breadcrumbs::render('show-st', $user))
@section('content')
	<st-show :user="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}" :userroles="{{ json_encode(auth()->user()->getRoleNames()) }}"></st-show>
@endsection
