<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
        	<li class="nav-title">Menu</li>
        	@hasanyrole('superadmin|administrative')
            <li class="nav-item">
                <a class="nav-link active" href="{{route('options')}}">
                    <i class="nav-icon fas fa-cog"></i> {{ __('Configuración') }}
                </a>
            </li>
            @endhasanyrole
            @hasanyrole('superadmin|administrative|coordinator|teacher')
            <li class="nav-item nav-dropdown">
            	<a class="nav-link nav-dropdown-toggle" href="#">
					<i class="nav-icon fas fa-users"></i> {{ __('Usuarios') }}
				</a>
				<ul class="nav-dropdown-items">
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.index')}}">{{ __('Usuarios') }}</a>
					</li>
					@hasrole('superadmin')
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.sa')}}">{{ __('Super Administradores') }}</a>
					</li>
					@endhasrole
					@hasanyrole('superadmin|administrative')
					<li class="nav-item">
						<a class="nav-link" href="{{route('users.ad.index')}}">{{ __('Personal Administrativo') }}</a>
					</li>
					@endhasanyrole
					@hasanyrole('superadmin|administrative|coordinator')
					<li class="nav-item">
						<a class="nav-link" href="#">{{ __('Coordinadores') }}</a>
					</li>
					@endhasanyrole
					<li class="nav-item">
						<a class="nav-link" href="#">{{ __('Docentes') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">{{ __('Alumnos') }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">{{ __('Acudientes') }}</a>
					</li>
				</ul>
            </li>
            @endhasanyrole
        </ul>
    </nav>
</div>
