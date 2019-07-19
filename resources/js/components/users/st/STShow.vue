<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10 col-xl-9">
                <div class="card-header px-0 mt-2 bg-transparent clearfix">
                    <h4 class="float-left pt-2">Perfil</h4>
                    <div class="card-header-actions mr-1">
                        <a :href="route('users.st.edit', user.id)" class="btn btn-primary" title="Editar usuario"><i class="fas fa-edit"></i><span class="d-md-down-none ml-1">Editar</span></a>
                        <a href="#" @click.prevent="deleteUser(user.id)" class="btn btn-link text-danger" title="Eliminar usuario"><i class="fas fa-trash-alt"></i><span class="d-md-down-none ml-1">Eliminar</span></a>
                    </div>
                </div>
                <div class="card-body px-0 pb-5 mb-5">
                    <img v-if="!user.photo" src="/storage/images/photos/default-avatar.png" class="rounded-circle mx-auto d-block" width="200" height="200" alt="#">
                    <img v-else :src="'/storage/images/photos/'+user.photo" class="rounded-circle mx-auto d-block" width="200" height="200" alt="#">
                    <h2 class="text-center mt-3 mb-1">{{user.first_name}} {{user.last_name}}</h2>
                    <h3 class="text-center mb-4">
                        <span v-if="user.status == 'enabled'" class="badge badge-success"><i class="far fa-check-circle"></i> Habilitado</span>
                        <span v-else-if="user.status == 'disabled'" class="badge badge-danger"><i class="far fa-times-circle"></i> Inhabilitado</span>
                    </h3>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#student" role="tab">Alumno</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content border-0">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <h4 class="mb-4"><i class="far fa-user-circle"></i> Información personal</h4>
                                            <dl class="row">
                                                <template v-if="userroles.includes('superadmin') || userroles.includes('administrative')">
                                                    <dt class="col-4 text-right">Identificación: </dt>
                                                    <dd class="col-8">
                                                        <template v-if="user.it == 'RC'">Registro Civil: </template>
                                                        <template v-else-if="user.it == 'TI'">Tarjeta de Identidad: </template>
                                                        <template v-else-if="user.it == 'CC'">Cédula de Ciudadanía: </template>
                                                        <template v-else-if="user.it == 'CE'">Cédula de Extranjería: </template>
                                                        <template v-else-if="user.it == 'PB'">Pasaporte: </template>
                                                        <template v-else-if="user.it == 'NI'">Nit: </template>
                                                        {{user.nid}}
                                                    </dd>
                                                </template>
                                                <template v-if="user.email">
                                                    <dt class="col-4 text-right">Correo electrónico: </dt>
                                                    <dd class="col-8">{{user.email}}</dd>
                                                </template>
                                                <template v-if="user.birth_date">
                                                    <dt class="col-4 text-right">Edad: </dt>
                                                    <dd class="col-8">{{[user.birth_date, "YYYY-MM-DD HH:mm:ss"] | moment("from", "now", true)}} - {{[user.birth_date, "YYYY-MM-DD HH:mm:ss"] | moment("LL")}}</dd>
                                                </template>
                                                <template v-if="user.gender">
                                                    <dt class="col-4 text-right">Género: </dt>
                                                    <dd class="col-8">
                                                        <template v-if="user.gender == 'm'">Masculino</template>
                                                        <template v-else-if="user.gender == 'f'">Femenino</template>
                                                    </dd>
                                                </template>
                                                <template v-if="user.phone_number">
                                                    <dt class="col-4 text-right">Teléfono fijo: </dt>
                                                    <dd class="col-8">{{user.phone_number}}</dd>
                                                </template>
                                                <template v-if="user.cellphone_number">
                                                    <dt class="col-4 text-right">Teléfono móvil: </dt>
                                                    <dd class="col-8">{{user.cellphone_number}}</dd>
                                                </template>
                                                <template v-if="user.nacionality">
                                                    <dt class="col-4 text-right">Nacionalidad: </dt>
                                                    <dd class="col-8">{{countries[user.nacionality]}}</dd>
                                                </template>
                                                <template v-if="user.location">
                                                    <dt class="col-4 text-right">Ubicación: </dt>
                                                    <dd class="col-8">{{user.location}}</dd>
                                                </template>
                                                <template v-if="user.address">
                                                    <dt class="col-4 text-right">Dirección: </dt>
                                                    <dd class="col-8">{{user.address}}</dd>
                                                </template>
                                            </dl>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <h4 class="mb-4"><i class="fas fa-user-cog"></i> Información de la cuenta</h4>
                                            <dl class="row">
                                                <dt class="col-4 text-right">Rol: </dt>
                                                <dd class="col-8">
                                                    <template v-for="(role, index) in user.roles">
                                                        {{role.display_name}}<span v-if="index+1 < user.roles.length">, </span>
                                                    </template>
                                                </dd>
                                                <dt class="col-4 text-right">Registrado: </dt>
                                                <dd class="col-8">{{[user.created_at, "YYYY-MM-DD HH:mm:ss"] | moment("LLL")}}</dd>
                                                <dt class="col-4 text-right">Último acceso: </dt>
                                                <dd class="col-8">{{[user.last_access, "YYYY-MM-DD HH:mm:ss"] | moment("LLL")}}</dd>
                                                <dt class="col-4 text-right">Estado: </dt>
                                                <dd class="col-8">
                                                    <template v-if="user.status == 'enabled'">Habilitado</template>
                                                    <template v-else-if="user.status == 'disabled'">Inhabilitado</template>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="student" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-10 mb-2">
                                            <h4 class="mb-4"><i class="fas fa-user-graduate"></i> Información del alumno</h4>
                                            <dl class="row">
                                                <template v-if="user.student.neighborhood">
                                                    <dt class="col-3 text-right">Barrio: </dt>
                                                    <dd class="col-9">{{user.student.neighborhood}}</dd>
                                                </template>
                                                <template v-if="user.student.commune">
                                                    <dt class="col-3 text-right">Comuna / Localidad: </dt>
                                                    <dd class="col-9">{{user.student.commune}}</dd>
                                                </template>
                                                <template v-if="user.student.socioeconomic_level">
                                                    <dt class="col-3 text-right">Nivel Socioeconómico: </dt>
                                                    <dd class="col-9">{{user.student.socioeconomic_level}}</dd>
                                                </template>
                                                <template v-if="user.student.health_care">
                                                    <dt class="col-3 text-right">Entidad de salud: </dt>
                                                    <dd class="col-9" v-html="user.student.health_care"></dd>
                                                </template>
                                                <template v-if="user.student.blood_type">
                                                    <dt class="col-3 text-right">Tipo de Sangre: </dt>
                                                    <dd class="col-9" v-html="user.student.blood_type"></dd>
                                                </template>
                                                <template v-if="user.student.allergies">
                                                    <dt class="col-3 text-right">Alergias: </dt>
                                                    <dd class="col-9" v-html="user.student.allergies"></dd>
                                                </template>
                                                <template v-if="user.student.diseases">
                                                    <dt class="col-3 text-right">Enfermedades: </dt>
                                                    <dd class="col-9" v-html="user.student.diseases"></dd>
                                                </template>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'countries', 'userroles'],
        data(){
            return {
                auth: false,
                submiting: false,
            }
        },
        methods: {
            deleteUser(userid) {
                if (!this.submiting) {
                        this.submiting = true;
                        swal({
                            title: "¿Desea eliminar este usuario?",
                            text: "¡Una vez eliminado, no podrá recuperar este usuario!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                axios.post(route('api.users.st.destroy', userid))
                                .then(response => {
                                    this.submiting = false;
                                    this.$toasted.global.error(response.data.message,
                                        { 
                                            duration: 2500,
                                            onComplete: window.location.assign(route('users.st.index'))
                                        }
                                    );
                                });
                            }else {
                                this.submiting = false;
                            }
                        });
                    
                }
            }
        }
    }
</script>
