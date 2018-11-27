@extends('layouts.app')
@section('title', 'Personal Administrativo')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'show-ad', $user))
@section('breadcrumbs', Breadcrumbs::render('show-ad', $user))
@section('content')
	<ad-show :user="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}" :userroles="{{ json_encode(auth()->user()->getRoleNames()) }}"></ad-show>
@endsection
