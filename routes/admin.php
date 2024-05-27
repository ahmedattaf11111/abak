<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
//Admin
Route::prefix("admin-auth")->group(function () {
    Route::post("login", "AuthController@login");
    Route::get("veriy-token", "AuthController@verifyToken");
    Route::get("logout", "AuthController@logout");
});

Route::prefix("items")->group(function () {
    Route::post("", "ItemController@store");
    Route::post("update", "ItemController@update");
    Route::delete("{id}", "ItemController@delete");
    Route::get("", "ItemController@index");
});

Route::prefix("categories")->group(function () {
    Route::post("", "CategoryController@store");
    Route::post("update", "CategoryController@update");
    Route::delete("{id}", "CategoryController@delete");
    Route::get("", "CategoryController@index");
    Route::get("services", "CategoryController@getServices");
    Route::get("{id}", "CategoryController@find");
});

Route::prefix("portfolios")->group(function () {
    Route::post("", "ProfileController@store");
    Route::post("update", "ProfileController@update");
    Route::delete("{id}", "ProfileController@delete");
    Route::get("", "ProfileController@index");
    Route::get("categories", "ProfileController@getCategories");
    Route::get("{id}", "ProfileController@find");
});

Route::prefix("services")->group(function () {
    Route::post("", "ServiceController@store");
    Route::post("update", "ServiceController@update");
    Route::delete("{id}", "ServiceController@delete");
    Route::get("", "ServiceController@index");
    Route::get("{id}", "ServiceController@find");
});

Route::prefix("galleries")->group(function () {
    Route::post("", "GalleryController@store");
    Route::post("update", "GalleryController@update");
    Route::delete("{id}", "GalleryController@delete");
    Route::get("", "GalleryController@index");
    Route::get("{id}", "GalleryController@find");
});

Route::prefix("contact-experts")->group(function () {
    Route::delete("{id}", "ContactExpertController@delete");
    Route::get("", "ContactExpertController@index");
});

Route::prefix("price-services")->group(function () {
    Route::delete("{id}", "PriceServiceController@delete");
    Route::get("", "PriceServiceController@index");
});
Route::prefix("contacts")->group(function () {
    Route::delete("{id}", "ContactController@delete");
    Route::get("", "ContactController@index");
});

Route::prefix("reqruitments")->group(function () {
    Route::delete("{id}", "ReqruitmentController@delete");
    Route::get("", "ReqruitmentController@index");
});

Route::prefix("orders")->group(function () {
    Route::delete("{id}", "OrderController@delete");
    Route::get("", "OrderController@index");
    Route::post("update", "OrderController@update");
    Route::get("{id}", "OrderController@find");
});

Route::prefix("faqs")->group(function () {
    Route::delete("{id}", "FaqController@delete");
    Route::get("", "FaqController@index");
    Route::post("", "FaqController@store");
    Route::post("update", "FaqController@update");
    Route::get("{id}", "FaqController@find");
});


Route::prefix("many-image")->group(function () {
    Route::post("", "ManyImageController@store");
    Route::post("update", "ManyImageController@update");
    Route::post("add-image", "ManyImageController@addImage");
    Route::delete("delete-image", "ManyImageController@deleteImage");
    Route::delete("{id}", "ManyImageController@delete");
    Route::get("", "ManyImageController@index");
});

Route::prefix("settings")->group(function () {
    Route::get("", "SettingController@find");
    Route::post("", "SettingController@save");
});
Route::post("send-email", "EmailController@sendEmail");
Route::get("statistics", "StatisticController@getStatistics");
