@extends('layouts.app')
@section('title', 'Docente')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'show-te', $user))
@section('breadcrumbs', Breadcrumbs::render('show-te', $user))
@section('content')
	<te-show :user="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}" :userroles="{{ json_encode(auth()->user()->getRoleNames()) }}"></te-show>
@endsection
