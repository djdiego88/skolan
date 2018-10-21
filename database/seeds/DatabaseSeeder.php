<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Usermeta;
use App\Option;

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
        $superadmin = Role::create(['name' => 'superadmin']);
        $administrative = Role::create(['name' => 'administrative']);
        $coordinator = Role::create(['name' => 'coordinator']);
        $teacher = Role::create(['name' => 'teacher']);
        $student = Role::create(['name' => 'student']);
        $parent = Role::create(['name' => 'parent']);
        $candidate = Role::create(['name' => 'candidate']);
        //Creación de permisos
        $adminOptions = Permission::create(['name' => 'admin-options']);
        $adminUser = Permission::create(['name' => 'admin-user']);
        $adminRole = Permission::create(['name' => 'admin-role']);
        $adminPermission = Permission::create(['name' => 'admin-permission']);
        $adminStudent = Permission::create(['name' => 'admin-student']);
        $adminParent = Permission::create(['name' => 'admin-parent']);
        $adminTeacher = Permission::create(['name' => 'admin-teacher']);
        $editStudent = Permission::create(['name' => 'edit-student']);
        $editParent = Permission::create(['name' => 'edit-parent']);
        $editTeacher = Permission::create(['name' => 'edit-teacher']);
        $adminGrade = Permission::create(['name' => 'admin-grade']);
        $adminClassroom = Permission::create(['name' => 'admin-classroom']);
        $adminSubject = Permission::create(['name' => 'admin-subject']);
        $adminSchedule = Permission::create(['name' => 'admin-schedule']);
        $adminArea = Permission::create(['name' => 'admin-area']);
        $adminHQ = Permission::create(['name' => 'admin-hq']);
        $adminSchoolday = Permission::create(['name' => 'admin-schoolday']);
        $adminYear = Permission::create(['name' => 'admin-year']);
        $adminSchoolterm = Permission::create(['name' => 'admin-schoolterm']);
        $adminEnrollment = Permission::create(['name' => 'admin-enrollment']);
        $adminAbsence = Permission::create(['name' => 'admin-absence']);
        $viewAbsence = Permission::create(['name' => 'view-absence']);
        $adminAnnotation = Permission::create(['name' => 'admin-annotation']);
        $editAnnotation = Permission::create(['name' => 'edit-annotation']);
        $viewAnnotation = Permission::create(['name' => 'view-annotation']);
        $adminHomework = Permission::create(['name' => 'admin-homework']);
        $viewHomework = Permission::create(['name' => 'view-homework']);
        $adminQualification = Permission::create(['name' => 'admin-qualification']);
        $editQualification = Permission::create(['name' => 'edit-qualification']);
        $viewQualification = Permission::create(['name' => 'view-qualification']);
        $viewActivityLog = Permission::create(['name' => 'view-activitylog']);
        //Asignar permisos a roles
        $superadmin->givePermissionTo(Permission::all());
		$administrative->givePermissionTo([$adminStudent,$adminParent,$adminTeacher,$adminGrade,$adminClassroom,$adminSubject,$adminSchedule,$adminArea,$adminHQ,$adminSchoolday,$adminYear,$adminSchoolterm,$adminEnrollment,$adminAbsence,$adminAnnotation,$adminHomework,$adminQualification, $viewActivityLog]);
		$coordinator->givePermissionTo([$adminSchedule,$adminEnrollment,$adminAbsence,$adminAnnotation,$viewHomework,$viewQualification]);
		$teacher->givePermissionTo([$adminAbsence,$adminAnnotation,$viewHomework,$viewQualification]);
		$student->givePermissionTo([$viewAbsence,$viewAnnotation,$viewHomework,$viewQualification]);
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
		$superAdminUser->location = 'Bogotá';
		$superAdminUser->address = 'Calle 6C # 82A - 25';
		$superAdminUser->status = 'enabled';
		$superAdminUser->last_access = date('Y-m-d H:i:s');
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
		$optionItemsPerPage->value = 45;
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
    }
}
