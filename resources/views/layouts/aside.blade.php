<div class="list-group list-group-flush">
	@hasanyrole('superadmin|administrative')
	<div class="list-group-item">
		<a href="{{route('options.index')}}"><i class="fas fa-cog"></i> {{ __('Configuración') }}</a>
	</div>
	@endhasanyrole
	@hasanyrole('superadmin|administrative|coordinator|teacher')
	<div class="list-group-item drdo closed">
		<a href="#"><i class="fas fa-users"></i> {{ __('Usuarios') }}</a>
		<div class="list-group list-group-flush">
			<div class="list-group-item"><a href="{{route('users.index')}}">{{ __('Usuarios') }}</a></div>
			@hasrole('superadmin')
			<div class="list-group-item"><a href="{{route('users.sa.index')}}">{{ __('Super Administradores') }}</a></div>
			@endhasrole
			@hasanyrole('superadmin|administrative')
			<div class="list-group-item"><a href="{{route('users.ad.index')}}">{{ __('Personal Administrativo') }}</a></div>
			@endhasanyrole
			@hasanyrole('superadmin|administrative|coordinator')
			<div class="list-group-item"><a href="#">{{ __('Coordinadores') }}</a></div>
			@endhasanyrole
			<div class="list-group-item"><a href="#">{{ __('Docentes') }}</a></div>
			<div class="list-group-item"><a href="#">{{ __('Alumnos') }}</a></div>
			<div class="list-group-item"><a href="#">{{ __('Acudientes') }}</a></div>
		</div>
	</div>
	@endhasanyrole
</div>