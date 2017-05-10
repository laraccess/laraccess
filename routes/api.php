<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User
Route::get('user', 'UserController@index');
if (config('auth.registration.active', true)) {
Route::post('user', 'UserController@create');
}
Route::put('user', 'UserController@update');
Route::delete('user', 'UserController@delete');
Route::get('user/campaigns', 'UserController@campaign');

// Campaign
Route::get('campaign/{campaign}', 'CampaignController@index');
Route::post('campaign', 'CampaignController@create');
Route::put('campaign/{campaign}', 'CampaignController@update');
Route::delete('campaign/{campaign}', 'CampaignController@delete');
Route::get('campaign/{campaign}/leads', 'CampaignController@leads');

// Leads
Route::get('lead/{lead}', 'LeadController@index');
Route::post('campaign/{campaign}/leads', 'LeadController@create');
Route::put('lead/{lead}', 'LeadController@update');
Route::delete('lead/{lead}', 'LeadController@delete');
Route::post('lead/{lead}/invite', 'LeadController@invite')
