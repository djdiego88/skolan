@extends('layouts.app')
@section('title', 'Coordinador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'show-co', $user))
@section('breadcrumbs', Breadcrumbs::render('show-co', $user))
@section('content')
	<co-show :user="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}" :userroles="{{ json_encode(auth()->user()->getRoleNames()) }}"></co-show>
@endsection
