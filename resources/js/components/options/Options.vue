<template>
    <div class="card">
        <div class="card-header">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#general" role="tab">Generales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#styles" role="tab">Estilos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#social" role="tab">Redes Sociales</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <!-- Tab panes -->
            <form accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="form-group" v-for="option in options" :key="option.id">
                            <div class="row" v-if="option.name == 'site_name'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <input type="text" :name="option.name" :id="option.name" v-model="site_name" class="form-control" :class="{'is-invalid': errors.site_name}" required>
                                    <small class="form-text text-muted">{{option.description}}</small>
                                    <div class="invalid-feedback" v-if="errors.site_name">{{errors.site_name[0]}}</div>
                                </div>
                            </div>
                            <div class="row" v-if="option.name == 'site_description'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" :class="{'is-invalid': errors.site_description}" :name="option.name" :id="option.name" v-model="site_description" rows="4" required></textarea>
                                    <small class="form-text text-muted">{{option.description}}</small>
                                    <div class="invalid-feedback" v-if="errors.site_description">{{errors.site_description[0]}}</div>
                                </div>
                            </div>
                            <div class="row" v-if="option.name == 'admin_email'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <input type="email" :name="option.name" :id="option.name" v-model="admin_email" class="form-control" :class="{'is-invalid': errors.admin_email}" required>
                                    <small class="form-text text-muted">{{option.description}}</small>
                                    <div class="invalid-feedback" v-if="errors.admin_email">{{errors.admin_email[0]}}</div>
                                </div>
                            </div>
                            <div class="row" v-if="option.name == 'items_per_page'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="number" min="1" max="70" :name="option.name" :id="option.name" v-model="items_per_page" class="form-control" :class="{'is-invalid': errors.items_per_page}" required>
                                        </div>
                                        <div class="col-sm-12">
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.items_per_page">{{errors.items_per_page[0]}}</div>
                                        </div>
                                    </div>
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
                        <div class="form-group">
                            <div class="col-md-9 offset-md-3">
                                <button class="btn btn-primary" type="button" :disabled="submiting" @click="updateOptions" >
                                    <i class="fas fa-spinner fa-spin" v-if="submiting"></i> Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="styles" role="tabpanel">
                        <div class="form-group" v-for="option in options" :key="option.id">
                            <div class="row" v-if="option.name == 'site_logo'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <img :src="site_logo_preview" class="img-fluid img-thumbnail" v-if="site_logo_preview">
                                    <input class="form-control-file" :class="{'is-invalid': errors.site_logo}" type="file" :id="option.name" @change="onImageChange" accept="image/*"/>
                                    <small class="form-text text-muted">{{option.description}}</small>
                                    <div class="invalid-feedback" v-if="errors.site_logo">{{errors.site_logo[0]}}</div>
                                </div>
                            </div>
                            <div class="row" v-if="option.name == 'site_style'">
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
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 offset-md-3">
                                <button class="btn btn-primary" type="button" :disabled="submiting" @click="updateOptions" >
                                    <i class="fas fa-spinner fa-spin" v-if="submiting"></i> Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="social" role="tabpanel">
                        <div class="form-group" v-for="option in options" :key="option.id">
                            <div class="row" v-if="option.name == 'twitter_account'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" :name="option.name" :id="option.name" v-model="twitter_account" class="form-control" :class="{'is-invalid': errors.twitter_account}" required>
                                        </div>
                                        <div class="col-sm-12">
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.twitter_account">{{errors.twitter_account[0]}}</div>
                                        </div>
                                    </div>
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
                            <div class="row" v-if="option.name == 'google_url'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <input type="text" :name="option.name" :id="option.name" v-model="google_url" class="form-control" :class="{'is-invalid': errors.google_url}" required>
                                    <small class="form-text text-muted">{{option.description}}</small>
                                    <div class="invalid-feedback" v-if="errors.google_url">{{errors.google_url[0]}}</div>
                                </div>
                            </div>
                            <div class="row" v-if="option.name == 'instagram_account'">
                                <label :for="option.name" class="col-sm-3 col-form-label">{{option.display_name}}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" :name="option.name" :id="option.name" v-model="instagram_account" class="form-control" :class="{'is-invalid': errors.instagram_account}" required>
                                        </div>
                                        <div class="col-sm-12">
                                            <small class="form-text text-muted">{{option.description}}</small>
                                            <div class="invalid-feedback" v-if="errors.instagram_account">{{errors.instagram_account[0]}}</div>
                                        </div>
                                    </div>
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
                        <div class="form-group">
                            <div class="col-md-9 offset-md-3">
                                <button class="btn btn-primary" type="button" :disabled="submiting" @click="updateOptions" >
                                    <i class="fas fa-spinner fa-spin" v-if="submiting"></i> Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- .card -->
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
                youtube_url: null
            }
        },
        mounted() {
            this.getOptions();
        },
        methods: {
            getOptions() {
                axios.get(route('options.index'))
                .then(response => {
                    this.options = response.data.options;
                    this.styles = response.data.styles;
                    this.fillOptions();
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
                                me.site_logo_preview = val.value;
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
