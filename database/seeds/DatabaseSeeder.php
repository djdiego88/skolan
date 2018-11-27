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
        $parent = Role::create(['name' => 'parent', 'display_name'=> 'Acudiente']);
        //$candidate = Role::create(['name' => 'candidate', 'display_name'=> 'Candidato']);
        //Creación de permisos
        $adminOptions = Permission::create(['name' => 'admin-options', 'display_name'=> 'Opciones de configuración']);
        $adminUser = Permission::create(['name' => 'admin-user', 'display_name'=> 'Administrar usuarios']);
        $adminRole = Permission::create(['name' => 'admin-role', 'display_name'=> 'Administrar roles']);
        $adminPermission = Permission::create(['name' => 'admin-permission', 'display_name'=> 'Administrar permisos']);
        $adminStudent = Permission::create(['name' => 'admin-student', 'display_name'=> 'Administrar estudiantes']);
        $adminParent = Permission::create(['name' => 'admin-parent', 'display_name'=> 'Administrar acudientes']);
        $adminTeacher = Permission::create(['name' => 'admin-teacher', 'display_name'=> 'Administrar docentes']);
        $editStudent = Permission::create(['name' => 'edit-student', 'display_name'=> 'Editar estudiantes']);
        $editParent = Permission::create(['name' => 'edit-parent', 'display_name'=> 'Editar acudientes']);
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
		$administrative->givePermissionTo([$adminStudent,$adminParent,$adminTeacher,$adminGrade,$adminClassroom,$adminSubject,$adminSchedule,$adminArea,$adminHQ,$adminSchoolday,$adminYear,$adminSchoolterm,$adminEnrollment,$adminAbsence,$adminAnnotation,$adminHomework,$adminQualification, $viewActivityLog, $adminTests, $editTests, $viewTests]);
		$coordinator->givePermissionTo([$adminSchedule,$adminEnrollment,$adminAbsence,$adminAnnotation,$viewHomework,$viewQualification, $adminTests, $editTests, $viewTests]);
		$teacher->givePermissionTo([$adminAbsence,$adminAnnotation,$viewHomework,$viewQualification, $adminTests, $editTests, $viewTests]);
		$student->givePermissionTo([$viewAbsence,$viewAnnotation,$viewHomework,$viewQualification, $viewTests]);
		$parent->givePermissionTo([$viewAbsence,$viewAnnotation,$viewHomework,$viewQualification]);
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
		$superAdminUser->photo = 'storage/images/photos/foto-documento-grande--cuadrado.jpg';
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
		$optionSiteLogo->value = 'storage/images/logo/logo-default.png';
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

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'nit';
        $optionYoutubePage->display_name = 'N.I.T.';
        $optionYoutubePage->description = 'N.I.T. de la institución educativa.';
        $optionYoutubePage->value = '';
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'telephone';
        $optionYoutubePage->display_name = 'Teléfono';
        $optionYoutubePage->description = 'Número telefónico de la institución educativa.';
        $optionYoutubePage->value = '';
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'state';
        $optionYoutubePage->display_name = 'Departamento';
        $optionYoutubePage->description = 'Departamento de la institución educativa.';
        $optionYoutubePage->value = 'Bogotá D.C.';
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'city';
        $optionYoutubePage->display_name = 'Ciudad';
        $optionYoutubePage->description = 'Ciudad de la institución educativa.';
        $optionYoutubePage->value = 'Bogotá D.C.';
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'principal';
        $optionYoutubePage->display_name = 'Rector(a)';
        $optionYoutubePage->description = 'Nombre del rector(a) de la institución educativa.';
        $optionYoutubePage->value = '';
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'secretary';
        $optionYoutubePage->display_name = 'Secretario(a)';
        $optionYoutubePage->description = 'Nombre del secretario(a) de la institución educativa.';
        $optionYoutubePage->value = '';
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'min_qualification';
        $optionYoutubePage->display_name = 'Calificación mínima';
        $optionYoutubePage->description = 'Calificación mínima del sistema de notas.';
        $optionYoutubePage->value = 1;
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'max_qualification';
        $optionYoutubePage->display_name = 'Calificación máxima';
        $optionYoutubePage->description = 'Calificación mínima del sistema de notas.';
        $optionYoutubePage->value = 5;
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'min_qualification_pass';
        $optionYoutubePage->display_name = 'Calificación mínima para aprobar';
        $optionYoutubePage->description = 'Calificación mínima para que un estudiante apruebe';
        $optionYoutubePage->value = 3;
        $optionYoutubePage->save();

        $optionYoutubePage = new Option();
        $optionYoutubePage->name = 'decimal_positions';
        $optionYoutubePage->display_name = 'Posiciones decimales';
        $optionYoutubePage->description = 'Posiciones decimales para las notas registradas en el sistema de evaluación.';
        $optionYoutubePage->value = 2;
        $optionYoutubePage->save();

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
    }
}
