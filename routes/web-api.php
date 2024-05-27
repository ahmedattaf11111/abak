<?php

use App\Mail\Email;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

Route::prefix("auth")->group(function () {
    Route::post("register", "AuthController@register");
    Route::post("login", "AuthController@login");
    Route::get("verify-token", "AuthController@verifyToken");
    Route::post("verify-email", "AuthController@verifyEmail");
    Route::get("resend-verification-code", "AuthController@resendVerificationCode");
    Route::get("user-verified", "AuthController@userVerified");
    Route::get('forget-password/{user:email}', "AuthController@forgetPassword");
    Route::post('reset-password', "AuthController@resetPassword");
    Route::get("logout", "AuthController@logout");
    Route::get('current-user', "AuthController@getCurrentUser");
    Route::post('update-profile', "AuthController@updateProfile");
});


Route::prefix("chat")->group(function () {
    Route::get("rooms", "ChatController@getRooms");
    Route::get("messages/{roomId}", "ChatController@getMessages");
    Route::post("", "ChatController@newMesage");
});


Route::prefix("contact-experts")->group(function () {
    Route::post("", "ContactExpertController@store");
});
Route::prefix("price-services")->group(function () {
    Route::post("", "PriceServiceController@store");
});

Route::prefix("contacts")->group(function () {
    Route::post("", "ContactController@store");
});


Route::prefix("web-settings")->group(function () {
    Route::get("", "SettingController@find");
});

Route::prefix("web-faqs")->group(function () {
    Route::get("", "FaqController@index");
});

Route::prefix("wep-portfolios")->group(function () {
    Route::get("categories", "ProfileController@getCategories");
    Route::get("", "ProfileController@getProfiles");
    Route::get("{id}", "ProfileController@find");
});

Route::prefix("reqruitments")->group(function () {
    Route::post("", "ReqruitmentController@store");
});

Route::prefix("user-profiles")->group(function () {
    Route::get("statistics", "UserProfileController@getStatistics");
    Route::get("orders", "UserProfileController@getOrders");
    Route::get("orders/{id}", "UserProfileController@getOrder");
});


Route::prefix("web-categories")->group(function () {
    Route::get("", "CategoryController@getCategories");
});


Route::prefix("web-galleries")->group(function () {
    Route::get("", "GalleryController@getGalleries");
});

Route::prefix("orders")->group(function () {
    Route::post("", "OrderController@store");
    Route::get("services/{categoryId}", "OrderController@getServices");
    Route::get("download-report/{fileName}","OrderController@downloadReport");
});

