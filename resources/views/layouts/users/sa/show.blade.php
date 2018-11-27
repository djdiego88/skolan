@extends('layouts.app')
@section('title', 'Super Administrador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'show-sa', $user))
@section('breadcrumbs', Breadcrumbs::render('show-sa', $user))
@section('content')
	<sa-show :user="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}" :userroles="{{ json_encode(auth()->user()->getRoleNames()) }}"></sa-show>
@endsection
