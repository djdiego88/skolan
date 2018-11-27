<template>
    <div class="container">
        <div class="card-header px-0 mt-2 bg-transparent clearfix">
            <h4 class="float-left pt-2">Super Administradores</h4>
            <div class="card-header-actions mr-1">
                <a class="btn btn-success" :href="route('users.sa.add')" title="Añadir usuario">
                    <i class="fas fa-user-plus"></i>
                    <span class="d-md-down-none ml-1">Añadir usuario</span>
                </a>
            </div>
        </div>
        <div class="card-body px-0">
            <div class="row justify-content-between">
                <div class="col-7 col-md-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" @click="filter">
                            <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Buscar" v-model.trim="filters.search" @keyup.enter="filter">
                    </div>
                </div>
                <div class="col-auto col-md-2">
                    <multiselect
                    v-model="action"
                    :options="actions"
                    :searchable="false"
                    :show-labels="false"
                    :allow-empty="true"
                    :disabled="submiting"
                    track-by="value"
                    label="label"
                    @select="changeAction"
                    placeholder="Acciones en Lote">
                    </multiselect>
                </div>
                <div class="col-auto col-md-3">
                    <multiselect
                    v-model="status"
                    :options="estados"
                    :searchable="false"
                    :show-labels="false"
                    :allow-empty="true"
                    :disabled="submiting"
                    track-by="value"
                    label="label"
                    @select="changeStatus"
                    placeholder="Cambiar Estado a...">
                    </multiselect>
                </div>
                <div class="col-auto">
                    <multiselect
                    v-model="filters.pagination.per_page"
                    :options="[25,50,100,200]"
                    :searchable="false"
                    :show-labels="false"
                    :allow-empty="false"
                    @select="changeSize"
                    placeholder="Buscar">
                    </multiselect>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline">
                    <thead class="thead-light">
                        <tr>
                            <th class="d-none d-sm-table-cell text-center">
                                <label for="check-all" class="sr-only">Seleccionar todos</label>
                                <input id="check-all" type="checkbox" v-model="selectAll">
                            </th>
                            <th scope="col">
                                <a href="#" class="text-dark" @click.prevent="sort('users.first_name')">Nombre</a>
                                <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'users.first_name' && filters.orderBy.direction == 'ASC', 'fa-long-arrow-alt-up': filters.orderBy.column == 'users.first_name' && filters.orderBy.direction == 'DESC'}"></i>
                            </th>
                            <th  class="text-center" scope="col">
                                <a href="#" class="text-dark" @click.prevent="sort('users.last_access')">Último acceso</a>
                                <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'users.last_access' && filters.orderBy.direction == 'ASC', 'fa-long-arrow-alt-up': filters.orderBy.column == 'users.last_access' && filters.orderBy.direction == 'DESC'}"></i>
                            </th>
                            <th class="text-center" scope="col">Estado</th>
                            <th class="text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td class="d-none d-sm-table-cell text-center">
                                <template v-if="user.id != 1">
                                    <label for="usersids" class="sr-only">Seleccionar usuario</label>
                                    <input name="usersids" type="checkbox" :value="user.id" v-model="usersids" number>
                                </template>
                            </td>
                            <td><a class="text-dark" :href="route('users.sa.show', user.id)" :title="'Ver más datos de '+user.first_name+' '+user.last_name">{{user.first_name+' '+user.last_name}}</a></td>
                            <td class="text-center">{{ user.last_access | moment("from") }}</td>
                            <td class="text-center">
                                <span v-if="user.status == 'enabled'" class="badge badge-success">Habilitado</span>
                                <span v-else-if="user.status == 'disabled'" class="badge badge-danger">Inhabilitado</span>
                                <span v-else class="badge badge-secondary">Otro</span>
                            </td>
                            <td class="text-center">
                                <template v-if="user.id != 1">
                                    <a :href="route('users.sa.edit', user.id)" class="btn btn-sm btn-link text-muted" :title="'Editar datos de '+user.first_name+' '+user.last_name"><i class="fas fa-edit"></i></a><a href="#" @click.prevent="deleteUser(user.id)" class="btn btn-sm btn-link text-danger" :title="'Eliminar a '+user.first_name+' '+user.last_name" :disabled="submiting"><i class="fas fa-trash-alt"></i></a>
                                </template>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row" v-if='!loading && filters.pagination.total > 0'>
                <div class="col pt-2">
                    {{filters.pagination.from}}-{{filters.pagination.to}} de {{filters.pagination.total}}
                </div>
                <div class="col" v-if="filters.pagination.last_page>1">
                    <pagination :data="filters.pagination" @pagination-change-page="getUsers"></pagination>
                </div>
            </div>
            <div class="no-items-found text-center mt-5" v-if="!loading && !users.length > 0">
                <i class="icon-magnifier fa-3x text-muted"></i>
                <p class="mb-0 mt-3"><strong>No se han encontrado resultados</strong></p>
                <p class="text-muted">Trate de cambiar los filtros o añada un nuevo usuario</p>
                <a class="btn btn-success" :href="route('users.sa.add')" role="button">
                    <i class="fas fa-user-plus"></i>&nbsp; Añadir usuario
                </a>
            </div>
            <content-placeholders v-if="loading">
                <content-placeholders-text/>
            </content-placeholders>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                action: null,
                status:null,
                users: {},
                actions: [
                    { label: 'Borrar', value: 'delete' }
                ],
                estados: [
                    { label: 'Habilitado', value: 'enabled' },
                    { label: 'Inhabilitado', value: 'disabled' }
                ],
                filters: {
                    pagination: {
                        from: 0,
                        to: 0,
                        total: 0,
                        per_page: 25,
                        current_page: 1,
                        last_page: 0,
                        next_page_url: null,
                        prev_page_url: null
                    },
                    orderBy: {
                        column: 'users.first_name',
                        direction: 'ASC'
                    },
                    search: ''
                },
                usersids: [],
                loading: true,
                submiting: false
            }
        },
        computed: {
            selectAll: {
                get: function () {
                    return this.users ? this.usersids.length == this.users.length : false;
                },
                set: function (value) {
                    var selected = [];

                    if (value) {
                        this.users.forEach(function (user) {
                            selected.push(user.id);
                        });
                    }

                    this.usersids = selected;
                }
            }
        },
        mounted() {
            if (localStorage.getItem("filtersTableUsersSA")) {
                this.filters = JSON.parse(localStorage.getItem("filtersTableUsersSA"));
            } else {
                localStorage.setItem("filtersTableUsersSA", JSON.stringify(this.filters));
            }
            this.getUsers();
        },
        methods: {
            sort (column) {
                if(column == this.filters.orderBy.column) {
                    this.filters.orderBy.direction = this.filters.orderBy.direction == 'ASC' ? 'DESC' : 'ASC';
                } else {
                    this.filters.orderBy.column = column;
                    this.filters.orderBy.direction = 'ASC';
                }
                this.getUsers();
            },
            changeAction(action) {
                if (!this.submiting) {
                    this.submiting = true;
                    if(this.usersids.length == 0){
                        swal("¡Debe seleccionar usuarios para poder ejecutar esta acción!");
                        this.submiting = false;
                    }else{
                        if(action.value == 'delete'){
                            this.action = action.value;
                            swal({
                                title: "¿Desea eliminar estos usuarios?",
                                text: "¡Una vez eliminados, no podrá recuperar estos usuarios!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    axios.post(route('users.sa.masschanges'), {
                                        users: this.usersids,
                                        action: this.action
                                    })
                                    .then(response => {
                                        this.getUsers();
                                        this.submiting = false;
                                        this.$toasted.global.error(response.data.message);
                                    })
                                    .catch(error => {
                                        console.log(error);
                                        this.submiting = false;
                                        this.$toasted.global.error(error.data.message);
                                    });
                                }else{
                                    this.submiting = false;
                                }
                            });
                        }
                    }
                }
            },
            changeStatus(status) {
                if (!this.submiting) {
                    this.submiting = true;
                    if(this.usersids.length == 0){
                        swal("¡Debe seleccionar usuarios para poder cambiarles el estado!");
                        this.submiting = false;
                    }else{
                        this.status = status.value;
                        axios.post(route('users.sa.masschanges'), {
                            users: this.usersids,
                            status: this.status
                        })
                        .then(response => {
                            this.getUsers();
                            this.submiting = false;
                            this.$toasted.global.error(response.data.message);
                        })
                        .catch(error => {
                            console.log(error);
                            this.submiting = false;
                            this.$toasted.global.error(error.data.message);
                        });
                    }
                }
            },
            getUsers(page = 1) {
                this.loading = true;
                this.users = {};
                this.action = null;
                this.status = null;
                localStorage.setItem("filtersTableUsersSA", JSON.stringify(this.filters));
                axios.post(route('users.sa.index'), this.filters, {params: {page: page}})
                .then(response => {
                    this.filters.pagination = response.data.users;
                    this.users = response.data.users.data;
                    this.userscount = response.data.users.total;
                    this.loading = false;
                });
            },
            filter() {
                this.filters.pagination.current_page = 1
                this.getUsers()
            },
            editUser (userId) {
                location.href = route('users.sa.edit', userId);
            },
            showUser (userId) {
                location.href = route('users.sa.show', userId);
            },
            changeSize (perPage) {
                this.filters.pagination.current_page = 1
                this.filters.pagination.per_page = perPage
                this.getUsers()
            },
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
                                axios.post(route('users.sa.destroy', userid))
                                .then(response => {
                                    this.getUsers();
                                    this.submiting = false;
                                    this.$toasted.global.error(response.data.message);
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
