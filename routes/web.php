<?php

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

Route::get('/', "Home@index")->name('home');

Route::get('/loan', function () {
    return view('loan');
})->name('loan');

Route::post('/apply-job/{id}',  'ModalController@send_apply');
Route::get('/job/apply-modal/{id}', 'JobController@modal');
Route::get('/job/{slug}', 'JobController@index')->name('job.detail');
Route::get('/job', 'JobController@list');
Route::post('/loan-modal/mail/{id}',  'LoanProgramController@send_question');
Route::get('/loan-programs', 'LoanProgramController@index');
Route::get('/loan-modal/{id}', 'LoanProgramController@modal');
Route::get('/terms-of-use', 'TermsOfUseController@index');
Route::get('/privacy-policy', 'PrivacyPolicyController@index');
Route::get('/transactions', 'TransactionController@index');
Route::get('/the-firm', 'TheFirmController@index');
Route::get('/press', 'PressController@index');
Route::get('/contact-us', 'ContactUsController@index')->name('contact');
Route::post('/send-email', 'ContactUsController@send_email')->name('send_email');
Route::get('/send-email', 'ContactUsController@send_email')->name('send_email');
Route::get('/cron/daily-rates', 'Cron@index');

