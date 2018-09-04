@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="row">
	@hasrole('superadmin')
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Super administradores') }}</h4>
					<p class="card-text">{{ __('Administradores de la plataforma') }}</p>
					<a href="{{route('users.sa.index')}}" class="btn btn-primary"><i class="fas fa-users"></i> {{ __('Ver Usuarios') }}</a>
					<a href="{{route('users.sa.add')}}" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('Crear') }}</a>
				</div>
			</div>
		</div>
	@endhasrole
	@hasanyrole('superadmin|administrative')
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Personal administrativo') }}</h4>
					<p class="card-text">{{ __('Personal adminstrativo de la institución') }}</p>
					<a href="{{route('users.ad.index')}}" class="btn btn-primary"><i class="fas fa-users"></i> {{ __('Ver Usuarios') }}</a>
					<a href="{{route('users.ad.add')}}" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('Crear') }}</a>
				</div>
			</div>
		</div>
	@endhasanyrole
	@hasanyrole('superadmin|administrative|coordinator')
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Coordinadores') }}</h4>
					<p class="card-text">{{ __('Coordinadores de la institución') }}</p>
					<a href="#" class="btn btn-primary"><i class="fas fa-users"></i> {{ __('Ver Usuarios') }}</a>
					@hasanyrole('superadmin|administrative')
						<a href="#" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('Crear') }}</a>
					@endhasanyrole
				</div>
			</div>
		</div>
	@endhasanyrole
	@hasanyrole('superadmin|administrative|coordinator|teacher')
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Docentes') }}</h4>
					<p class="card-text">{{ __('Docentes de la institución') }}</p>
					<a href="#" class="btn btn-primary"><i class="fas fa-users"></i> {{ __('Ver Usuarios') }}</a>
					@hasanyrole('superadmin|administrative')
						<a href="#" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('Crear') }}</a>
					@endhasanyrole
				</div>
			</div>
		</div>
	@endhasanyrole
	@hasanyrole('superadmin|administrative|coordinator|teacher')
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Alumnos') }}</h4>
					<p class="card-text">{{ __('Alumnos de la institución') }}</p>
					<a href="#" class="btn btn-primary"><i class="fas fa-users"></i> {{ __('Ver Usuarios') }}</a>
					@hasanyrole('superadmin|administrative')
						<a href="#" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('Crear') }}</a>
					@endhasanyrole
				</div>
			</div>
		</div>
	@endhasanyrole
	@hasanyrole('superadmin|administrative|coordinator|teacher')
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Acudientes') }}</h4>
					<p class="card-text">{{ __('Acudientes de los alumnos') }}</p>
					<a href="#" class="btn btn-primary"><i class="fas fa-users"></i> {{ __('Ver Usuarios') }}</a>
					@hasanyrole('superadmin|administrative')
						<a href="#" class="btn btn-primary"><i class="fas fa-user-plus"></i> {{ __('Crear') }}</a>
					@endhasanyrole
				</div>
			</div>
		</div>
	@endhasanyrole	
</div>
@endsection