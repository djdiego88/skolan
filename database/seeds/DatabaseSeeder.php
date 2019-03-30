<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Usermeta;
use App\Option;
use App\Grade;
use App\Area;
use App\Subject;
use App\Year;
use App\Headquarter;
use App\Schoolday;
use App\Classroom;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        //Creación de Roles
        $superadmin = Role::create(['name' => 'superadmin', 'display_name'=> 'Super Administrador']);
        $administrative = Role::create(['name' => 'administrative', 'display_name'=> 'Personal Administrativo']);
        $coordinator = Role::create(['name' => 'coordinator', 'display_name'=> 'Coordinador']);
        $teacher = Role::create(['name' => 'teacher', 'display_name'=> 'Docente']);
        $student = Role::create(['name' => 'student', 'display_name'=> 'Alumno']);
        $guardian = Role::create(['name' => 'guardian', 'display_name'=> 'Acudiente']);
        //$candidate = Role::create(['name' => 'candidate', 'display_name'=> 'Candidato']);
        //Creación de permisos
        $adminOptions = Permission::create(['name' => 'admin-options', 'display_name'=> 'Opciones de configuración']);
        $adminUser = Permission::create(['name' => 'admin-user', 'display_name'=> 'Administrar usuarios']);
        $adminRole = Permission::create(['name' => 'admin-role', 'display_name'=> 'Administrar roles']);
        $adminPermission = Permission::create(['name' => 'admin-permission', 'display_name'=> 'Administrar permisos']);
        $adminStudent = Permission::create(['name' => 'admin-student', 'display_name'=> 'Administrar estudiantes']);
        $adminGuardian = Permission::create(['name' => 'admin-guardian', 'display_name'=> 'Administrar acudientes']);
        $adminTeacher = Permission::create(['name' => 'admin-teacher', 'display_name'=> 'Administrar docentes']);
        $editStudent = Permission::create(['name' => 'edit-student', 'display_name'=> 'Editar estudiantes']);
        $editGuardian = Permission::create(['name' => 'edit-guardian', 'display_name'=> 'Editar acudientes']);
        $editTeacher = Permission::create(['name' => 'edit-teacher', 'display_name'=> 'Editar docentes']);
        $adminGrade = Permission::create(['name' => 'admin-grade', 'display_name'=> 'Administrar niveles']);
        $adminClassroom = Permission::create(['name' => 'admin-classroom', 'display_name'=> 'Administrar salones']);
        $adminSubject = Permission::create(['name' => 'admin-subject', 'display_name'=> 'Administrar materias']);
        $adminSchedule = Permission::create(['name' => 'admin-schedule', 'display_name'=> 'Administrar horarios']);
        $adminArea = Permission::create(['name' => 'admin-area', 'display_name'=> 'Administrar áreas']);
        $adminHQ = Permission::create(['name' => 'admin-hq', 'display_name'=> 'Administrar sedes']);
        $adminSchoolday = Permission::create(['name' => 'admin-schoolday', 'display_name'=> 'Administrar jornadas']);
        $adminYear = Permission::create(['name' => 'admin-year', 'display_name'=> 'Administrar años']);
        $adminSchoolterm = Permission::create(['name' => 'admin-schoolterm', 'display_name'=> 'Administrar periodos']);
        $adminEnrollment = Permission::create(['name' => 'admin-enrollment', 'display_name'=> 'Administrar matrículas']);
        $adminAbsence = Permission::create(['name' => 'admin-absence', 'display_name'=> 'Administrar ausencias']);
        $viewAbsence = Permission::create(['name' => 'view-absence', 'display_name'=> 'Ver ausencias']);
        $adminAnnotation = Permission::create(['name' => 'admin-annotation', 'display_name'=> 'Administrar observaciones']);
        $editAnnotation = Permission::create(['name' => 'edit-annotation', 'display_name'=> 'Editar observaciones']);
        $viewAnnotation = Permission::create(['name' => 'view-annotation', 'display_name'=> 'Ver observaciones']);
        $adminHomework = Permission::create(['name' => 'admin-homework', 'display_name'=> 'Administrar actividades']);
        $viewHomework = Permission::create(['name' => 'view-homework', 'display_name'=> 'Ver actividades']);
        $adminQualification = Permission::create(['name' => 'admin-qualification', 'display_name'=> 'Administrar calificaciones']);
        $editQualification = Permission::create(['name' => 'edit-qualification', 'display_name'=> 'Editar calificaciones']);
        $viewQualification = Permission::create(['name' => 'view-qualification', 'display_name'=> 'Ver calificaciones']);
        $adminTests = Permission::create(['name' => 'admin-tests', 'display_name'=> 'Administrar tests']);
        $editTests = Permission::create(['name' => 'edit-tests', 'display_name'=> 'Editar tests']);
        $viewTests = Permission::create(['name' => 'view-tests', 'display_name'=> 'Ver tests']);
        $viewActivityLog = Permission::create(['name' => 'view-activitylog', 'display_name'=> 'Ver registro de actividades']);
        //Asignar permisos a roles
        $superadmin->givePermissionTo(Permission::all());
		$administrative->givePermissionTo([$adminStudent,$adminGuardian,$adminTeacher,$adminGrade,$adminClassroom,$adminSubject,$adminSchedule,$adminArea,$adminHQ,$adminSchoolday,$adminYear,$adminSchoolterm,$adminEnrollment,$adminAbsence,$adminAnnotation,$adminHomework,$adminQualification, $viewActivityLog, $adminTests, $editTests, $viewTests]);
		$coordinator->givePermissionTo([$adminSchedule,$adminEnrollment,$adminAbsence,$adminAnnotation,$viewHomework,$viewQualification, $adminTests, $editTests, $viewTests]);
		$teacher->givePermissionTo([$adminAbsence,$adminAnnotation,$viewHomework,$viewQualification, $adminTests, $editTests, $viewTests]);
		$student->givePermissionTo([$viewAbsence,$viewAnnotation,$viewHomework,$viewQualification, $viewTests]);
		$guardian->givePermissionTo([$viewAbsence,$viewAnnotation,$viewHomework,$viewQualification]);
		//$candidate->givePermissionTo([$createPost, $editUser]);
		//Añadir Super Administrador
		$superAdminUser = new User();
		$superAdminUser->it = 'CC';
		$superAdminUser->nid = 1024484660;
		$superAdminUser->first_name = 'Diego Alexander';
		$superAdminUser->last_name = 'Castillo Jiménez';
		$superAdminUser->email = 'djdiego88@gmail.com';
		$superAdminUser->password = Hash::make('8d8j9D1i1e9Go');
		$superAdminUser->birth_date = '1988-09-19';
		$superAdminUser->gender = 'm';
		$superAdminUser->phone_number = '0571-9059631';
		$superAdminUser->cellphone_number = '3178042220';
		$superAdminUser->nacionality = 'CO';
		$superAdminUser->location = 'Bogotá D.C.';
		$superAdminUser->address = 'Calle 6C # 82A - 25';
		$superAdminUser->status = 'enabled';
		$superAdminUser->last_access = date('Y-m-d H:i:s');
		$superAdminUser->photo = 'foto-documento-grande--cuadrado.jpg';
		$superAdminUser->save();
		//Asociar rol al superadmin
		$superAdminUser->assignRole($superadmin);
		//Añadir usermeta
		$display_name = $superAdminUser->first_name . ' '. $superAdminUser->last_name;
        $display_name = explode(" ",$display_name);
        $countnames = count($display_name);
        if($countnames == 1){
            $display_name = $display_name[0];
        }elseif($countnames == 2){
            $display_name = $display_name[0].' '.$display_name[1];
        }elseif($countnames == 3 || $countnames == 4){
            $display_name = $display_name[0].' '.$display_name[2];
        }
        $displayname = new Usermeta();
        $displayname->user_id = $superAdminUser->id;
        $displayname->name = 'display_name';
        $displayname->value = $display_name;
        $displayname->save();

		$optionSiteName = new Option();
		$optionSiteName->name = 'site_name';
		$optionSiteName->display_name = 'Nombre de la Institución';
		$optionSiteName->description = 'Aquí va el nombre de la Institución Educativa';
		$optionSiteName->value = 'Skolan';
		$optionSiteName->save();

		$optionSiteDescr = new Option();
		$optionSiteDescr->name = 'site_description';
		$optionSiteDescr->display_name = 'Descripción de la Institución';
		$optionSiteDescr->description = 'Aquí va una pequeña descripción corta de la Institución Educativa';
		$optionSiteDescr->value = 'Otra institución apoyada por Skolan';
		$optionSiteDescr->save();

		$optionSiteLogo = new Option();
		$optionSiteLogo->name = 'site_logo';
		$optionSiteLogo->display_name = 'Logo de la Institución';
		$optionSiteLogo->description = 'Aquí va el archivo de imagen o logo de la Institución Educativa';
		$optionSiteLogo->value = 'logo-default.png';
		$optionSiteLogo->save();

		$optionAdminEmail = new Option();
		$optionAdminEmail->name = 'admin_email';
		$optionAdminEmail->display_name = 'Correo Electrónico del Administrador';
		$optionAdminEmail->description = 'Ingresa aquí el correo electrónico del administrador del sistema';
		$optionAdminEmail->value = 'djdiego88@gmail.com';
		$optionAdminEmail->save();

		$optionItemsPerPage = new Option();
		$optionItemsPerPage->name = 'items_per_page';
		$optionItemsPerPage->display_name = 'Items por Página';
		$optionItemsPerPage->description = 'Ingresa aquí el número máximo de items a mostrar en una página con listado.';
		$optionItemsPerPage->value = 25;
		$optionItemsPerPage->save();

		$optionSiteStyle = new Option();
		$optionSiteStyle->name = 'site_style';
		$optionSiteStyle->display_name = 'Estilo del Sitio';
		$optionSiteStyle->description = 'Escoge la gama de colores del Sistema.';
		$optionSiteStyle->value = 'primary';
		$optionSiteStyle->save();

		$optionAnalytics = new Option();
		$optionAnalytics->name = 'google_analytics_id';
		$optionAnalytics->display_name = 'ID de Google Analytics';
		$optionAnalytics->description = 'Ingresa aquí el "ID de propiedad Web" para las estadísticas de Google Analytics.';
		$optionAnalytics->value = 'UA-XXXXXXX-X';
		$optionAnalytics->save();

		$optionTwitterAccount = new Option();
		$optionTwitterAccount->name = 'twitter_account';
		$optionTwitterAccount->display_name = 'Cuenta de Twitter';
		$optionTwitterAccount->description = 'Ingresa el "username" del perfil oficial en Twitter de la Institución.';
		$optionTwitterAccount->value = '';
		$optionTwitterAccount->save();

		$optionFacebookPage = new Option();
		$optionFacebookPage->name = 'facebook_url';
		$optionFacebookPage->display_name = 'Página de Facebook';
		$optionFacebookPage->description = 'Ingresa la URL de la página oficial en Facebook de la Institución.';
		$optionFacebookPage->value = '';
		$optionFacebookPage->save();

		$optionGooglePage = new Option();
		$optionGooglePage->name = 'google_url';
		$optionGooglePage->display_name = 'Página de Google+';
		$optionGooglePage->description = 'Ingresa la URL de la página oficial en Google+ de la Institución.';
		$optionGooglePage->value = '';
		$optionGooglePage->save();

		$optionInstagramAccount = new Option();
		$optionInstagramAccount->name = 'instagram_account';
		$optionInstagramAccount->display_name = 'Cuenta de Instagram';
		$optionInstagramAccount->description = 'Ingresa el "username" del perfil oficial en Instagram de la Institución.';
		$optionInstagramAccount->value = '';
		$optionInstagramAccount->save();

		$optionYoutubePage = new Option();
		$optionYoutubePage->name = 'youtube_url';
		$optionYoutubePage->display_name = 'Canal de Youtube';
		$optionYoutubePage->description = 'Ingresa la URL del canal oficial en Youtube de la Institución.';
		$optionYoutubePage->value = '';
		$optionYoutubePage->save();

        $optionNit = new Option();
        $optionNit->name = 'nit';
        $optionNit->display_name = 'N.I.T.';
        $optionNit->description = 'N.I.T. de la institución educativa.';
        $optionNit->value = '';
        $optionNit->save();

        $optionTel = new Option();
        $optionTel->name = 'telephone';
        $optionTel->display_name = 'Teléfono';
        $optionTel->description = 'Número telefónico de la institución educativa.';
        $optionTel->value = '';
        $optionTel->save();

        $optionState = new Option();
        $optionState->name = 'state';
        $optionState->display_name = 'Departamento';
        $optionState->description = 'Departamento de la institución educativa.';
        $optionState->value = 'Bogotá D.C.';
        $optionState->save();

        $optionCity = new Option();
        $optionCity->name = 'city';
        $optionCity->display_name = 'Ciudad';
        $optionCity->description = 'Ciudad de la institución educativa.';
        $optionCity->value = 'Bogotá D.C.';
        $optionCity->save();

        $optionPrinc = new Option();
        $optionPrinc->name = 'principal';
        $optionPrinc->display_name = 'Rector(a)';
        $optionPrinc->description = 'Nombre del rector(a) de la institución educativa.';
        $optionPrinc->value = '';
        $optionPrinc->save();

        $optionSecr = new Option();
        $optionSecr->name = 'secretary';
        $optionSecr->display_name = 'Secretario(a)';
        $optionSecr->description = 'Nombre del secretario(a) de la institución educativa.';
        $optionSecr->value = '';
        $optionSecr->save();

        $optionMinQ = new Option();
        $optionMinQ->name = 'min_qualification';
        $optionMinQ->display_name = 'Calificación mínima';
        $optionMinQ->description = 'Calificación mínima del sistema de notas.';
        $optionMinQ->value = 1;
        $optionMinQ->save();

        $optionMaxQ = new Option();
        $optionMaxQ->name = 'max_qualification';
        $optionMaxQ->display_name = 'Calificación máxima';
        $optionMaxQ->description = 'Calificación máxima del sistema de notas.';
        $optionMaxQ->value = 5;
        $optionMaxQ->save();

        $optionMinQP = new Option();
        $optionMinQP->name = 'min_qualification_pass';
        $optionMinQP->display_name = 'Calificación mínima para aprobar';
        $optionMinQP->description = 'Calificación mínima para que un estudiante apruebe';
        $optionMinQP->value = 3;
        $optionMinQP->save();

        $optionDec = new Option();
        $optionDec->name = 'decimal_positions';
        $optionDec->display_name = 'Posiciones decimales';
        $optionDec->description = 'Posiciones decimales para las notas registradas en el sistema de evaluación.';
        $optionDec->value = 2;
        $optionDec->save();

        $firstGrade = new Grade();
        $firstGrade->name = 'Primero';
        $firstGrade->save();

        $secondGrade = new Grade();
        $secondGrade->name = 'Segundo';
        $secondGrade->save();

        $thirdGrade = new Grade();
        $thirdGrade->name = 'Tercero';
        $thirdGrade->save();

        $fourthGrade = new Grade();
        $fourthGrade->name = 'Cuarto';
        $fourthGrade->save();

        $fifthGrade = new Grade();
        $fifthGrade->name = 'Quinto';
        $fifthGrade->save();

        $sciences = new Area();
        $sciences->name = 'Ciencias naturales y educación ambiental';
        $sciences->save();

        $social = new Area();
        $social->name = 'Ciencias sociales, historia, geografía, constitución política y democracia';
        $social->save();

        $artist = new Area();
        $artist->name = 'Educación artística';
        $artist->save();

        $ethics = new Area();
        $ethics->name = 'Educación ética y en valores humanos';
        $ethics->save();

        $sports = new Area();
        $sports->name = 'Educación física, recreación y deportes';
        $sports->save();

        $religions = new Area();
        $religions->name = 'Educación religiosa';
        $religions->save();

        $humanities = new Area();
        $humanities->name = 'Humanidades, lengua castellana e idiomas extranjeros';
        $humanities->save();

        $maths = new Area();
        $maths->name = 'Matemáticas';
        $maths->save();

        $tech = new Area();
        $tech->name = 'Tecnología e informática';
        $tech->save();

        $integ = new Area();
        $integ->name = 'Integrado';
        $integ->save();

        $arit = new Subject();
        $arit->name = 'Aritmética';
        $arit->area_id = $maths->id;
        $arit->save();

        $art = new Subject();
        $art->name = 'Artística';
        $art->area_id = $artist->id;
        $art->save();

        $cal = new Subject();
        $cal->name = 'Caligrafía';
        $cal->area_id = $humanities->id;
        $cal->save();

        $dem = new Subject();
        $dem->name = 'Democracia y urbanidad';
        $dem->area_id = $social->id;
        $dem->save();

        $est = new Subject();
        $est->name = 'Estadística';
        $est->area_id = $maths->id;
        $est->save();

        $eti = new Subject();
        $eti->name = 'Ética y valores';
        $eti->area_id = $ethics->id;
        $eti->save();

        $fis = new Subject();
        $fis->name = 'Educación física';
        $fis->area_id = $sports->id;
        $fis->save();

        $geo = new Subject();
        $geo->name = 'Geometría';
        $geo->area_id = $maths->id;
        $geo->save();

        $inf = new Subject();
        $inf->name = 'Informática';
        $inf->area_id = $tech->id;
        $inf->save();

        $ing = new Subject();
        $ing->name = 'Inglés';
        $ing->area_id = $humanities->id;
        $ing->save();

        $int = new Subject();
        $int->name = 'Integrado';
        $int->area_id = $integ->id;
        $int->save();

        $len = new Subject();
        $len->name = 'Lengua castellana';
        $len->area_id = $humanities->id;
        $len->save();

        $mat = new Subject();
        $mat->name = 'Matemáticas';
        $mat->area_id = $maths->id;
        $mat->save();

        $nat = new Subject();
        $nat->name = 'Naturales';
        $nat->area_id = $sciences->id;
        $nat->save();

        $prc = new Subject();
        $prc->name = 'Pre ciencias';
        $prc->area_id = $sciences->id;
        $prc->save();

        $prm = new Subject();
        $prm->name = 'Pre matemáticas';
        $prm->area_id = $maths->id;
        $prm->save();

        $pry = new Subject();
        $pry->name = 'Proyecto';
        $pry->area_id = $integ->id;
        $pry->save();

        $rel = new Subject();
        $rel->name = 'Religión';
        $rel->area_id = $religions->id;
        $rel->save();

        $soc = new Subject();
        $soc->name = 'Sociales';
        $soc->area_id = $social->id;
        $soc->save();

        $mus = new Subject();
        $mus->name = 'Música';
        $mus->area_id = $artist->id;
        $mus->save();

        $year1 = new Year();
        $year1->name = '2018';
        $year1->status = 'inactive';
        $year1->start_date = '2018-01-15 00:00:00';
        $year1->end_date = '2018-12-15 23:59:59';
        $year1->save();

        $year2 = new Year();
        $year2->name = '2019';
        $year2->status = 'active';
        $year2->start_date = '2019-01-15 00:00:00';
        $year2->end_date = '2019-12-15 23:59:59';
        $year2->save();

        $year3 = new Year();
        $year3->name = '2020';
        $year3->status = 'pre-active';
        $year3->start_date = '2020-01-15 00:00:00';
        $year3->end_date = '2020-12-15 23:59:59';
        $year3->save();

        $year4 = new Year();
        $year4->name = '2021';
        $year4->status = 'inactive';
        $year4->start_date = '2021-01-15 00:00:00';
        $year4->end_date = '2021-12-15 23:59:59';
        $year4->save();

        $hq1 = new Headquarter();
        $hq1->name = 'La principal';
        $hq1->location = 'Soacha, Cundinamarca';
        $hq1->address = 'Evergreen 123';
        $hq1->telephone = '3584963';
        $hq1->dane = '168003476534';
        $hq1->save();

        $hq2 = new Headquarter();
        $hq2->name = 'El progreso';
        $hq2->location = 'Soacha, Cundinamarca';
        $hq2->address = 'Av. Siempre viva 1234';
        $hq2->telephone = '5305763';
        $hq2->dane = '168004576354';
        $hq2->save();

        $hq3 = new Headquarter();
        $hq3->name = 'La Isla';
        $hq3->location = 'Soacha, Cundinamarca';
        $hq3->address = 'Av.Cartón papel 1234';
        $hq3->telephone = '3765486';
        $hq3->dane = '168003067465';
        $hq3->save();

        $schd1 = new Schoolday();
        $schd1->name = 'Mañana';
        $schd1->save();

        $schd2 = new Schoolday();
        $schd2->name = 'Tarde';
        $schd2->save();

        $schd3 = new Schoolday();
        $schd3->name = 'Única';
        $schd3->save();

        /**
         * Usuarios superadmin
         */
        factory(App\User::class, 50)->create()->each(function($user) {
            $user->assignRole('superadmin');
            //Añadir usermeta
            $display_name = $user->first_name . ' '. $user->last_name;
            $display_name = explode(" ",$display_name);
            $countnames = count($display_name);
            if($countnames == 1){
                $display_name = $display_name[0];
            }elseif($countnames == 2){
                $display_name = $display_name[0].' '.$display_name[1];
            }elseif($countnames == 3 || $countnames == 4){
                $display_name = $display_name[0].' '.$display_name[2];
            }
            $username = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
            $user->usermeta()->save($username);
        });

        /**
         * Usuarios administrative
         */
        factory(App\User::class, 50)->create()->each(function($user) {
            $user->assignRole('administrative');
            //Añadir usermeta
            $display_name = $user->first_name . ' '. $user->last_name;
            $display_name = explode(" ",$display_name);
            $countnames = count($display_name);
            if($countnames == 1){
                $display_name = $display_name[0];
            }elseif($countnames == 2){
                $display_name = $display_name[0].' '.$display_name[1];
            }elseif($countnames == 3 || $countnames == 4){
                $display_name = $display_name[0].' '.$display_name[2];
            }
            $username = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
            $user->usermeta()->save($username);
        });

        /**
         * Usuarios coordinator
         */
        factory(App\User::class, 25)->create()->each(function($user) {
            $user->assignRole('coordinator');
            //Añadir usermeta
            $display_name = $user->first_name . ' '. $user->last_name;
            $display_name = explode(" ",$display_name);
            $countnames = count($display_name);
            if($countnames == 1){
                $display_name = $display_name[0];
            }elseif($countnames == 2){
                $display_name = $display_name[0].' '.$display_name[1];
            }elseif($countnames == 3 || $countnames == 4){
                $display_name = $display_name[0].' '.$display_name[2];
            }
            $username = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
            $user->usermeta()->save($username);
        });

        /**
         * Usuarios teacher
         */
        factory(App\User::class, 30)->create()->each(function($user) {
            $user->assignRole('teacher');
            //Añadir usermeta
            $display_name = $user->first_name . ' '. $user->last_name;
            $display_name = explode(" ",$display_name);
            $countnames = count($display_name);
            if($countnames == 1){
                $display_name = $display_name[0];
            }elseif($countnames == 2){
                $display_name = $display_name[0].' '.$display_name[1];
            }elseif($countnames == 3 || $countnames == 4){
                $display_name = $display_name[0].' '.$display_name[2];
            }
            $username = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
            $user->usermeta()->save($username);
            //Crear teacher
            $user->teacher()->save(factory(App\Teacher::class)->make());
        });

        /**
         * Usuarios guardian
         */
        factory(App\User::class, 50)->create()->each(function($user) {
            $user->assignRole('guardian');
            //Añadir usermeta
            $display_name = $user->first_name . ' '. $user->last_name;
            $display_name = explode(" ",$display_name);
            $countnames = count($display_name);
            if($countnames == 1){
                $display_name = $display_name[0];
            }elseif($countnames == 2){
                $display_name = $display_name[0].' '.$display_name[1];
            }elseif($countnames == 3 || $countnames == 4){
                $display_name = $display_name[0].' '.$display_name[2];
            }
            $username = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
            $user->usermeta()->save($username);
            //Crear guardian
            $user->guardian()->save(factory(App\Guardian::class)->make());
        });

        /**
         * Usuarios student
         */
        factory(App\User::class, 100)->create()->each(function($user) {
            $user->assignRole('student');
            //Añadir usermeta
            $display_name = $user->first_name . ' '. $user->last_name;
            $display_name = explode(" ",$display_name);
            $countnames = count($display_name);
            if($countnames == 1){
                $display_name = $display_name[0];
            }elseif($countnames == 2){
                $display_name = $display_name[0].' '.$display_name[1];
            }elseif($countnames == 3 || $countnames == 4){
                $display_name = $display_name[0].' '.$display_name[2];
            }
            $username = new Usermeta(['name' => 'display_name', 'value' => $display_name]);
            $user->usermeta()->save($username);
            //Crear student
            $user->student()->save(factory(App\Student::class)->make());
        });

        $class1a = new Classroom();
        $class1a->year_id = 2;
        $class1a->headquarter_id = 2;
        $class1a->schoolday_id = 3;
        $class1a->director_id = rand(1,30);
        $class1a->grade_id = 1;
        $class1a->name = 'Primero A';
        $class1a->quota = rand(28,35);
        $class1a->save();

        $class1b = new Classroom();
        $class1b->year_id = 2;
        $class1b->headquarter_id = 2;
        $class1b->schoolday_id = 3;
        $class1b->director_id = rand(1,30);
        $class1b->grade_id = 1;
        $class1b->name = 'Primero B';
        $class1b->quota = rand(28,35);
        $class1b->save();

        $class2a = new Classroom();
        $class2a->year_id = 2;
        $class2a->headquarter_id = 2;
        $class2a->schoolday_id = 3;
        $class2a->director_id = rand(1,30);
        $class2a->grade_id = 2;
        $class2a->name = 'Segundo A';
        $class2a->quota = rand(28,35);
        $class2a->save();

        $class2b = new Classroom();
        $class2b->year_id = 2;
        $class2b->headquarter_id = 2;
        $class2b->schoolday_id = 3;
        $class2b->director_id = rand(1,30);
        $class2b->grade_id = 2;
        $class2b->name = 'Segundo B';
        $class2b->quota = rand(28,35);
        $class2b->save();

        $class3a = new Classroom();
        $class3a->year_id = 2;
        $class3a->headquarter_id = 2;
        $class3a->schoolday_id = 3;
        $class3a->director_id = rand(1,30);
        $class3a->grade_id = 3;
        $class3a->name = 'Tercero A';
        $class3a->quota = rand(28,35);
        $class3a->save();

        $class3b = new Classroom();
        $class3b->year_id = 2;
        $class3b->headquarter_id = 2;
        $class3b->schoolday_id = 3;
        $class3b->director_id = rand(1,30);
        $class3b->grade_id = 3;
        $class3b->name = 'Tercero B';
        $class3b->quota = rand(28,35);
        $class3b->save();

        $class4a = new Classroom();
        $class4a->year_id = 2;
        $class4a->headquarter_id = 2;
        $class4a->schoolday_id = 3;
        $class4a->director_id = rand(1,30);
        $class4a->grade_id = 4;
        $class4a->name = 'Cuarto A';
        $class4a->quota = rand(28,35);
        $class4a->save();

        $class4b = new Classroom();
        $class4b->year_id = 2;
        $class4b->headquarter_id = 2;
        $class4b->schoolday_id = 3;
        $class4b->director_id = rand(1,30);
        $class4b->grade_id = 4;
        $class4b->name = 'Cuarto B';
        $class4b->quota = rand(28,35);
        $class4b->save();

        $class5a = new Classroom();
        $class5a->year_id = 2;
        $class5a->headquarter_id = 2;
        $class5a->schoolday_id = 3;
        $class5a->director_id = rand(1,30);
        $class5a->grade_id = 5;
        $class5a->name = 'Quinto A';
        $class5a->quota = rand(28,35);
        $class5a->save();

        $class5b = new Classroom();
        $class5b->year_id = 2;
        $class5b->headquarter_id = 2;
        $class5b->schoolday_id = 3;
        $class5b->director_id = rand(1,30);
        $class5b->grade_id = 5;
        $class5b->name = 'Quinto B';
        $class5b->quota = rand(28,35);
        $class5b->save();
    }
}
