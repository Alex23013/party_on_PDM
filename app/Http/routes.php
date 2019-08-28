<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/pdf', 'HomeController@pdf');

Route::get('/profile', 'UserController@profile');

// E-mail verification
Route::get('/register/verify/{id}/{code}', 'UserController@verify')->where(['id' => '[0-9]+']);

// ----  END_POINTS V1
// ----- patients ----------- //
Route::post('/api/v1/patient_register', 'RestPatientsController@register');
Route::get('/api/v1/patient_get_data/{user_id}', 'RestPatientsController@get_data');
Route::post('/api/v1/patient_edit_profile', 'RestPatientsController@profile');
Route::post('/api/v1/patient_inbox/','RestPatientsController@inbox');
Route::post('/api/v1/patient_appointments/','RestPatientsController@appointments');
Route::post('/api/v1/patient_update_status_appointment/','RestPatientsController@update_status_appointment');

// ----- users ----------- //
Route::post('/api/v1/user_login', 'RestUserController@login');
Route::post('/api/v1/recover_password', 'RestUserController@recover');
// ----- doctors ----------- //
Route::get('/api/v1/doctor_specialties/', 'RestDoctorController@specialties');
Route::post('/api/v1/doctor_update_data', 'RestDoctorController@update_data');
Route::get('/api/v1/doctor_get_data/{user_id}', 'RestDoctorController@get_data');
Route::get('/api/v1/doctor_get_schedule/{user_id}', 'RestDoctorController@get_schedule');

Route::get('/api/v1/appointments_confirmed/{user_id}', 'RestDoctorController@appointments_confirmed');
// -------- END_POINTS_V1

// ----  END_POINTS V2
Route::post('/api/v2/user_login', 'RestUserController@login_v2');
Route::post('/api/v2/unregisted_patient_inbox/','RestPatientsController@unregisted_inbox');
Route::group(['middleware' => ['token']], function () {
	//patients	
	Route::post('/api/v2/patient_get_data/{user_id}', 'RestPatientsController@get_data');
	Route::post('/api/v2/patient_edit_profile', 'RestPatientsController@profile');
	Route::post('/api/v2/patient_inbox/','RestPatientsController@inbox');
	Route::post('/api/v2/patient_appointments/','RestPatientsController@appointments');
	Route::post('/api/v2/patient_edit_appointment_location/','RestPatientsController@edit_appointment_location');
	Route::post('/api/v2/patient_update_status_appointment/','RestPatientsController@update_status_appointment');
	Route::post('/api/v2/patient_services/', 'RestPatientsController@services');
	Route::post('/api/v2/patients_partners_by_service_id/', 'RestPatientsController@partners_by_service');
	Route::post('/api/v2/patients_store_dservice', 'RestPatientsController@store_dservices');
	Route::post('/api/v2/patient_my_dservices', 'RestPatientsController@my_dservices');


	//doctors
	Route::post('/api/v2/doctor_update_data', 'RestDoctorController@update_data');
	Route::post('/api/v2/doctor_specialties/', 'RestDoctorController@specialties');
	Route::post('/api/v2/doctor_get_data/{user_id}', 'RestDoctorController@get_data');
	Route::post('/api/v2/doctor_get_schedule/', 'RestDoctorController@get_schedule');
	Route::post('/api/v2/doctor_appointments', 'RestDoctorController@appointments');
	////collection_extra:falta compartir
	Route::post('/api/v2/doctor_active/','RestDoctorController@active');
	Route::post('/api/v2/doctor_deactive/','RestDoctorController@deactive');	
	////collection_viernes
	Route::post('/api/v2/doctor_attend_appointment/','RestDoctorController@attend_appointment');	
	Route::post('/api/v2/doctor_create_history/','RestDoctorController@create_history');	
	Route::post('/api/v2/doctor_get_bag/','RestDoctorController@get_bag');
	Route::post('/api/v2/doctor_create_recipe/','RestDoctorController@create_recipe');
	Route::post('/api/v2/doctor_get_recipe/','RestDoctorController@get_recipe');
	Route::post('/api/v2/doctor_cancel_appointment/','RestDoctorController@cancel_appointment');
	Route::post('/api/v2/get_medicines_groups/','RestDoctorController@get_medicines_groups');
	
	});
// -------- END_POINTS_V2


//Specialties
Route::get('/specialties', 'SpecialtyController@index'); 	
Route::get('/specialties/edit/{id}', 'SpecialtyController@update')->where(['id' => '[0-9]+']);
Route::post('/specialties/edit', 'SpecialtyController@store_update');	
Route::get('/specialties/add', 'SpecialtyController@add');
Route::post('/specialties/add', 'SpecialtyController@store');
Route::get('/specialties/remove/{id}', 'SpecialtyController@delete')->where(['id' => '[0-9]+']);

//Medicines
Route::get('/medicines', 'MedicineController@index'); 	
Route::get('/medicines/add', 'MedicineController@add');
Route::post('/medicines/add', 'MedicineController@store');
Route::get('/medicines/remove/{id}', 'MedicineController@delete')->where(['id' => '[0-9]+']);

//Services
Route::get('/services', 'ServiceController@index'); 	
Route::get('/services/edit/{id}', 'ServiceController@update')->where(['id' => '[0-9]+']);
Route::post('/services/edit', 'ServiceController@store_update');	
Route::get('/services/add/{id_P}', 'ServiceController@add')->where(['id_P' => '[0-9]+']);
Route::post('/services/add', 'ServiceController@store');
Route::get('/services/remove/{id}', 'ServiceController@delete')->where(['id' => '[0-9]+']);


//Techs 
Route::get('/techs', 'TuserController@index'); 		
Route::get('/techs/add', 'TuserController@add');
Route::post('/techs', 'TuserController@store');
Route::get('/techs/remove/{id}', 'TuserController@delete')->where(['id' => '[0-9]+']);
Route::get('/techs/{id}/active', 'TuserController@active')->where(['id' => '[0-9]+']);
Route::get('/techs/{id}/deactive', 'TuserController@deactive')->where(['id' => '[0-9]+']);
Route::get('/techs/edit/{id}', 'TuserController@update')->where(['id' => '[0-9]+']);
Route::post('/techs/edit', 'TuserController@store_update');

//Partners
Route::get('/partners', 'PartnerController@index');
Route::get('/partners/detail/{id}', 'PartnerController@detail')->where(['id' => '[0-9]+']);
Route::get('/partners/add', 'PartnerController@add');
Route::post('/partners', 'PartnerController@store');
Route::get('/partners/remove/{id}', 'PartnerController@delete')->where(['id' => '[0-9]+']);
Route::get('/partners/edit/{id}', 'PartnerController@update')->where(['id' => '[0-9]+']);
Route::post('/partners/edit', 'PartnerController@store_update');

//Patients
Route::get('/patients', 'PatientController@index');
Route::get('/patients/detail/{id}', 'PatientController@detail')->where(['id' => '[0-9]+']);
Route::get('/patients/add/{type}', 'PatientController@add')->where(['type' => '[0-1]']);
Route::post('/patients', 'PatientController@store');
Route::get('/patients/remove/{id}', 'PatientController@delete')->where(['id' => '[0-9]+']);
Route::get('/patients/edit/{id}', 'PatientController@update')->where(['id' => '[0-9]+']);
Route::post('/patients/edit', 'PatientController@store_update');

//future middleware for role patient
Route::get('/patients/update_status_appointment/{app_id}/{new_status}', 'PatientController@update_status_appointment')->where(['app_id' => '[0-9]+'],['new_status' => '[0-3]']);
Route::get('/patients/appointments/{app_status}', 'PatientController@appointments')->where(['app_status' => '[0-3]']);
Route::get('/patients/history_appointments', 'PatientController@history_appointments');
Route::get('/patients/attention_report/{att_id}', 'PatientController@attention_report')->where(['att_id' => '[0-9]+']);
Route::get('/patients/new_inbox_emergency', 'PatientController@inbox_emergency');
Route::get('/patients/new_inbox_appointment', 'PatientController@inbox_appointment');
Route::post('/patients/new_inbox', 'PatientController@inbox');
Route::get('/patients/services', 'PatientController@services');
Route::get('/patients/services/{service_id}', 'PatientController@partners_by_service')->where(['service_id' => '[0-9]+']);
Route::get('/patients/add_dservices/{service_id}/{partner_id}/{cost}', 'PatientController@add_dservices')->where(['service_id' => '[0-9]+'],['partner_id' => '[0-9]+'],['cost' => '[0-9]+']);
Route::post('/patients/add_dservices', 'PatientController@store_dservices');
Route::get('/patients/clinic_history/', 'PatientController@patient_histories');
Route::get('/patients/clinic_history/see/{id}', 'PatientController@patient_histories_detail')->where(['id' => '[0-9]+']);
Route::get('/patients/clinic_history/request/{id}', 'PatientController@request_pdf')->where(['id' => '[0-9]+']);

Route::get('/patients/appointment_detail/{id}', 'PatientController@app_detail')->where(['id' => '[0-9]+']);
Route::post('/patients/update_location_appointment', 'PatientController@update_location_appointment');
Route::post('/patients/payment', 'PatientController@payment');
Route::get('/patients/payment_app/{token}', 'PatientController@payment_app');
Route::post('/patients/payment_app/', 'PatientController@post_payment_app');
Route::get('/patients/my_d_services','PatientController@my_d_services');
Route::get('/patients/recipe_report/{app_id}', 'PatientController@recipe_report')->where(['app_id' => '[0-9]+']);


//Doctors_schedule
Route::get('/doctors/schedule', 'DoctorController@index');
Route::get('/rdoctors/schedule', 'DoctorController@index_r');
Route::get('/doctors/schedule/detail/{id}', 'DoctorController@detail')->where(['id' => '[0-9]+']);
Route::get('/doctors/schedule/edit/{id}', 'DoctorController@update')->where(['id' => '[0-9]+']);
Route::post('/doctors/schedule/edit', 'DoctorController@store_update');
Route::get('/doctors/schedule/assign/{id}', 'DoctorController@assign')->where(['id' => '[0-9]+']);

//eDoctors_schedule
Route::get('/edoctors/schedule', 'EdoctorController@index');
Route::get('/edoctors/schedule/{id}', 'EdoctorController@detail')->where(['id' => '[0-9]+']);
Route::get('/edoctors/schedule/remove/{id}', 'EdoctorController@remove')->where(['id' => '[0-9]+']);
Route::post('/edoctors/schedule', 'EdoctorController@search');
Route::get('/edoctors/schedule/add', 'EdoctorController@add');
Route::post('/edoctors/schedule/add', 'EdoctorController@store');
Route::post('/edoctors/schedule/other/add', 'EdoctorController@other_store');

//p_services
Route::get('/p_services/{id_P}', 'Partner_serviceController@index')->where(['id_P' => '[0-9]+']);
Route::get('/p_services/{id_P}/add', 'Partner_serviceController@add')->where(['id_P' => '[0-9]+']);
Route::post('/p_services/{id_P}', 'Partner_serviceController@store')->where(['id_P' => '[0-9]+']);
Route::get('/p_services/{id_P}/edit/{id}', 'Partner_serviceController@update')->where(['id_P' => '[0-9]+'],['id' => '[0-9]+']);
Route::post('/p_services/{id_P}/edit', 'Partner_serviceController@store_update')->where(['id_P' => '[0-9]+']);
Route::get('/p_services/{id_P}/{id}/active', 'Partner_serviceController@active')->where(['id_P' => '[0-9]+'],['id' => '[0-9]+']);
Route::get('/p_services/{id_P}/{id}/deactive', 'Partner_serviceController@deactive')->where(['id_P' => '[0-9]+'],['id' => '[0-9]+']);
Route::get('/p_services/remove/{id_P}/{id}', 'Partner_serviceController@delete')->where(['id_P' => '[0-9]+'],['id' => '[0-9]+']);

//Route::get('/toCapitalLetters', 'Partner_serviceController@toCapital');

//d_services
Route::get('/d_services', 'DocDoor_serviceController@index');
Route::get('/d_services/add', 'DocDoor_serviceController@add');
Route::post('/d_services', 'DocDoor_serviceController@postAddDocDoorService');
Route::get('/d_services/{id}/complete', 'DocDoor_serviceController@complete')->where(['id' => '[0-9]+']);
Route::get('/d_services/detail/{id}', 'DocDoor_serviceController@detail')->where(['id' => '[0-9]+']);
Route::get('/d_services/remove/{id}', 'DocDoor_serviceController@delete')->where(['id' => '[0-9]+']);
Route::get('/d_services/edit/{id}', 'DocDoor_serviceController@update')->where(['id' => '[0-9]+']);
Route::post('/d_services/edit', 'DocDoor_serviceController@store_update');
Route::post('/ajax/d_services/get_partners/', 'DocDoor_serviceController@ajax_get_partners')->where(['service_id' => '[0-9]+']);

//admin
Route::group(['middleware' => ['admin']], function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/add/{role}', 'UserController@add')->where(['role' => '[0-3]']);
	Route::get('/users/{id}/active', 'UserController@active')->where(['id' => '[0-9]+']);
	Route::get('/users/{id}/deactive', 'UserController@deactive')->where(['id' => '[0-9]+']);
	Route::post('/users', 'UserController@store');
	Route::get('/users/remove/{id}', 'UserController@delete')->where(['id' => '[0-9]+']);
	Route:: get('/clinic_histories', 'HistoryController@clinic_histories');
	Route:: get('/clinic_histories/update_pdf_status_appointment/{id}/{new_status}', 'HistoryController@update_pdf_status_appointment')->where(['id' => '[0-9]+'],['new_status' => '[0-2]+']);
	
});

Route::get('/users/profile/edit', 'UserController@update');
Route::post('/users/profile/edit', 'UserController@store_update');
Route::post('/users/image_profile/edit', 'UserController@storeImageProfile');
Route::get('/users/see/{id}', 'UserController@detail')->where(['id' => '[0-9]+']);
Route::get('/users/edit/{id}', 'UserController@user_update')->where(['id' => '[0-9]+']);
Route::post('/users/edit/', 'UserController@store_user_update');
Route::get('/users/especific/edit', 'UserController@especific_edit');
Route::post('/users/especific/edit', 'UserController@store_especific_edit');

//emergencies
Route::get('/emergency', 'EmergencyController@index');
Route::get('/emergency/detail/{id}/{is_attention}', 'EmergencyController@detail')->where(['id' => '[0-9]+']);
Route::get('/emergency/add', 'EmergencyController@add');
Route::get('/u/emergency/add', 'EmergencyController@add_unregisted_emergency');
Route::post('/u/emergency', 'EmergencyController@store_unregisted_emergency');
Route::post('/emergency', 'EmergencyController@store');
Route::get('/emergency/remove/{id}/{is_attention}', 'EmergencyController@delete')->where(['id' => '[0-9]+'],['is_attention'=>'[0-1]']);


//appointments
Route::get('/appointments', 'AppointmentController@index');
Route::get('/appointments/detail/{id}', 'AppointmentController@detail')->where(['id' => '[0-9]+']);
Route::get('/appointments/add', 'AppointmentController@add');
Route::post('/appointments', 'AppointmentController@store_real_time');
Route::get('/appointments/edit/{id}', 'AppointmentController@update')->where(['id' => '[0-9]+']);
Route::post('/appointments/edit', 'AppointmentController@store_update');
Route::get('/appointments/remove/{id}', 'AppointmentController@delete')->where(['id' => '[0-9]+']);
Route::get('/appointments/update_status/{id}/{new_status}', 'AppointmentController@update_status')->where(['id' => '[0-9]+'],['new_status' => '[0-3]']);


Route::post('/ajax_get_doctors_per_specialty','AppointmentController@ajax_get_doctors');
Route::post('/ajax_get_events_by_user_id','EdoctorController@ajax_get_events');
Route::post('/ajax_get_schedule_by_user_id','EdoctorController@ajax_get_schedules');
Route::post('/ajax_validate_date_future','EdoctorController@ajax_validate_date_future');
Route::post('/ajax_validate_time_interval','EdoctorController@ajax_validate_time_interval');

Route::post('/ajax_validate_date','AppointmentController@ajax_validate_date');
Route::post('/ajax_validate_time','AppointmentController@ajax_validate_time');

// tcalls of the traige main-menu
Route::get('/tcalls/complete/{id}', 'TCallController@complete')->where(['id' => '[0-9]+']);
Route::get('/tcalls/remove/{id}', 'TCallController@delete')->where(['id' => '[0-9]+']);

//Doctor_kits
Route::get('/kits', 'KitController@index');
Route::get('/kits/create', 'KitController@create');
Route::post('/kits', 'KitController@store');
Route::post('/kits/addDoctorkit', 'KitController@addDoctorkit');
Route::get('/kits/detail/{id}', 'KitController@detail')->where(['id' => '[0-9]+']);
Route::get('/kits/removeDoctorkit/{id}/{kit_id}', 'KitController@removeDoctorkit')->where(['id' => '[0-9]+'],['kit_id' => '[0-9]+']);
Route::get('/kits/remove/{id}', 'KitController@destroy')->where(['id' => '[0-9]+']);

//rutas de prueba eliminar al final de la etapa de desarrollo
Route::get('/aj/{id}', 'AppointmentController@aj_docs')->where(['id' => '[0-9]+']);
Route::get('/val_m_general/{user_id}/{input_date}', 'AppointmentController@validate_medico_general');
Route::get('/val_m_especialista/{user_id}/{input_date}', 'AppointmentController@validate_especialista');

Route::get('/val_t_general/{user_id}/{input_date}/{input_time}', 'AppointmentController@val_time_general');
Route::get('/val_t_especialista/{input_date}/{input_time}/{user_id}', 'AppointmentController@val_time_especialidad');

Route::get('/maps', 'AppointmentController@maps');

Route::get('/new_bag/{kit_id}', 'RestDoctorController@new_bag');


Route::get('/d_services/partners/{service_id}', 'DocDoor_serviceController@get_partners')->where(['service_id' => '[0-9]+']);
