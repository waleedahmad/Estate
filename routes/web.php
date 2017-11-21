<?php

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@getIndex');
Route::get('/search', 'SearchController@getResults');

Route::get('/listings', 'ListingController@getListings');
Route::get('/listings/{type}', 'ListingController@getCategorizedListings');
Route::get('/listings/sub/{type}', 'ListingController@getSubTypListings');

Route::get('/agents', 'AgentController@viewAgents');
Route::get('/agent/{id}', 'AgentController@getAgent');

Route::get('/contact', 'ContactController@getContactForm');


Route::get('/property/images', 'PropertyController@getPropertyImages');
Route::get('/property/{id}', 'PropertyController@getProperty');

Route::group(['middleware'  =>  ['auth']], function(){

    Route::get('/property/{id}/edit', 'PropertyController@getEditProperty');

    Route::delete('/user/listing', 'PropertyController@removeListing');
    Route::post('/user/listing/update', 'PropertyController@updateListing');

    Route::get('/user/submit_property', 'PropertyController@propertyForm');
    Route::post('/user/submit_property', 'PropertyController@submitProperty');
    Route::post('/user/listing/validate', 'PropertyController@validateListing');
    Route::get('/city/towns', 'PropertyController@getCityTowns');
    Route::get('/town/blocks', 'PropertyController@getTownBlocks');

    Route::get('/block/info', 'PropertyController@getBlockInfo');

    Route::get('/user/settings', 'SettingsController@getSettings');
    Route::post('/settings/email', 'SettingsController@updateEmail');
    Route::post('/settings/profile', 'SettingsController@updateProfile');
    Route::post('/settings/password', 'SettingsController@updatePassword');
    Route::post('/settings/agent', 'SettingsController@updateAgentInfo');

    Route::get('/upload', 'StorageController@getUpload');
    Route::post('/upload', 'StorageController@upload');
    Route::delete('/upload','StorageController@deleteImage');
    Route::get('/image/{category}/{uri}', 'StorageController@getImage');

    Route::get('/user/dashboard/', 'UserController@getDashboard');

    Route::post('/user/message/new', 'ConversationController@newMessage');
    Route::get('/user/messages', 'ConversationController@getMessages');
    Route::get('/message/to/{user}', 'ConversationController@initConversation');
    Route::post('/user/conversation/init', 'ConversationController@createNewThread');
    Route::get('/user/conversation/{id}', 'ConversationController@getConversation');
    Route::delete('/user/conversation/', 'ConversationController@deleteConversation');





    Route::get('/user/properties', 'PropertyController@getProperties');
    Route::get('/user/properties/favorites', 'PropertyController@getFavoriteProperties');
    Route::post('/user/properties/toggle_favorite', 'PropertyController@toggleListingFavorites');
    Route::post('/user/properties/remove_favorite', 'PropertyController@removeListingFavorites');

    Route::get('/user/properties/pending', 'PropertyController@getPendingProperties');
});


Route::group(['middleware'  =>  ['auth', 'isAdmin']], function(){

    Route::get('/admin', 'AdminController@getIndex');

    // Listing routes

    Route::get('/admin/listings/submissions', 'ListingController@getListingSubmissions');
    Route::get('/admin/listings/approved', 'ListingController@getApprovedListings');
    Route::get('/admin/listings/slider_recent', 'ListingController@getSliderRecentListings');
    Route::post('/admin/listings/display', 'ListingController@modifyListingDisplaySettings');

    Route::get('/admin/listings/submissions/{type}', 'ListingController@getCategorizedAdminListings');
    Route::get('/admin/listings/approved/{type}', 'ListingController@getCategorizedApprovedListings');
    Route::get('/admin/listings/slider_recent/{type}', 'ListingController@getCategorizedSliderRecentListings');

    Route::post('/admin/listings/approve', 'ListingController@approveListing');
    Route::post('/admin/listings/delete', 'ListingController@deleteListing');
    Route::post('/admin/listings/disapprove', 'ListingController@disapproveListing');


    // User routes

    Route::get('/admin/users', 'UserController@getUsers');
    Route::post('/admin/user/modify_type', 'UserController@modifyUserType');


    // Tier Configuration routes

    Route::get('/admin/config/tiers', 'TierController@getTierConfig');
    Route::get('admin/config/tiers/add', 'TierController@getAddTier');
    Route::post('/admin/config/tiers', 'TierController@addTier');
    Route::delete('/admin/config/tiers', 'TierController@deleteTier');

    Route::get('admin/config/tiers/{id}/edit', 'TierController@getEditTiers');
    Route::post('admin/config/tiers/update', 'TierController@updateTier');


    Route::get('admin/users/tiers', 'TierController@getUserTiers');
    Route::post('admin/users/tiers', 'TierController@modifyUserTiers');



    // Site Configuration routes

    Route::get('/admin/config/layout', 'ConfigController@getLayoutConfig');
    Route::post('/admin/config/layout', 'ConfigController@updateLayoutConfig');

    Route::get('/admin/config/template', 'ConfigController@getTemplateConfig');
    Route::post('/admin/config/template', 'ConfigController@updateTemplateConfig');


    // Agent routes

    Route::get('/admin/agents', 'AgentController@getAgents');
    Route::post('/admin/agents/toggle_featured', 'AgentController@toggleFeatured');



    // Location routes

    Route::get('/admin/cities/add', 'LocationController@addCities');
    Route::post('/admin/cities', 'LocationController@saveCity');
    Route::delete('/admin/cities', 'LocationController@deleteCity');
    Route::get('/admin/cities/edit/{id}','LocationController@editCity');
    Route::post('/admin/cities/update', 'LocationController@updateCity');

    Route::get('/admin/cities', 'LocationController@getCities');
    Route::get('/admin/cities/{id}', 'LocationController@getCity');


    Route::get('/admin/city/{id}/town/add', 'LocationController@addTown');
    Route::post('/admin/cities/town', 'LocationController@saveTown');
    Route::delete('/admin/cities/town','LocationController@deleteTown');
    Route::post('/admin/cities/towns/update','LocationController@updateTown');

    Route::get('/admin/cities/town/{id}', 'LocationController@getTown');
    Route::get('/admin/cities/town/{id}/edit', 'LocationController@editTown');

    Route::get('/admin/cities/town/{id}/block/add', 'LocationController@addBlock');
    Route::post('/admin/cities/town/block', 'LocationController@saveBlock');
    Route::get('/admin/cities/town/block/{id}', 'LocationController@showBlock');

    Route::delete('/admin/cities/town/block', 'LocationController@deleteBlock');

    Route::get('/admin/cities/town/block/{id}/edit', 'LocationController@editBlock');
    Route::post('/admin/cities/town/block/update', 'LocationController@updateBlock');


});






