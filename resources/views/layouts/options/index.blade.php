@extends('layouts.app')
@section('title', 'Opciones Generales')
@section('content')
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#general" role="tab">{{ __('Generales') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#styles" role="tab">{{ __('Estilos') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#social" role="tab">{{ __('Redes Sociales') }}</a>
		</li>
	</ul>

	<!-- Tab panes -->
	{!! Form::open(['route' => 'options.update', 'method' => 'PUT', 'files' => true]); !!}
	<div class="tab-content">
		<div class="tab-pane fade show active" id="general" role="tabpanel">
			@foreach($options as $option)
				@if($option->name == 'site_name')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::text($option->name,$option->value,['class'=>'form-control','required']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
				@if($option->name == 'site_description')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::textarea($option->name,$option->value,['class'=>'form-control', 'rows'=>'4', 'required']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
				@if($option->name == 'admin_email')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::email($option->name,$option->value,['class'=>'form-control','required']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
				@if($option->name == 'items_per_page')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-3">
								{!! Form::number($option->name,$option->value,['class'=>'form-control', 'min'=>'1', 'max'=> '70', 'required']); !!}
							</div>
							<div class="col-sm-12">
								<small class="form-text text-muted">{{$option->description}}</small>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if($option->name == 'google_analytics_id')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::text($option->name,$option->value,['class'=>'form-control']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
			@endforeach
			<div class="form-group">
				{!! Form::submit('Actualizar',['class'=>'btn btn-primary']); !!}
			</div>
		</div>
		<div class="tab-pane fade" id="styles" role="tabpanel">
			@foreach($options as $option)
				@if($option->name == 'site_logo')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
					<img src="{{asset($option->value)}}" class="img-fluid img-thumbnail">
						{!! Form::file($option->name,['class'=>'form-control-file']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
				@if($option->name == 'site_style')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
					<div class="row">
					@foreach($styles as $key => $value)
						<label class="col-sm-3">
							{!! Form::radio($option->name, $key, ($option->value == $key) ? true : false) !!} {{$value}} <br>
							<img src="{{asset('storage/images/styles/'.$key.'.jpg')}}" class="img-fluid img-thumbnail">
						</label>
					@endforeach
					</div>
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
			@endforeach
			<div class="form-group">
				{!! Form::submit('Actualizar',['class'=>'btn btn-primary']); !!}
			</div>
		</div>
		<div class="tab-pane fade" id="social" role="tabpanel">
			@foreach($options as $option)
				@if($option->name == 'twitter_account')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-4">
								{!! Form::text($option->name,$option->value,['class'=>'form-control']); !!}
							</div>
							<div class="col-sm-12">
								<small class="form-text text-muted">{{$option->description}}</small>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if($option->name == 'facebook_url')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::text($option->name,$option->value,['class'=>'form-control']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
				@if($option->name == 'google_url')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::text($option->name,$option->value,['class'=>'form-control']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
				@if($option->name == 'instagram_account')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-4">
								{!! Form::text($option->name,$option->value,['class'=>'form-control']); !!}
							</div>
							<div class="col-sm-12">
								<small class="form-text text-muted">{{$option->description}}</small>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if($option->name == 'youtube_url')
				<div class="form-group row">
					{!! Form::label($option->name,$option->display_name, ['class'=>'col-sm-3 col-form-label']); !!}
					<div class="col-sm-9">
						{!! Form::text($option->name,$option->value,['class'=>'form-control']); !!}
						<small class="form-text text-muted">{{$option->description}}</small>
					</div>
				</div>
				@endif
			@endforeach
			<div class="form-group">
				{!! Form::submit('Actualizar',['class'=>'btn btn-primary']); !!}
			</div>
		</div>
	</div>
	{!! Form::close(); !!}
@endsection