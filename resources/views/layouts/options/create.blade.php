@extends('layouts.app')
@section('title', 'Crear Opción')

@section('content')
	{!! Form::open(['route' => 'options.store', 'method' => 'POST']); !!}
		{{--@csrf--}}
		<fieldset class="form-group">
			{!! Form::label('name','Nombre'); !!}
			{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre de la opción sin espacios','required']); !!}
		</fieldset>
		<fieldset class="form-group">
			{!! Form::label('displayname','Nombre  mostrar'); !!}
			{!! Form::text('displayname',null,['class'=>'form-control','placeholder'=>'Nombre a mostrar de la opción','required']); !!}
		</fieldset>
		<fieldset class="form-group">
			{!! Form::label('description','Descripción'); !!}
			{!! Form::text('description',null,['class'=>'form-control','placeholder'=>'Descripción de la opción']); !!}
		</fieldset>
		<fieldset class="form-group">
			{!! Form::label('value','Valor'); !!}
			{!! Form::textarea('value',null,['class'=>'form-control','placeholder'=>'Valor por defecto de la opción','required']); !!}
		</fieldset>
		<fieldset class="form-group">
			{!! Form::submit('Agregar',['class'=>'btn btn-primary']); !!}
		</fieldset>

	{!! Form::close(); !!}
@endsection