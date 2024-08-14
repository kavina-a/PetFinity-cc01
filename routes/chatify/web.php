<?php
use Illuminate\Support\Facades\Route;

/*
* This is the main app route [Chatify Messenger]
*/
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/chat', 'MessagesController@index')->name(config('chatify.routes.prefix'));

/**
 *  Fetch info for specific id [user/group]
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/idInfo', 'MessagesController@idFetchData');

/**
 * Send message route
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/sendMessage', 'MessagesController@send')->name('send.message');

/**
 * Fetch messages
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/fetchMessages', 'MessagesController@fetch')->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/download/{fileName}', 'MessagesController@download')->name(config('chatify.attachments.download_route_name'));

/**
 * Authentication for pusher private channels
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/chat/auth', 'MessagesController@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/makeSeen', 'MessagesController@seen')->name('messages.seen');

/**
 * Get contacts
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/getContacts', 'MessagesController@getContacts')->name('contacts.get');

/**
 * Update contact item data
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/updateContacts', 'MessagesController@updateContactItem')->name('contacts.update');

/**
 * Star in favorite list
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/star', 'MessagesController@favorite')->name('star');

/**
 * get favorites list
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/favorites', 'MessagesController@getFavorites')->name('favorites');

/**
 * Search in messenger
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/search', 'MessagesController@search')->name('search');

/**
 * Get shared photos
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/shared', 'MessagesController@sharedPhotos')->name('shared');

/**
 * Delete Conversation
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/deleteConversation', 'MessagesController@deleteConversation')->name('conversation.delete');

/**
 * Delete Message
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/deleteMessage', 'MessagesController@deleteMessage')->name('message.delete');

/**
 * Update setting
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/updateSettings', 'MessagesController@updateSettings')->name('avatar.update');

/**
 * Set active status
 */
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('activeStatus.set');

/*
* [Group] view by id
*/
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/group/{id}', 'MessagesController@index')->name('group');

/*
* user view by id.
*/
Route::middleware(['auth:petowner,trainingcenter,boardingcenter'])->get('/{id}', 'MessagesController@index')->name('user');
