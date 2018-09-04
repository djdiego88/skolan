<?php
	foreach($user->usermeta as $displayname){
		$name = $displayname->value;
	}
?>
@extends('layouts.app')
@section('title', 'Super Administrador')
@section('content')
<div class="user-buttons clearfix">
	<a href="{{route('users.sa.edit', $user->id)}}" class="btn btn-secondary active btn-sm"><i class="fas fa-edit"></i> Actualizar a {{$name}}</a>
	<a href="{{route('users.sa.destroy', $user->id)}}" onclick="return confirm('¿Deseas eliminar este Super Administrador?');" class="btn btn-secondary active btn-sm"><i class="fas fa-times"></i> Eliminar a {{$name}}</a>
</div>
<div class="form-group row">
	{!! Form::label('names','Nombres y apellidos:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-9 col-md-6">
		<p id="names" class="form-control-plaintext">{{$user->first_name}} {{$user->last_name}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('nid','Identificación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-6 col-md-3">
		<p id="nid" class="form-control-plaintext">
			@if($user->it == 'RC')
			Registro Civil:
			@elseif($user->it == 'TI')
			Tarjeta de Identidad:
			@elseif($user->it == 'CC')
			Cédula de Ciudadanía:
			@elseif($user->it == 'CE')
			Cédula de Extranjería:
			@elseif($user->it == 'PB')
			Pasaporte:
			@elseif($user->it == 'NI')
			Nit:
			@endif
			 {{$user->nid}}
		</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('email','Correo Electrónico:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-9 col-md-6">
		<p id="email" class="form-control-plaintext">{{$user->email}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('birth_date','Fecha de Nacimiento:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-6 col-md-3">
		<p id="birth_date" class="form-control-plaintext">{{$user->birth_date->toFormattedDateString()}} -  <strong>Edad:</strong> {{$user->birth_date->diffInYears()}} años</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('gender','Sexo:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-5 col-md-2">
		<p id="gender" class="form-control-plaintext">
		@if($user->gender == 'm')
		Masculino
		@elseif($user->gender == 'f')
		Femenino
		@endif
		</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('phone_number','Número de teléfono:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-5 col-md-2">
		<p id="phone_number" class="form-control-plaintext">{{$user->phone_number}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('cellphone_number','Número de teléfono móvil:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-5 col-md-2">
		<p id="cellphone_number" class="form-control-plaintext">{{$user->cellphone_number}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('nacionality','País de origen:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-5 col-md-3">
		<p id="nacionality" class="form-control-plaintext">{{$countries[$user->nacionality]}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('location','Ubicación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-9 col-md-6">
		<p id="location" class="form-control-plaintext">{{$user->location}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('address','Dirección de residencia:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-9 col-md-6">
		<p id="address" class="form-control-plaintext">{{$user->address}}</p>
	</div>
</div>
<div class="form-group row">
	{!! Form::label('photo','Foto del usuario:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-9 col-md-6">
		@if($user->photo == '')
		<img src="{{asset('storage/images/photos/default-avatar.png')}}" class="img-thumbnail" width="150" height="auto">
		@else
		<img src="{{asset($user->photo)}}" class="img-thumbnail" width="150" height="auto">
		@endif
	</div>
</div>
<div class="form-group row">
	{!! Form::label('status','Estado:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
	<div class="col-sm-5 col-md-2">
		<p id="status" class="form-control-plaintext">
		@if($user->status == 'enabled')
		Habilitado
		@elseif($user->status == 'disabled')
		Inhabilitado
		@endif
		</p>
	</div>
</div>
@endsection