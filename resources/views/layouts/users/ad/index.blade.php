@extends('layouts.app')
@section('title','Personal Administrativo')
@section('content')
<div class="user-buttons clearfix">
	<a href="{{route('users.ad.add')}}" class="btn btn-secondary active btn-sm"><i class="fas fa-user-plus"></i> {{ __('Añadir usuario') }}</a>
</div>
<div class="tablenav clearfix">
	{!! Form::open(['route' => 'users.ad.index', 'method' => 'GET', 'class' => 'float-sm-right']); !!}
	<div class="input-group">
		{!! Form::text('name',null,['class'=>'form-control form-control-sm','placeholder'=>'Buscar usuarios','ariadescribedby'=>'search','required']); !!}
		<div class="input-group-append">
			<button type="submit" class="btn btn-secondary active btn-sm"><i class="fas fa-search"></i></button>
	    </div>
	</div>
	{!! Form::close() !!}
</div>
{!! Form::open(['route' => 'users.ad.masschanges', 'method' => 'POST']); !!}
	<div class="row">
		<div class="col-sm-3">
			<div class="input-group">
				{!! Form::select('action',['delete'=>'Borrar'],null,['class'=>'form-control form-control-sm select-action', 'placeholder'=>'Acciones en Lote']); !!}
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary active btn-sm" onclick="return confirm('¿Deseas eliminar a los usuarios seleccionados?');">{{ __('Aplicar') }}</button>
			    </div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="input-group">
				{!! Form::select('status',['enabled'=>'Habilitado', 'disabled'=>'Inhabilitado'],null,['class'=>'form-control form-control-sm select-status', 'placeholder'=>'Cambiar Estado a...']); !!}
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary active btn-sm">{{ __('Cambiar') }}</button>
			    </div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-offset-3">
			<div class="text-sm-right">{{count($users)}} elementos</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-bordered table-sm">
			<thead class="thead-dark">
				<tr>
					<th>
						{!! Form::label('check-all','Seleccionar todos',['class'=>'sr-only']); !!}
						<input id="check-all" type="checkbox">
					</th>
					<th scope="col">{{ __('Nombre') }}</th>
					<th scope="col">{{ __('Último acceso') }}</th>
					<th scope="col">{{ __('Estado') }}</th>
					<th scope="col">{{ __('Acciones') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
			<?php
				foreach($user->usermeta as $displayname){
					$name = $displayname->value;
				}
			?>
				<tr>
					<th scope="row">
						@if($user->id != 1)
							{!! Form::label('users','Seleccionar todos',['class'=>'sr-only']); !!}
							{!! Form::checkbox('users[]', $user->id) !!}
						@endif
					</th>
					<td><a href="{{route('users.ad.show', $user->id)}}" title="Ver más datos de {{$name}}">{{$name}}</a></td>
					<td>{{$user->last_access->diffForHumans()}}</td>
					<td>
						@if($user->status == 'enabled')
							<span class="badge badge-success">{{ __('Habilitado') }}</span>
						@elseif($user->status == 'disabled')
							<span class="badge badge-danger">{{ __('Inhabilitado') }}</span>
						@else
							<span class="badge badge-secondary">{{ __('Otro') }}</span>
						@endif
					</td>
					<td>
					@if($user->id != 1)
						<a href="{{route('users.ad.edit', $user->id)}}" class="btn btn-sm btn-warning" title="Editar datos de {{$name}}"><i class="fas fa-edit"></i></a><a href="{{route('users.ad.destroy', $user->id)}}" onclick="return confirm('¿Deseas eliminar este Super Administrador?');" class="btn btn-sm btn-danger" title="Eliminar a {{$name}}"><i class="fas fa-times"></i></a>
					@endif
					</td>
				</tr>
			@endforeach	
			</tbody>
			<tfoot class="thead-dark">
				<tr>
					<th>
						{!! Form::label('check-all','Seleccionar todos',['class'=>'sr-only']); !!}
						<input id="check-all" type="checkbox">
					</th>
					<th>{{ __('Nombre') }}</th>
					<th>{{ __('Último acceso') }}</th>
					<th>{{ __('Estado') }}</th>
					<th>{{ __('Acciones') }}</th>
				</tr>
			</tfoot>
		</table>
	</div>
{!! Form::close() !!}
{!! $users->links() !!}
@endsection
@section('js')
<script>
$("#check-all").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
@endsection