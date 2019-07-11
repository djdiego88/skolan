<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9 col-xl-7">
                <div class="card-header px-0 mt-2 bg-transparent clearfix">
                    <h4 class="float-left pt-2">Configuración</h4>
                    <div class="card-header-actions mr-1">
                        <a class="btn btn-primary" href="#" :disabled="submiting" @click.prevent="updateOptions">
                            <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
                            <i class="fas fa-save" v-else></i>
                            <span class="ml-1">Actualizar</span>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#general" role="tab">Generales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#styles" role="tab">Presentación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#social" role="tab">Redes Sociales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#academics" role="tab">Académico</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <form accept-charset="UTF-8" enctype="multipart/form-data">
                        <div class="tab-content border-left-0 border-bottom-0 border-right-0">
                            <div class="tab-pane fade show active" id="general" role="tabpanel">
                                <div class="form-group" v-for="option in options" :key="option.id">
                                    <div class="row required" v-if="option.name == 'site_name'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="site_name" class="form-control" :class="{'is-invalid': errors.site_name}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.site_name">{{errors.site_name[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'site_description'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" :class="{'is-invalid': errors.site_description}" :name="option.name" :id="option.name" v-model="site_description" rows="4" required></textarea>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.site_description">{{errors.site_description[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'nit'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="nit" class="form-control" :class="{'is-invalid': errors.nit}">
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.nit">{{errors.nit[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'admin_email'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="email" :name="option.name" :id="option.name" v-model="admin_email" class="form-control" :class="{'is-invalid': errors.admin_email}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.admin_email">{{errors.admin_email[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'telephone'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="telephone" class="form-control" :class="{'is-invalid': errors.telephone}">
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.telephone">{{errors.telephone[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'state'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="state" class="form-control" :class="{'is-invalid': errors.state}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.state">{{errors.state[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'city'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="city" class="form-control" :class="{'is-invalid': errors.city}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.city">{{errors.city[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'principal'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="principal" class="form-control" :class="{'is-invalid': errors.principal}">
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.principal">{{errors.principal[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'secretary'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="secretary" class="form-control" :class="{'is-invalid': errors.secretary}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.secretary">{{errors.secretary[0]}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="styles" role="tabpanel">
                                <div class="form-group" v-for="option in options" :key="option.id">
                                    <div class="row" v-if="option.name == 'site_logo'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <img :src="site_logo_preview" class="img-fluid img-thumbnail my-1" v-if="site_logo_preview">
                                            <input class="form-control-file" :class="{'is-invalid': errors.site_logo}" type="file" :id="option.name" @change="onImageChange" accept="image/*"/>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.site_logo">{{errors.site_logo[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'site_style'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <label class="col-sm-3" v-for="(value, key) in styles" :key="key">
                                                    <input type="radio" :value="key" :name="option.name" :id="option.name" v-model="site_style"> {{value}} <br>
                                                    <img :src="'/storage/images/styles/'+key+'.jpg'" class="img-fluid img-thumbnail">
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.site_logo">{{errors.site_logo[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'items_per_page'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="1" max="70" :name="option.name" :id="option.name" v-model="items_per_page" class="form-control" :class="{'is-invalid': errors.items_per_page}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.items_per_page">{{errors.items_per_page[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'google_analytics_id'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="google_analytics_id" class="form-control" :class="{'is-invalid': errors.google_analytics_id}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.google_analytics_id">{{errors.google_analytics_id[0]}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="social" role="tabpanel">
                                <div class="form-group" v-for="option in options" :key="option.id">
                                    <div class="row" v-if="option.name == 'twitter_account'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="twitter_account" class="form-control" :class="{'is-invalid': errors.twitter_account}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.twitter_account">{{errors.twitter_account[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'facebook_url'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="facebook_url" class="form-control" :class="{'is-invalid': errors.facebook_url}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.facebook_url">{{errors.facebook_url[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'instagram_account'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="instagram_account" class="form-control" :class="{'is-invalid': errors.instagram_account}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.instagram_account">{{errors.instagram_account[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="option.name == 'youtube_url'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="text" :name="option.name" :id="option.name" v-model="youtube_url" class="form-control" :class="{'is-invalid': errors.youtube_url}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.youtube_url">{{errors.youtube_url[0]}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="academics" role="tabpanel">
                                <div class="form-group" v-for="option in options" :key="option.id">
                                    <div class="row required" v-if="option.name == 'min_qualification'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="1" max="100" :name="option.name" :id="option.name" v-model="min_qualification" class="form-control" :class="{'is-invalid': errors.min_qualification}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.min_qualification">{{errors.min_qualification[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'max_qualification'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="1" max="100" :name="option.name" :id="option.name" v-model="max_qualification" class="form-control" :class="{'is-invalid': errors.max_qualification}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.max_qualification">{{errors.max_qualification[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'min_qualification_pass'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <input type="number" min="1" max="100" :name="option.name" :id="option.name" v-model="min_qualification_pass" class="form-control" :class="{'is-invalid': errors.min_qualification_pass}" required>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.min_qualification_pass">{{errors.min_qualification_pass[0]}}</div>
                                        </div>
                                    </div>
                                    <div class="row required" v-if="option.name == 'decimal_positions'">
                                        <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                        <div class="col-sm-9">
                                            <multiselect
                                            v-model="decimal_positions"
                                            :options="[0,1,2,3]"
                                            :searchable="false"
                                            :show-labels="false"
                                            :allow-empty="false"
                                            :class="{'border border-danger rounded': errors.decimal_positions}">
                                            </multiselect>
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <small class="form-text text-danger" v-if="errors.decimal_positions">{{errors.decimal_positions[0]}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <content-placeholders v-if="loading">
                    <content-placeholders-text/>
                </content-placeholders>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                errors: {},
                submiting: false,
                options: {},
                styles: {},
                site_name: null,
                site_description: null,
                admin_email: null,
                items_per_page: 0,
                google_analytics_id: null,
                site_logo: null,
                site_logo_preview: null,
                site_style: null,
                twitter_account: null,
                facebook_url: null,
                google_url: null,
                instagram_account: null,
                youtube_url: null,
                loading: true,
                nit: null,
                telephone: null,
                state: null,
                city: null,
                principal: null,
                secretary: null,
                min_qualification: null,
                max_qualification: null,
                min_qualification_pass: null,
                decimal_positions: null
            }
        },
        mounted() {
            this.getOptions();
        },
        methods: {
            getOptions() {
                this.loading = true;
                axios.get(route('options.index'))
                .then(response => {
                    this.options = response.data.options;
                    this.styles = response.data.styles;
                    this.fillOptions();
                    this.loading = false;
                });
            },
            fillOptions() {
                let me = this;
                this.options.forEach(function(val,index){
                    if (val.value) {
                        // If val.value is not null, undefined, NaN, empty string (""), 0 or false.
                        switch (val.name) {
                            case 'site_name':
                                me.site_name = val.value;
                                break;
                            case 'site_description':
                                me.site_description = val.value;
                                break;
                            case 'admin_email':
                                me.admin_email = val.value;
                                break;
                            case 'items_per_page':
                                me.items_per_page = val.value;
                                break;
                            case 'google_analytics_id':
                                me.google_analytics_id = val.value;
                                break;
                            case 'site_logo':
                                me.site_logo_preview = '/storage/images/logo/'+val.value;
                                break;
                            case 'site_style':
                                me.site_style = val.value;
                                break;
                            case 'twitter_account':
                                me.twitter_account = val.value;
                                break;
                            case 'facebook_url':
                                me.facebook_url = val.value;
                                break;
                            case 'google_url':
                                me.google_url = val.value;
                                break;
                            case 'instagram_account':
                                me.instagram_account = val.value;
                                break;
                            case 'youtube_url':
                                me.youtube_url = val.value;
                                break;
                            case 'nit':
                                me.nit = val.value;
                                break;
                            case 'telephone':
                                me.telephone = val.value;
                                break;
                            case 'state':
                                me.state = val.value;
                                break;
                            case 'city':
                                me.city = val.value;
                                break;
                            case 'principal':
                                me.principal = val.value;
                                break;
                            case 'secretary':
                                me.secretary = val.value;
                                break;
                            case 'min_qualification':
                                me.min_qualification = val.value;
                                break;
                            case 'max_qualification':
                                me.max_qualification = val.value;
                                break;
                            case 'min_qualification_pass':
                                me.min_qualification_pass = val.value;
                                break;
                            case 'decimal_positions':
                                me.decimal_positions = val.value;
                                break;    
                        }
                    }
                });
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.site_logo = files[0];
                this.createImage(files[0]);
            },
            createImage(file) {
                if ( /\.(jpe?g|png|gif)$/i.test( file.name ) ) {
                    let reader = new FileReader();
                    let me = this;
                    reader.onload = (e) => {
                        me.site_logo_preview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            updateOptions(e) {
                e.preventDefault();
                let config = { headers: { 'Content-Type': 'multipart/form-data' } }
                let obj = {
                    site_name: this.site_name,
                    site_description: this.site_description,
                    admin_email: this.admin_email,
                    items_per_page: this.items_per_page,
                    google_analytics_id: this.google_analytics_id,
                    site_logo: this.site_logo,
                    site_style: this.site_style,
                    twitter_account: this.twitter_account,
                    facebook_url: this.facebook_url,
                    google_url: this.google_url,
                    instagram_account: this.instagram_account,
                    youtube_url: this.youtube_url,
                    nit: this.nit,
                    telephone: this.telephone,
                    state: this.state,
                    city: this.city,
                    principal: this.principal,
                    secretary: this.secretary,
                    min_qualification: this.min_qualification,
                    max_qualification: this.max_qualification,
                    min_qualification_pass: this.min_qualification_pass,
                    decimal_positions: this.decimal_positions,
                }
                let formdata = new FormData();
                formdata.append('_method', 'PUT');
                Object.keys(obj).forEach((prop) => {
                    if (obj[prop]) { formdata.append(prop, obj[prop]) }
                });
                
                this.submiting = true;
                axios.post(route('options.update'), formdata, config)
                .then(response => {
                    this.errors = {}
                    this.submiting = false;
                    this.getOptions();
                    this.$toasted.global.error('Se han actualizado las opciones');
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.submiting = false;
                });
            }
        }
    }    
</script>
