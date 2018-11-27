@extends('layouts.app')
@section('title', 'Usuarios')
@section('breadcrumbs-seo', Breadcrumbs::view('breadcrumbs::json-ld', 'users'))
@section('breadcrumbs', Breadcrumbs::render('users'))
@section('content')
<div class="container">
    <div class="card-body px-0">
		<div class="row justify-content-between">
			@hasrole('superadmin')
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-body">
							<h4 class="card-title">{{ __('Super administradores') }}</h4>
							<p class="card-text">{{ __('Administradores de la plataforma') }}</p>
						</div>
						<div class="card-footer bg-transparent d-flex justify-content-between">
							<a href="{{route('users.sa')}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i> {{ __('Ver usuarios') }}</a>
							<a href="{{route('users.sa.add')}}" class="btn btn-sm btn-outline-success"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
						</div>
					</div>
				</div>
			@endhasrole
			@hasanyrole('superadmin|administrative')
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-body">
							<h4 class="card-title">{{ __('Personal administrativo') }}</h4>
							<p class="card-text">{{ __('Personal adminstrativo de la institución') }}</p>
						</div>
						<div class="card-footer bg-transparent d-flex justify-content-between">
							<a href="{{route('users.ad.index')}}" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i> {{ __('Ver usuarios') }}</a>
							<a href="{{route('users.ad.add')}}" class="btn btn-sm btn-outline-success"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
						</div>
					</div>
				</div>
			@endhasanyrole
			@hasanyrole('superadmin|administrative|coordinator')
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-body">
							<h4 class="card-title">{{ __('Coordinadores') }}</h4>
							<p class="card-text">{{ __('Coordinadores de la institución') }}</p>
						</div>
						<div class="card-footer bg-transparent d-flex justify-content-between">
							<a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i> {{ __('Ver usuarios') }}</a>
							@hasanyrole('superadmin|administrative')
								<a href="#" class="btn btn-sm btn-outline-success"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
							@endhasanyrole
						</div>
					</div>
				</div>
			@endhasanyrole
			@hasanyrole('superadmin|administrative|coordinator|teacher')
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-body">
							<h4 class="card-title">{{ __('Docentes') }}</h4>
							<p class="card-text">{{ __('Docentes de la institución') }}</p>
						</div>
						<div class="card-footer bg-transparent d-flex justify-content-between">
							<a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i> {{ __('Ver usuarios') }}</a>
							@hasanyrole('superadmin|administrative')
								<a href="#" class="btn btn-sm btn-outline-success"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
							@endhasanyrole
						</div>
					</div>
				</div>
			@endhasanyrole
			@hasanyrole('superadmin|administrative|coordinator|teacher')
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-body">
							<h4 class="card-title">{{ __('Alumnos') }}</h4>
							<p class="card-text">{{ __('Alumnos de la institución') }}</p>
						</div>
						<div class="card-footer bg-transparent d-flex justify-content-between">
							<a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i> {{ __('Ver usuarios') }}</a>
							@hasanyrole('superadmin|administrative')
								<a href="#" class="btn btn-sm btn-outline-success"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
							@endhasanyrole
						</div>
					</div>
				</div>
			@endhasanyrole
			@hasanyrole('superadmin|administrative|coordinator|teacher')
				<div class="col-md-4">
					<div class="card text-center">
						<div class="card-body">
							<h4 class="card-title">{{ __('Acudientes') }}</h4>
							<p class="card-text">{{ __('Acudientes de los alumnos') }}</p>
						</div>
						<div class="card-footer bg-transparent d-flex justify-content-between">
							<a href="#" class="btn btn-sm btn-outline-primary"><i class="fas fa-users"></i> {{ __('Ver usuarios') }}</a>
							@hasanyrole('superadmin|administrative')
								<a href="#" class="btn btn-sm btn-outline-success"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
							@endhasanyrole
						</div>
					</div>
				</div>
			@endhasanyrole	
		</div>
	</div>
</div>
@endsection
