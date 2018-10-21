@extends('layouts.app')
@section('title', 'Añadir Personal Administrativo')
@section('content')
{!! Form::open(['route' => 'users.ad.store', 'method' => 'POST', 'files' => true]); !!}
	<div class="form-group required row">
		{!! Form::label('first_name','Nombres:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('first_name',null,['class'=>'form-control form-control-sm','placeholder'=>'Nombres del usuario','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('last_name','Apellidos:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('last_name',null,['class'=>'form-control form-control-sm','placeholder'=>'Apellidos del usuario','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('it','Tipo de Identificación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-6 col-md-3">
			{!! Form::select('it',['RC'=>'Registro Civil', 'TI'=>'Tarjeta de Identidad', 'CC'=>'Cédula de Ciudadanía', 'CE'=>'Cédula de Extranjería', 'PB'=>'Pasaporte', 'NI'=>'Nit'],null,['class'=>'form-control form-control-sm', 'placeholder'=>'-- Tipo de identificación --', 'required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('nid','Número de Identificación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-6 col-md-3">
			{!! Form::text('nid',null,['class'=>'form-control form-control-sm','placeholder'=>'Número de identificación','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('password','Contraseña:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-6 col-md-3">
			{!! Form::password('password',['class'=>'form-control form-control-sm','placeholder'=>'Mínimo 8 caracteres','required']); !!}
		</div>
	</div>
	<div class="form-group row">
		{!! Form::label('email','Correo Electrónico:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::email('email',null,['class'=>'form-control form-control-sm','placeholder'=>'Correo Electrónico']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('birth_date','Fecha de Nacimiento:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::text('birth_date',null,['id'=>'datepicker','class'=>'form-control form-control-sm','placeholder'=>'AAAA-MM-DD','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('gender','Género:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::select('gender',['m'=>'Masculino', 'f'=>'Femenino'],null,['class'=>'form-control form-control-sm', 'placeholder'=>'-- Género --', 'required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('phone_number','Número de teléfono:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::text('phone_number',null,['class'=>'form-control form-control-sm','placeholder'=>'Número de teléfono','required']); !!}
		</div>
	</div>
	<div class="form-group row">
		{!! Form::label('cellphone_number','Número de teléfono móvil:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::text('cellphone_number',null,['class'=>'form-control form-control-sm','placeholder'=>'Número de teléfono móvil']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('nacionality','País de origen:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-3">
			{!! Form::select('nacionality',$countries,null,['class'=>'form-control form-control-sm', 'placeholder'=>'-- País de origen --', 'required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('location','Ubicación:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('location',null,['class'=>'form-control form-control-sm','placeholder'=>'Ejemplo: Bogotá, Colombia','required']); !!}
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('address','Dirección de residencia:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			{!! Form::text('address',null,['class'=>'form-control form-control-sm','placeholder'=>'Dirección de residencia','required']); !!}
		</div>
	</div>
	<div class="form-group row">
		{!! Form::label('photo','Foto del usuario:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-9 col-md-6">
			<img src="{{asset('storage/images/photos/default-avatar.png')}}" class="img-thumbnail" width="150" height="auto">
			{!! Form::file('photo',['class'=>'form-control-file', 'accept'=>'.png, .jpg, .jpeg']); !!}
			<small class="form-text text-muted">{{ __('Solo archivos: JPG o PNG. Peso máximo: 2 MB') }}</small>
		</div>
	</div>
	<div class="form-group required row">
		{!! Form::label('status','Estado:',['class'=>'col-sm-3 col-md-2 col-form-label']); !!}
		<div class="col-sm-5 col-md-2">
			{!! Form::select('status',['enabled'=>'Habilitado', 'disabled'=>'Inhabilitado'],'enabled',['class'=>'form-control form-control-sm', 'placeholder'=>'-- Estado --', 'required']); !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::submit('Añadir Usuario',['class'=>'btn btn-primary btn-sm']); !!}
	</div>
{!! Form::close(); !!}
@endsection
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
	$( function() {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth();
		var yyyy = today.getFullYear();

		$( "#datepicker" ).datepicker({
			maxDate: new Date(yyyy, mm, dd),
			dateFormat: "yy-mm-dd",
			monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
			closeText: "Cerrar",
			nextText: "Siguiente",
			prevText: "Anterior",
			currentText: "Ahora",
			dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
			dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá" ],
			dayNamesShort: [ "Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb" ],
			weekHeader: "Sm",
			changeMonth: true,
      		changeYear: true
		});
	});
</script>
@endsection