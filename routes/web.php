<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
Route::view('/', 'index')->name('index');
// Regions
Route::view('All_Region', 'superadmin.region.index')->name('All_Region');
Route::view('Add_Region', 'superadmin.region.create')->name('Add_Region');
Route::view('Show_Region', 'superadmin.region.show')->name('Show_Region');

Route::resource('region','RegionController');

// Member
Route::view('All_Member', 'superadmin.member.index')->name('All_Member');
Route::view('Add_Member', 'superadmin.member.create')->name('Add_Member');
Route::view('Show_Member', 'superadmin.member.show')->name('Show_Member');

Route::resource('member','MemberController');


Route::resource('obituary','ObituaryController');
// Admin
Route::view('All_Admin', 'superadmin.admin.index')->name('All_Admin');
Route::view('Add_Admin', 'superadmin.admin.create')->name('Add_Admin');
Route::view('Show_Admin', 'superadmin.admin.show')->name('Show_Admin');

Route::resource('samiti','SamitiController');

// Commitee
Route::view('All_Samiti', 'superadmin.samiti.index')->name('All_Samiti');
Route::view('Add_Samiti', 'superadmin.samiti.create')->name('Add_Samiti');
Route::view('Show_Samiti', 'superadmin.samiti.show')->name('Show_Samiti');

// Events
Route::view('All_Events', 'superadmin.events.index')->name('All_Events');
Route::view('Add_Events', 'superadmin.events.create')->name('Add_Events');
Route::view('Show_Events', 'superadmin.events.show')->name('Show_Events');

// Events
Route::view('All_Venue', 'superadmin.venue.index')->name('All_Venue');
Route::view('Add_Venue', 'superadmin.venue.create')->name('Add_Venue');
Route::view('Show_venue', 'superadmin.venue.show')->name('Show_venue');

//obituary
Route::view('All_obituary', 'superadmin.obituary.index')->name('All_obituary');
Route::view('Add_obituary', 'superadmin.obituary.create')->name('Add_obituary');

// Admin Events
// Route::view('View_All_Events', 'user.index')->name('View_Events');
// Route::view('User_Profile', 'user.profile')->name('User_Profile');

Route::get('User_Profile','userprofilecontroller@index')->name('User_Profile');
Route::post('user_profile_update','userprofilecontroller@update')->name('user_profile_update');
Route::post('get_member_by_page','MemberController@get_members')->name('get_member_by_page');
Route::post('get_regions_all','RegionController@get_regions_all')->name('get_regions_all');


Route::get('create_venue','VenueController@store')->name('create_venue');

Route::get('add_venue','VenueController@create')->name('add_venue');

Route::get('get_venue','VenueController@index')->name('get_venue');

Route::post('create_event','EventController@store')->name('create_event');

Route::post('update_event','EventController@update')->name('update_event');

Route::get('add_event','EventController@create')->name('add_event');

Route::get('get_event','EventController@index')->name('get_event');

Route::get('View_All_Events','EventController@view_user_events')->name('View_Events');

Route::get('check_no','MemberController@check_no')->name('check_no');

Route::post('add_member_to_region','RegionController@add_member_to_region')->name('add_member_to_region');

Route::post('get_member_from_region','RegionController@get_member_from_region')->name('get_member_from_region');

Route::post('remove_member_from_region','RegionController@remove_member_from_region')->name('remove_member_from_region');

Route::post('interested_in_event','EventController@add_interest')->name('interested_in_event');

Route::post('remove_interested_in_event','EventController@remove_interest')->name('remove_interested_in_event');

Route::get('home', 'HomeController@index')->name('home');

Route::post('update_password','MemberController@update_password')->name('update_password');

Route::get('get-khunp-list/{id}','MemberController@getKhunpList');

Route::get('editregion/{id}','RegionController@edit');

Route::get('editsamiti/{id}','SamitiController@edit');

Route::get('editvenue/{id}','VenueController@edit');

Route::get('editevent/{id}','EventController@edit');

Route::post('update_venue','VenueController@update')->name('update_venue');

Route::get('get-member-code/{member_type}','MemberController@getmembercode');


Route::get('get_regions_admin','RegionController@get_regions_admin')->name('get_regions_admin');
Route::get('get_family_region','familycontroller@get_family_region')->name('get_family_region');
Route::get('get_family_info_member/{id}','familycontroller@get_family_info_member')->name('get_family_info_member');
Route::get('approve_family_region_admin/{id}','familycontroller@approve_family_region_admin')->name('approve_family_region_admin');
Route::get('get_family_superadmin','familycontroller@get_family_superadmin')->name('get_family_superadmin');
Route::get('approve_family_super_admin/{id}','familycontroller@approve_family_super_admin')->name('approve_family_super_admin');

Route::get('approve_update_region_admin/{id}','userprofilecontroller@approve_update_region_admin')->name('approve_update_region_admin');

Route::get('approve_update_super_admin/{id}','userprofilecontroller@approve_update_super_admin')->name('approve_update_super_admin');

Route::get('approve_registration_super_admin/{id}','userprofilecontroller@approve_registration_super_admin')->name('approve_registration_super_admin');

Route::get('approve_registration_region_admin/{id}','userprofilecontroller@approve_registration_regional_admin')->name('approve_registration_region_admin');

Route::get('get_new_registration_regional','familycontroller@get_new_registration_regional')->name('get_new_registration_regional');

Route::get('get_new_registration_super_admin','familycontroller@get_new_registration_super_admin')->name('get_new_registration_super_admin');

Route::get('registration_profile_view/{id}','userprofilecontroller@registration_profile_view')->name('registration_profile_view');

Route::get('user_profile_view/{id}','userprofilecontroller@user_profile_view')->name('user_profile_view');

Route::resource('brochure','BrochureController');

Route::resource('gallery','GalleryController');

Route::get('delete_family_member/{id}','familycontroller@delete_family_member')->name('delete_family_member');

Route::get('About_Family','familycontroller@index')->name('About_Family');
Route::get('family_data/{id}','familycontroller@change');
Route::post('family_store','familycontroller@store');
Route::post('non_member_family_store','familycontroller@non_member_family_store');

Route::post('approve_member_regional_bulk','userprofilecontroller@approve_member_regional_bulk')->name('approve_member_regional_bulk');

Route::post('approve_member_superadmin_bulk','userprofilecontroller@approve_member_superadmin_bulk')->name('approve_member_superadmin_bulk');

Route::post('approve_registration_superadmin_bulk','userprofilecontroller@approve_registration_superadmin_bulk')->name('approve_registration_superadmin_bulk');

Route::post('approve_registration_regional_bulk','userprofilecontroller@approve_registration_regional_bulk')->name('approve_registration_regional_bulk');

});


// Website Routes

Route::post('postLogin','Auth\LoginController@postLogin')->name('postLogin');
Route::view('website','www.index')->name('website');
Route::view('about-us','www.about-us')->name('about-us');
//Route::view('events','www.events')->name('events');
Route::view('samitis','www.samitis')->name('samitis');
// Route::view('saraswani','www.saraswani')->name('saraswani');
Route::view('orbituary','www.orbituary')->name('orbituary');
Route::view('contact-us','www.contact-us')->name('contact-us');

Route::get('gallery-list','Website@gallery')->name('gallery-list');
Route::get('gallery-photos/{id}','Website@showGallery')->name('gallery-photos');
Route::get('saraswani','Website@showBrochures')->name('show_brochures');
Route::get('brochure_view/{id}','Website@viewBrochure')->name('brochure_pdf');
Route::get('send_otp','Website@sendOtp')->name('send_otp');

Route::get('events','Website@events')->name('events');
Route::get('event-details/{id}','Website@eventDetails')->name('event-details');
Route::get('orbituary-list','Website@get_obituary')->name('orbituary-list');

Route::get('member-registeration','Website@member_registeration')->name('member-registeration');

Route::post('member-register','Website@member_register')->name('member-register');

Route::get('get-member-code-website/{member_type}','Website@getmembercode');

Route::get('get-khunp-list-website/{id}','Website@getKhunpList');
