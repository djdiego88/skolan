@extends('layouts.app')
@section('title', 'Editar Super Administrador')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'edit-sa', $user))
@section('breadcrumbs', Breadcrumbs::render('edit-sa', $user))
@section('content')
	<sa-edit :user-info="{{ json_encode($user) }}" :countries="{{ json_encode($countries) }}"></sa-edit>
{{--<div class="user-buttons clearfix">
	<a href="{{route('users.sa.add')}}" class="btn btn-secondary active btn-sm"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
</div>
{!! Form::open(['route' => ['users.sa.update', $user], 'method' => 'PUT', 'files' => true]); !!}
	<div class="form-group required row">
		{!! Form::label('first_name','Nombres:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('first_name',$user->first_name,['class'=>'form-control form-control-sm','placeholder'=>'Nombres del usuario','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('last_name','Apellidos:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('last_name',$user->last_name,['class'=>'form-control form-control-sm','placeholder'=>'Apellidos del usuario','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('it','Tipo de Identificación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-6 col-md-3">
			{!! Form::select('it',['RC'=>'Registro Civil', 'TI'=>'Tarjeta de Identidad', 'CC'=>'Cédula de Ciudadanía', 'CE'=>'Cédula de Extranjería', 'PB'=>'Pasaporte', 'NI'=>'Nit'],$user->it,['class'=>'form-control form-control-sm', 'placeholder'=>'Tipo de identificación', 'required', 'disabled']); !!}
			<small class="text-muted">{{ __('No se puede editar.') }}</small>
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('nid','Número de Identificación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-6 col-md-3">
			{!! Form::text('nid',$user->nid,['class'=>'form-control form-control-sm','placeholder'=>'Número de identificación','required', 'disabled']); !!}
			<small class="text-muted">{{ __('No se puede editar.') }}</small>
		</div>
	</div>
	<div class="form-group row">
		{!! Form::label('password','Contraseña:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-6 col-md-3">
			{!! Form::password('password',['class'=>'form-control form-control-sm','placeholder'=>'Mínimo 8 caracteres']); !!}
		</div>
	</div>
	<div class="form-group row">
		{!! Form::label('email','Correo Electrónico:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::email('email',$user->email,['class'=>'form-control form-control-sm','placeholder'=>'Correo Electrónico']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('birth_date','Fecha de Nacimiento:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::text('birth_date',$user->birth_date->toDateString(),['id'=>'datepicker','class'=>'form-control form-control-sm','placeholder'=>'AAAA-MM-DD','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('gender','Sexo:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::select('gender',['m'=>'Masculino', 'f'=>'Femenino'],$user->gender,['class'=>'form-control form-control-sm', 'placeholder'=>'Sexo', 'required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('phone_number','Número de teléfono:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::text('phone_number',$user->phone_number,['class'=>'form-control form-control-sm','placeholder'=>'Número de teléfono','required']); !!}
		</div>
	</div>
	<div class="form-group row">
		{!! Form::label('cellphone_number','Número de teléfono móvil:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::text('cellphone_number',$user->cellphone_number,['class'=>'form-control form-control-sm','placeholder'=>'Número de teléfono móvil']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('nacionality','País de origen:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-3">
			{!! Form::select('nacionality',$countries,$user->nacionality,['class'=>'form-control form-control-sm', 'placeholder'=>'País de origen', 'required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('location','Ubicación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('location',$user->location,['class'=>'form-control form-control-sm','placeholder'=>'Ejemplo: Bogotá, Colombia','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('address','Dirección de residencia:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('address',$user->address,['class'=>'form-control form-control-sm','placeholder'=>'Dirección de residencia','required']); !!}
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
			{!! Form::file('photo',['class'=>'form-control-file', 'accept'=>'.png, .jpg, .jpeg']); !!}
			<small class="text-muted">{{ __('Solo archivos: JPG o PNG. Peso máximo: 2 MB') }}</small>
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('status','Estado:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::select('status',['enabled'=>'Habilitado', 'disabled'=>'Inhabilitado'],$user->status,['class'=>'form-control form-control-sm', 'placeholder'=>'Estado', 'required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('roles','Roles:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::select('roles',['superadmin'=>'Super Admin', 'admin'=>'Admin'],null,['class'=>'form-control form-control-sm', 'placeholder'=>'Roles', 'required']); !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::submit('Actualizar usuario',['class'=>'btn btn-primary btn-sm']); !!}
		<a href="{{route('users.sa.destroy', $user->id)}}" onclick="return confirm('¿Deseas eliminar a {{$name}}?');" class="btn btn-secondary active btn-sm"><i class="fa fa-times" aria-hidden="true"></i> Eliminar a {{$name}}</a>
	</div>
{!! Form::close(); !!}
--}}
@endsection

