<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/home', function () {
    return view('home');
});





Route::get('/dashboard', 'DashboardController@index');




//admin

Route::group(['prefix' => 'auth','middleware'=>'admin'], function () {

    Route::get('/', function () {
        return view('backend.admin.index');
    });

    Route::resource('/category', 'CategoryController');
    Route::resource('/subcategory', 'SubcategoryController');
    Route::resource('/childcategory', 'ChildcategoryController');

    //adminlisting
    Route::get('/allads','AdminListingController@index')->name('all.ads');

    //listing reported ad
    Route::get('/reported-ads','FraduController@index')->name('all.reported.ads');

});
Route::get('/', 'FrontAdsController@index');


//ads
Route::get('/ads/create', 'AdvertisementController@create')->name('ads.create')->middleware('auth');;
Route::post('/ads/store', 'AdvertisementController@store')->middleware('auth')->name('ads.store');
Route::get('/ads', 'AdvertisementController@index')->name('ads.index')->middleware('auth');
Route::get('/ads/{id}/edit', 'AdvertisementController@edit')->name('ads.edit')->middleware('auth');
Route::put('/ads/{id}/update', 'AdvertisementController@update')->name('ads.update')->middleware('auth');
Route::delete('/ads/{id}/delete', 'AdvertisementController@destroy')->name('ads.destroy')->middleware('auth');

Route::get('/ad-pending','AdvertisementController@pendingAds')->name('pending.ad');

//profile
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');
Route::post('/profile', 'ProfileController@updateProfile')->name('update.profile')->middleware('auth');


//user ads
Route::get('/ads/{userId}/view','FrontendController@viewUserAds')->name('show.user.ads');
//frontend

Route::get(
    '/product/{categorySlug}',
    'FrontendController@findBasedOnCategory'
)
    ->name('category.show');

Route::get('/product/{categorySlug}/{subcategorySlug}', 'FrontendController@findBasedOnSubcategory')
    ->name('subcategory.show');


Route::get(
    '/product/{categorySlug}/{subcategorySlug}/{childCategorySlug}',
    'FrontendController@findBasedOnChildcategory'
)
    ->name('childcategory.show');
Route::get('/products/{id}/{slug}', 'FrontendController@show')
    ->name('product.view');

//Message
Route::post('/send/message','SendMessageController@store')->middleware('auth');
Route::get('messages','SendMessageController@index')->name('messages')->middleware('auth');
Route::get('/users','SendMessageController@chatWithThisUser');
Route::get('/message/user/{id}','SendMessageController@showMessages');
Route::post('/start-conversation','SendMessageController@startConversation');


//login with facebook
Route::get('auth/facebook', 'SocialLoginController@facebookRedirect');

Route::get('auth/facebook/callback', 'SocialLoginController@loginWithFacebook');


//Save ad
Route::post('/ad/save','SaveAdController@saveAd');
Route::post('/ad/remove','SaveAdController@removeAd')->name('ad.remove');
Route::get('/saved-ads','SaveAdController@getMyads')->name('saved.ad');

//report this ad
Route::post('/report-this-ad','FraduController@store')->name('report.ad');


