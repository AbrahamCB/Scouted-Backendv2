<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ReferarController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TimezoneController;

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

Route::group([
    'prefix' => 'user'

], function () use ($router) {

    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/verify', [MailController::class, 'verification']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::post('/profile', [UserController::class, 'profile']);

});


// Company

Route::group([
    'prefix' => '/'

], function () use ($router) {

    Route::get('/companies', [CompanyController::class, 'index']);
    Route::get('/company/slug/{slug}', [CompanyController::class, 'findBySlug']);
    Route::get('/company/{id}', [CompanyController::class, 'find']);
    Route::post('/company', [CompanyController::class, 'store']);
    Route::post('/company/u/{id}', [CompanyController::class, 'update']);
    Route::delete('/company/{id}', [CompanyController::class, 'delete']);

});


// Admin

Route::group([
    'prefix' => 'admin'

], function () use ($router) {

    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/apply', [AdminController::class, 'apply']);
    Route::post('/register', [AdminController::class, 'register']);
});


// Tag

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/tags', [TagController::class, 'index']);
        Route::post('/tag', [TagController::class, 'store']);
        Route::put('/tag/{id}', [TagController::class, 'update']);
        Route::delete('/tag/{id}', [TagController::class, 'destory']);
    }
);


// Job

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/jobs', [JobController::class, 'index']);
        Route::get('/jobs/search/{search}', [JobController::class, 'search']);
        Route::get('/job/find/{company_slug}/{job_slug}', 
            [JobController::class, 'findBySlugAndCompany']);
        Route::get('/jobs/company/{company_slug}', 
            [JobController::class, 'findByCompany']);
        Route::get('/jobs/tag/{job_tag}', 
            [JobController::class, 'findByTag']);
        Route::get('/jobs/country/{country_slug}', 
            [JobController::class, 'findByCountry']);
        Route::get('/jobs/state/{state}', 
            [JobController::class, 'findByState']);
        Route::get('/job/{id}', [JobController::class, 'find']);
        Route::post('/job', [JobController::class, 'store']);
        Route::post('/job/u/{id}', [JobController::class, 'update']);
        Route::delete('/job/{id}', [JobController::class, 'destory']);
    }
);

// Location

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/countries', [CountryController::class, 'index']);
        Route::post('/country', [CountryController::class, 'store']);
        Route::put('/country/{id}', [CountryController::class, 'update']);
        Route::get('/states/{id}', [StateController::class, 'index']);
        Route::post('/state', [StateController::class, 'store']);
        Route::put('/state/{id}', [StateController::class, 'update']);
        Route::get('/cities/{id}', [CityController::class, 'index']);
        Route::post('/city', [CityController::class, 'store']);
        Route::put('/city/{id}', [CityController::class, 'update']);
        Route::get('/timezones/{id}', [TimezoneController::class, 'index']);
        Route::post('/timezone', [TimezoneController::class, 'store']);
        Route::put('/timezone/{id}', [TimezoneController::class, 'update']);

    }
);

// Job Processing

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::post('/refer/{id}', [ReferarController::class, 'refer']);
        Route::get('/refer/jobs', [ReferarController::class, 'referJobs']);
        Route::get('/check', [ReferarController::class, 'check']);
        Route::put('/candidate/{id}', [CandidateController::class, 'update']);
        Route::delete('/candidate/{id}', [CandidateController::class, 'destory']);
    }
);


// Contact

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/contacts', [ContactController::class, 'index']);
        Route::post('/contact', [ContactController::class, 'store']);
        Route::post('/contact/{id}', [ContactController::class, 'destory']);
    }
);


// Setup

Route::group(
    [
        'prefix' => '/'
    ],
    function ($router) {
        Route::get('/run/country', [SetupController::class, 'country']);
        Route::get('/run/state', [SetupController::class, 'state']);
        // Route::get('/run/country', [SetupController::class, 'country']);

    }
);

