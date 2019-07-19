<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9 col-xl-7">
                <div class="card-header px-0 mt-2 bg-transparent clearfix">
                    <h4 class="float-left pt-2">Añadir usuario</h4>
                    <div class="card-header-actions mr-1">
                        <a v-if="step > 1" class="btn btn-secondary" href="#" :disabled="submiting" @click.prevent="prev">
                            <i class="fas fa-angle-left"></i>
                            <span class="ml-1">Anterior</span>
                        </a>
                        <a v-if="step >= 1 && step !== totalsteps" class="btn btn-secondary" href="#" :disabled="submiting" @click.prevent="next">
                            <span class="mr-1">Siguiente</span>
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a v-if="step === totalsteps" class="btn btn-primary" href="#" :disabled="submiting" @click.prevent="create">
                            <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
                            <i class="fas fa-save" v-else></i>
                            <span class="ml-1">Guardar</span>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pb-5 mb-5">
                    <form accept-charset="UTF-8" enctype="multipart/form-data">
                        <template v-if="step === 1">
                            <div class="form-group required row">
                                <label for="first_name" class="col-sm-3 col-form-label">Nombres:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="first_name" id="first_name" v-model="user.first_name" class="form-control" :class="{'is-invalid': errors.first_name}" placeholder="Nombres del usuario" required>
                                    <div class="invalid-feedback" v-if="errors.first_name">{{errors.first_name[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="last_name" class="col-sm-3 col-form-label">Apellidos:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="last_name" id="last_name" v-model="user.last_name" class="form-control" :class="{'is-invalid': errors.last_name}" placeholder="Apellidos del usuario" required>
                                    <div class="invalid-feedback" v-if="errors.last_name">{{errors.last_name[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="it" class="col-sm-3 col-form-label">Tipo de Identificación:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.it"
                                    :options="it"
                                    :searchable="false"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    :disabled="submiting"
                                    track-by="value"
                                    label="label"
                                    placeholder="Tipo de identificación"
                                    :class="{'border border-danger rounded': errors.it}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.it">{{errors.it[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="nid" class="col-sm-3 col-form-label">Número de Identificación:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nid" id="nid" v-model="user.nid" class="form-control" :class="{'is-invalid': errors.nid}" placeholder="Número de identificación" required>
                                    <div class="invalid-feedback" v-if="errors.nid">{{errors.nid[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="password" class="col-sm-3 col-form-label">Contraseña:</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" v-model="user.password" class="form-control" :class="{'is-invalid': errors.password}" placeholder="Mínimo 8 caracteres" required>
                                    <div class="invalid-feedback" v-if="errors.password">{{errors.password[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Correo Electrónico:</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" id="email" v-model="user.email" class="form-control" :class="{'is-invalid': errors.email}" placeholder="Correo Electrónico">
                                    <div class="invalid-feedback" v-if="errors.email">{{errors.email[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="birth_date" class="col-sm-3 col-form-label">Fecha de Nacimiento:</label>
                                <div class="col-sm-9">
                                    <datepicker :language="es" v-model="user.birth_date" :input-class="{'is-invalid': errors.birth_date}" :bootstrap-styling="true" format="yyyy-MM-dd" placeholder="AAAA-MM-DD" :required="true"></datepicker>
                                    <small class="form-text text-danger" v-if="errors.birth_date">{{errors.birth_date[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="gender" class="col-sm-3 col-form-label">Género:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.gender"
                                    :options="gender"
                                    :searchable="false"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    :disabled="submiting"
                                    track-by="value"
                                    label="label"
                                    placeholder="Género"
                                    :class="{'border border-danger rounded': errors.gender}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.gender">{{errors.gender[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="phone_number" class="col-sm-3 col-form-label">Número de teléfono:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone_number" id="phone_number" v-model="user.phone_number" class="form-control" :class="{'is-invalid': errors.phone_number}" placeholder="Número de teléfono" required>
                                    <div class="invalid-feedback" v-if="errors.phone_number">{{errors.phone_number[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cellphone_number" class="col-sm-3 col-form-label">Número de teléfono móvil:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cellphone_number" id="cellphone_number" v-model="user.cellphone_number" class="form-control" :class="{'is-invalid': errors.cellphone_number}" placeholder="Número de teléfono móvil">
                                    <div class="invalid-feedback" v-if="errors.cellphone_number">{{errors.cellphone_number[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="nacionality" class="col-sm-3 col-form-label">País de origen:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.nacionality"
                                    :options="countries"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    :disabled="submiting"
                                    track-by="value"
                                    label="label"
                                    placeholder="País de origen"
                                    :class="{'border border-danger rounded': errors.nacionality}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.nacionality">{{errors.nacionality[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="location" class="col-sm-3 col-form-label">Ubicación:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="location" id="location" v-model="user.location" class="form-control" :class="{'is-invalid': errors.location}" placeholder="Ejemplo: Bogotá, Colombia" required>
                                    <div class="invalid-feedback" v-if="errors.location">{{errors.location[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="address" class="col-sm-3 col-form-label">Dirección de residencia:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" id="address" v-model="user.address" class="form-control" :class="{'is-invalid': errors.address}" placeholder="Dirección de residencia" required>
                                    <div class="invalid-feedback" v-if="errors.address">{{errors.address[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-sm-3 col-form-label">Foto del usuario:</label>
                                <div class="col-sm-9">
                                    <img :src="photo_preview" class="rounded-circle my-1" v-if="photo_preview" height="150" width="150">
                                    <input class="form-control-file" :class="{'is-invalid': errors.photo}" type="file" id="photo" @change="onPhotoChange" accept="image/*"/>
                                    <small class="form-text text-muted">Solo se permiten archivos JPG y PNG. Tamaño máximo de 2MB.</small>
                                    <div class="invalid-feedback" v-if="errors.photo">{{errors.photo[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="status" class="col-sm-3 col-form-label">Estado:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.status"
                                    :options="status"
                                    :searchable="false"
                                    :show-labels="false"
                                    :allow-empty="true"
                                    :disabled="submiting"
                                    track-by="value"
                                    label="label"
                                    placeholder="Estado"
                                    :class="{'border border-danger rounded': errors.status}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.status">{{errors.status[0]}}</small>
                                </div>
                            </div>
                        </template>
                        <template v-if="step === 2">
                            <div class="form-group row">
                                <label for="neighborhood" class="col-sm-3 col-form-label">Barrio:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="neighborhood" id="neighborhood" v-model="user.neighborhood" class="form-control" :class="{'is-invalid': errors.neighborhood}" placeholder="Barrio">
                                    <div class="invalid-feedback" v-if="errors.neighborhood">{{errors.neighborhood[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="commune" class="col-sm-3 col-form-label">Comuna / Localidad:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="commune" id="commune" v-model="user.commune" class="form-control" :class="{'is-invalid': errors.commune}" placeholder="Comuna / Localidad">
                                    <div class="invalid-feedback" v-if="errors.commune">{{errors.commune[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="socioeconomic_level" class="col-sm-3 col-form-label">Nivel Socioeconómico:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.socioeconomic_level"
                                    :options="[1,2,3,4,5,6]"
                                    :searchable="false"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    :disabled="submiting"
                                    placeholder="Nivel socioeconómico"
                                    :class="{'border border-danger rounded': errors.socioeconomic_level}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.socioeconomic_level">{{errors.socioeconomic_level[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="health_care" class="col-sm-3 col-form-label">Entidad de Salud:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="health_care" id="health_care" v-model="user.health_care" class="form-control" :class="{'is-invalid': errors.health_care}" placeholder="Entidad de Salud" required>
                                    <div class="invalid-feedback" v-if="errors.health_care">{{errors.health_care[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group required row">
                                <label for="blood_type" class="col-sm-3 col-form-label">Tipo de sangre:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.blood_type"
                                    :options="['A+','A-','B+','B-','AB+' ,'AB-' ,'O+' ,'O-']"
                                    :searchable="false"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    :disabled="submiting"
                                    placeholder="Tipo de sangre"
                                    :class="{'border border-danger rounded': errors.blood_type}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.blood_type">{{errors.blood_type[0]}}</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allergies" class="col-sm-3 col-form-label">Alergias:</label>
                                <div class="col-sm-9">
                                    <vue-editor id="allergies" v-model="user.allergies" :editorToolbar="customToolbar"></vue-editor>
                                    <div class="invalid-feedback" v-if="errors.allergies">{{errors.allergies[0]}}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diseases" class="col-sm-3 col-form-label">Enfermedades:</label>
                                <div class="col-sm-9">
                                    <vue-editor id="diseases" v-model="user.diseases" :editorToolbar="customToolbar"></vue-editor>
                                    <div class="invalid-feedback" v-if="errors.diseases">{{errors.diseases[0]}}</div>
                                </div>
                            </div>
                        </template>
                        <template v-if="step === 3">
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Acudientes:</label>
                                <div class="col-sm-9">
                                    <multiselect
                                    v-model="user.guardians"
                                    :options="guardians"
                                    :searchable="true"
                                    :show-labels="false"
                                    :allow-empty="false"
                                    :disabled="submiting"
                                    :custom-label="customLabel"
                                    track-by="id"
                                    label="user_id"
                                    placeholder="Acudientes"
                                    :class="{'border border-danger rounded': errors.guardians}">
                                    </multiselect>
                                    <small class="form-text text-danger" v-if="errors.guardians">{{errors.guardians[0]}}</small>
                                </div>
                            </div>
                        </template>
                    </form>
                </div>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</template>

<script>
    import Datepicker from "vuejs-datepicker/dist/vuejs-datepicker.esm.js";
    import {es} from "vuejs-datepicker/src/locale";
    import { VueEditor } from 'vue2-editor'
    export default {
        props: ['countries'],
        components: {
            Datepicker,
            VueEditor
        },
        data(){
            return {
                es: es,
                customToolbar: [
                    ['bold', 'italic'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ],
                user: {
                    guardians: {}
                },
                guardians: [],
                errors: {},
                submiting: false,
                it: [
                    { label: 'Registro Civil', value: 'RC' },
                    { label: 'Tarjeta de Identidad', value: 'TI' },
                    { label: 'Cédula de Ciudadanía', value: 'CC' },
                    { label: 'Cédula de Extranjería', value: 'CE' },
                    { label: 'Pasaporte', value: 'PB' },
                    { label: 'Nit', value: 'NI' }
                ],
                gender: [
                    { label: 'Masculino', value: 'm' },
                    { label: 'Femenino', value: 'f' }
                ],
                photo_preview: null,
                status: [
                    { label: 'Habilitado', value: 'enabled' },
                    { label: 'Inhabilitado', value: 'disabled' }
                ],
                step: 1,
                totalsteps: 3
            }
        },
        mounted () {
            this.getGuardians();
        },
        methods: {
            prev() {
                this.step--;
            },
            next() {
                this.step++;
            },
            getGuardians() {
                axios.get(route('api.guardians.all'))
                .then(response => {
                    this.guardians = response.data
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                });
            },
            customLabel(option) {
                if(option.user){
                   return option.user.first_name + ' ' + option.user.last_name;
                } 
            },
            create() {
                if (!this.submiting) {

                    this.submiting = true;
                    let _self = this;
                    _self.user.it = (this.user.it) ? this.user.it.value : null;
                    _self.user.gender = (this.user.gender) ? this.user.gender.value : null;
                    _self.user.birth_date = (this.user.birth_date) ? Vue.moment(this.user.birth_date).format('YYYY-MM-DD') : null;
                    _self.user.nacionality = (this.user.nacionality) ? this.user.nacionality.value : null;
                    _self.user.status = (this.user.status) ? this.user.status.value : null;
                    _self.user.socioeconomic_level = (this.user.socioeconomic_level) ? this.user.socioeconomic_level.value : null;
                    _self.user.blood_type = (this.user.blood_type) ? this.user.blood_type.value : null;
                    let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                    let formdata = new FormData();
                    Object.keys(_self.user).forEach((prop) => {
                        if (_self.user[prop]) { formdata.append(prop, _self.user[prop]) }
                    });
                    console.log(this.user);
                    axios.post(route('api.users.st.store'), formdata, config)
                    .then(response => {
                        this.$toasted.global.error('¡Se ha añadido el usuario!');
                        location.href = route('users.st.index');
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.submiting = false;
                    });
                }
            },
            onPhotoChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.user.photo = files[0];
                this.createPhoto(files[0]);
            },
            createPhoto(file) {
                if ( /\.(jpe?g|png)$/i.test( file.name ) ) {
                    let reader = new FileReader();
                    let me = this;
                    reader.onload = (e) => {
                        me.photo_preview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>
