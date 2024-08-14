<?php

use Illuminate\Support\Facades\Route;

/**
 * Authentication for pusher private channels
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/chat/auth', 'MessagesController@pusherAuth')->name('api.pusher.auth');

/**
 *  Fetch info for specific id [user/group]
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/idInfo', 'MessagesController@idFetchData')->name('api.idInfo');

/**
 * Send message route
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/sendMessage', 'MessagesController@send')->name('api.send.message');

/**
 * Fetch messages
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/fetchMessages', 'MessagesController@fetch')->name('api.fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/download/{fileName}', 'MessagesController@download')->name('api.'.config('chatify.attachments.download_route_name'));

/**
 * Make messages as seen
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/makeSeen', 'MessagesController@seen')->name('api.messages.seen');

/**
 * Get contacts
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/getContacts', 'MessagesController@getContacts')->name('api.contacts.get');

/**
 * Star in favorite list
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/star', 'MessagesController@favorite')->name('api.star');

/**
 * get favorites list
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/favorites', 'MessagesController@getFavorites')->name('api.favorites');

/**
 * Search in messenger
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/search', 'MessagesController@search')->name('api.search');

/**
 * Get shared photos
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/shared', 'MessagesController@sharedPhotos')->name('api.shared');

/**
 * Delete Conversation
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/deleteConversation', 'MessagesController@deleteConversation')->name('api.conversation.delete');

/**
 * Update settings
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/updateSettings', 'MessagesController@updateSettings')->name('api.avatar.update');

/**
 * Set active status
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('api.activeStatus.set');
