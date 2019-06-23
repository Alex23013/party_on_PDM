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
Route::get('/pdf', 'HomeController@pdf');

Route::get('/profile', 'UserController@profile');

// E-mail verification
Route::get('/register/verify/{id}/{code}', 'UserController@verify');

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
Route::group(['middleware' => ['token']], function () {
	//patients	
	Route::post('/api/v2/patient_get_data/{user_id}', 'RestPatientsController@get_data');
	Route::post('/api/v2/patient_edit_profile', 'RestPatientsController@profile');
	Route::post('/api/v2/patient_inbox/','RestPatientsController@inbox');
	Route::post('/api/v2/patient_appointments/','RestPatientsController@appointments');
	Route::post('/api/v2/patient_update_status_appointment/','RestPatientsController@update_status_appointment');

	Route::post('/api/v2/patient_services/', 'RestPatientsController@services');
	Route::post('/api/v2/patients_partners_by_service_id/{service_id}', 'RestPatientsController@partners_by_service');
	Route::post('/api/v2/patients_store_dservice', 'RestPatientsController@store_dservices');

	//doctors
	Route::post('/api/v2/doctor_update_data', 'RestDoctorController@update_data');
	Route::post('/api/v2/doctor_specialties/', 'RestDoctorController@specialties');
	Route::post('/api/v2/doctor_get_data/{user_id}', 'RestDoctorController@get_data');
	Route::post('/api/v2/doctor_get_schedule/', 'RestDoctorController@get_schedule');
	Route::post('/api/v2/doctor_appointments', 'RestDoctorController@appointments');

	Route::post('/api/v2/doctor_update_available/','RestDoctorController@update_available');	
	});
// -------- END_POINTS_V2

//Techs 
Route::get('/techs', 'TuserController@index');
Route::get('/techs/add', 'TuserController@add');
Route::post('/techs', 'TuserController@store');
Route::get('/techs/remove/{id}', 'TuserController@delete');
Route::get('/techs/{id}/active', 'TuserController@active');
Route::get('/techs/{id}/deactive', 'TuserController@deactive');
Route::get('/techs/edit/{id}', 'TuserController@update');
Route::post('/techs/edit', 'TuserController@store_update');

//Partners
Route::get('/partners', 'PartnerController@index');
Route::get('/partners/detail/{id}', 'PartnerController@detail');
Route::get('/partners/add', 'PartnerController@add');
Route::post('/partners', 'PartnerController@store');
Route::get('/partners/remove/{id}', 'PartnerController@delete');
Route::get('/partners/edit/{id}', 'PartnerController@update');
Route::post('/partners/edit', 'PartnerController@store_update');

//Patients
Route::get('/patients', 'PatientController@index');
Route::get('/patients/detail/{id}', 'PatientController@detail');
Route::get('/patients/add/{type}', 'PatientController@add');
Route::post('/patients', 'PatientController@store');
Route::get('/patients/remove/{id}', 'PatientController@delete');
Route::get('/patients/edit/{id}', 'PatientController@update');
Route::post('/patients/edit', 'PatientController@store_update');
//future middleware for role patient
Route::get('/patients/update_status_appointment/{app_id}/{new_status}', 'PatientController@update_status_appointment');
Route::get('/patients/appointments/{app_status}', 'PatientController@appointments');
Route::get('/patients/history_appointments', 'PatientController@history_appointments');
Route::get('/patients/new_inbox_emergency', 'PatientController@inbox_emergency');
Route::get('/patients/new_inbox_appointment', 'PatientController@inbox_appointment');
Route::post('/patients/new_inbox', 'PatientController@inbox');
Route::get('/patients/services', 'PatientController@services');
Route::get('/patients/services/{service_id}', 'PatientController@partners_by_service');
Route::get('/patients/add_dservices/{service_id}/{partner_id}', 'PatientController@add_dservices');
Route::post('/patients/add_dservices', 'PatientController@store_dservices');
Route::get('/patients/clinic_history/', 'PatientController@patient_histories');
Route::get('/patients/clinic_history/see/{id}', 'PatientController@patient_histories_detail');
Route::get('/patients/clinic_history/request/{id}', 'PatientController@request_pdf');




//Doctors_schedule
Route::get('/doctors/schedule', 'DoctorController@index');
Route::get('/doctors/schedule/detail/{id}', 'DoctorController@detail');
Route::get('/doctors/schedule/edit/{id}', 'DoctorController@update');
Route::post('/doctors/schedule/edit', 'DoctorController@store_update');
Route::get('/doctors/schedule/assign/{id}', 'DoctorController@assign');

//eDoctors_schedule
Route::get('/edoctors/schedule', 'EdoctorController@index');
Route::post('/edoctors/schedule', 'EdoctorController@search');
Route::get('/edoctors/schedule/add', 'EdoctorController@add');
Route::post('/edoctors/schedule/add', 'EdoctorController@store');
Route::post('/ajax_get_doctors','EdoctorController@ajax_get_doctors');


//p_services
Route::get('/p_services/{id_P}', 'Partner_serviceController@index')->where(['id_P' => '[0-9]+']);
Route::get('/p_services/{id_P}/add', 'Partner_serviceController@add');
Route::post('/p_services/{id_P}', 'Partner_serviceController@store');
Route::get('/p_services/{id_P}/edit/{id}', 'Partner_serviceController@update');
Route::post('/p_services/{id_P}/edit', 'Partner_serviceController@store_update');
Route::get('/p_services/{id_P}/{id}/active', 'Partner_serviceController@active');
Route::get('/p_services/{id_P}/{id}/deactive', 'Partner_serviceController@deactive');
Route::get('/p_services/remove/{id_P}/{id}', 'Partner_serviceController@delete');

//Route::get('/toCapitalLetters', 'Partner_serviceController@toCapital');

//d_services
Route::get('/d_services', 'DocDoor_serviceController@index');
Route::get('/d_services/add', 'DocDoor_serviceController@add');
Route::post('/d_services', 'DocDoor_serviceController@postAddDocDoorService');
Route::get('/d_services/{id}/complete', 'DocDoor_serviceController@complete');
Route::get('/d_services/detail/{id}', 'DocDoor_serviceController@detail');
Route::get('/d_services/remove/{id}', 'DocDoor_serviceController@delete');
Route::get('/d_services/edit/{id}', 'DocDoor_serviceController@update');
Route::post('/d_services/edit', 'DocDoor_serviceController@store_update');

//admin
Route::group(['middleware' => ['admin']], function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/add/{role}', 'UserController@add');
	Route::get('/users/{id}/active', 'UserController@active');
	Route::get('/users/{id}/deactive', 'UserController@deactive');
	Route::post('/users', 'UserController@store');
	Route::get('/users/remove/{id}', 'UserController@delete');
	Route:: get('/clinic_histories', 'HistoryController@clinic_histories');
	Route:: get('/clinic_histories/update_pdf_status_appointment/{id}/{new_status}', 'HistoryController@update_pdf_status_appointment');
	
});

Route::get('/users/profile/edit', 'UserController@update');
Route::post('/users/profile/edit', 'UserController@store_update');
Route::post('/users/image_profile/edit', 'UserController@storeImageProfile');
Route::get('/users/see/{id}', 'UserController@detail');
Route::get('/users/edit/{id}', 'UserController@user_update');
Route::post('/users/edit/', 'UserController@store_user_update');
Route::get('/users/especific/edit', 'UserController@especific_edit');
Route::post('/users/especific/edit', 'UserController@store_especific_edit');

//emergencies
Route::get('/emergency', 'EmergencyController@index');
Route::get('/emergency/detail/{id}/{is_attention}', 'EmergencyController@detail');
Route::get('/emergency/add', 'EmergencyController@add');
Route::get('/u/emergency/add', 'EmergencyController@add_unregisted_emergency');
Route::post('/u/emergency', 'EmergencyController@store_unregisted_emergency');
Route::post('/emergency', 'EmergencyController@store');
Route::get('/emergency/remove/{id}/{is_attention}', 'EmergencyController@delete');


//appointments
Route::get('/appointments', 'AppointmentController@index');
Route::get('/appointments/detail/{id}', 'AppointmentController@detail');
Route::get('/appointments/add', 'AppointmentController@add');
Route::post('/appointments', 'AppointmentController@store_real_time');
Route::get('/appointments/edit/{id}', 'AppointmentController@update');
Route::post('/appointments/edit', 'AppointmentController@store_update');
Route::get('/appointments/remove/{id}', 'AppointmentController@delete');

Route::post('/ajax_get_doctors_per_specialty','AppointmentController@ajax_get_doctors');

// tcalls of the traige main-menu
Route::get('/tcalls/complete/{id}', 'TCallController@complete');
Route::get('/tcalls/remove/{id}', 'TCallController@delete');
Route::get('/aj/{id}', 'AppointmentController@aj_docs');




