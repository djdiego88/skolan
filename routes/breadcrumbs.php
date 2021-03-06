<?php

// Inicio
Breadcrumbs::for(
    'home', function ($trail) {
        $trail->push(__('Inicio'), url('/'));
    }
);

// Inicio > Configuración
Breadcrumbs::for(
    'configs', function ($trail) {
        $trail->parent('home');
        $trail->push(__('Configuración'), route('options.index'));
    }
);

// Inicio > Usuarios
Breadcrumbs::for(
    'users', function ($trail) {
        $trail->parent('home');
        $trail->push(__('Usuarios'), route('users.index'));
    }
);

// Inicio > Usuarios > Super Administradores
Breadcrumbs::for(
    'superadmins', function ($trail) {
        $trail->parent('users');
        $trail->push(__('Super Administradores'), route('users.sa'));
    }
);

// Inicio > Usuarios > Super Administradores > Añadir Usuario
Breadcrumbs::for(
    'add-sa', function ($trail) {
        $trail->parent('superadmins');
        $trail->push(__('Añadir Usuario'), route('users.sa.add'));
    }
);

// Inicio > Usuarios > Super Administradores > <Usuario>
Breadcrumbs::for(
    'show-sa', function ($trail, $user) {
        $trail->parent('superadmins');
        $trail->push($user->first_name.' '.$user->last_name, route('users.sa.show', $user->id));
    }
);

// Inicio > Usuarios > Super Administradores > Editar: <Usuario>
Breadcrumbs::for(
    'edit-sa', function ($trail, $user) {
        $trail->parent('superadmins');
        $trail->push('Editar: '.$user->first_name.' '.$user->last_name, route('users.sa.edit', $user->id));
    }
);

// Inicio > Usuarios > Personal Administrativo
Breadcrumbs::for(
    'admins', function ($trail) {
        $trail->parent('users');
        $trail->push(__('Personal Administrativo'), route('users.ad.index'));
    }
);

// Inicio > Usuarios > Personal Administrativo > Añadir Usuario
Breadcrumbs::for(
    'add-ad', function ($trail) {
        $trail->parent('admins');
        $trail->push(__('Añadir Usuario'), route('users.ad.add'));
    }
);

// Inicio > Usuarios > Personal Administrativo > <Usuario>
Breadcrumbs::for(
    'show-ad', function ($trail, $user) {
        $trail->parent('admins');
        $trail->push($user->first_name.' '.$user->last_name, route('users.ad.show', $user->id));
    }
);

// Inicio > Usuarios > Personal Administrativo > Editar: <Usuario>
Breadcrumbs::for(
    'edit-ad', function ($trail, $user) {
        $trail->parent('admins');
        $trail->push('Editar: '.$user->first_name.' '.$user->last_name, route('users.ad.edit', $user->id));
    }
);

// Inicio > Usuarios > Coordinadores
Breadcrumbs::for(
    'coordinators', function ($trail) {
        $trail->parent('users');
        $trail->push(__('Coordinadores'), route('users.co.index'));
    }
);

// Inicio > Usuarios > Coordinadores > Añadir Usuario
Breadcrumbs::for(
    'add-co', function ($trail) {
        $trail->parent('coordinators');
        $trail->push(__('Añadir Usuario'), route('users.co.add'));
    }
);

// Inicio > Usuarios > Coordinadores > <Usuario>
Breadcrumbs::for(
    'show-co', function ($trail, $user) {
        $trail->parent('coordinators');
        $trail->push($user->first_name.' '.$user->last_name, route('users.co.show', $user->id));
    }
);

// Inicio > Usuarios > Coordinadores > Editar: <Usuario>
Breadcrumbs::for(
    'edit-co', function ($trail, $user) {
        $trail->parent('coordinators');
        $trail->push('Editar: '.$user->first_name.' '.$user->last_name, route('users.co.edit', $user->id));
    }
);

// Inicio > Usuarios > Docentes
Breadcrumbs::for(
    'teacher', function ($trail) {
        $trail->parent('users');
        $trail->push(__('Docentes'), route('users.te.index'));
    }
);

// Inicio > Usuarios > Docentes > Añadir Usuario
Breadcrumbs::for(
    'add-te', function ($trail) {
        $trail->parent('teacher');
        $trail->push(__('Añadir Usuario'), route('users.te.add'));
    }
);

// Inicio > Usuarios > Docentes > <Usuario>
Breadcrumbs::for(
    'show-te', function ($trail, $user) {
        $trail->parent('teacher');
        $trail->push($user->first_name.' '.$user->last_name, route('users.te.show', $user->id));
    }
);

// Inicio > Usuarios > Docentes > Editar: <Usuario>
Breadcrumbs::for(
    'edit-te', function ($trail, $user) {
        $trail->parent('teacher');
        $trail->push('Editar: '.$user->first_name.' '.$user->last_name, route('users.te.edit', $user->id));
    }
);

// Inicio > Usuarios > Alumnos
Breadcrumbs::for(
    'student', function ($trail) {
        $trail->parent('users');
        $trail->push(__('Alumnos'), route('users.st.index'));
    }
);

// Inicio > Usuarios > Alumnos > Añadir Usuario
Breadcrumbs::for(
    'add-st', function ($trail) {
        $trail->parent('student');
        $trail->push(__('Añadir Usuario'), route('users.st.add'));
    }
);

// Inicio > Usuarios > Alumnos > <Usuario>
Breadcrumbs::for(
    'show-st', function ($trail, $user) {
        $trail->parent('student');
        $trail->push($user->first_name.' '.$user->last_name, route('users.st.show', $user->id));
    }
);

// Inicio > Usuarios > Alumnos > Editar: <Usuario>
Breadcrumbs::for(
    'edit-st', function ($trail, $user) {
        $trail->parent('student');
        $trail->push('Editar: '.$user->first_name.' '.$user->last_name, route('users.st.edit', $user->id));
    }
);
