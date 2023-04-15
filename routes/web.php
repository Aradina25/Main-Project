<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdBookController;
use App\Http\Controllers\MemBookController;
use App\Http\Controllers\PostController;
// use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\friendController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Dompdf\Dompdf;
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



Route::get('/', function () {
    return view('index');
});

//Login and logout
Route::view('/login','login');
Route::view('/reg','registration');
Route::post('/reguser',[Registration::class,'register']);
Route::post('/loguser',[LoginController::class,'login']);
Route::view('/forgotpass','forgotPassword');
Route::get('/forget-password', [ForgotPasswordController::class,'getEmail']);
Route::match(array('GET','POST'),'/forget-password', [ForgotPasswordController::class,'postEmail']);
Route::match(array('GET','POST'),'/reset-pass/{token}', [ResetPasswordController::class,'getPassword'])->name('reset-pass');
Route::post('/reset-password', [ResetPasswordController::class,'updatePassword']);
Route::get('/logout',[LoginController::class,'logout']);

//ADMIN ROUTES
Route::get('/adminDashboard',[LoginController::class,'adminDashboard'])->middleware('isLoggedIn');
Route::get('/adbook',[AdBookController::class,'adbook'])->middleware('isLoggedIn');
Route::post('/addbook',[AdBookController::class,'addbook'])->middleware('isLoggedIn');
Route::post('/addstock',[AdBookController::class,'addstock'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/searchbook',[AdBookController::class,'searchbook'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/viewbook/{id}',[AdBookController::class,'viewbook'])->name('viewbook')->middleware('isLoggedIn');
Route::post('/editbook/{id}',[AdBookController::class,'editbook'])->name('editbook')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/admembers',[AdBookController::class,'memberscon'])->name('admembers')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/admempro/{id}',[AdBookController::class,'memberspro'])->name('admempro')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/blck/{id}/{role}',[AdBookController::class,'block'])->name('blck')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/adorders',[AdBookController::class,'memorders'])->name('adorders')->middleware('isLoggedIn');

//MEMBER ROUTES
Route::view('/postmodule','mempostupload');
Route::get('/memhome',[LoginController::class,'memhome'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/profile',[MemBookController::class,'profileview'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/ownprofile',[MemBookController::class,'ownprofileview'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/memsearch',[MemBookController::class,'memsearch'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/challenge',[MemBookController::class,'challenge'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/listchallenge',[MemBookController::class,'listChallenge'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/markbook/{accId}/{stat?}',[MemBookController::class,'markbook'])->name('markbook')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/memviewbook/{id}',[MemBookController::class,'memviewbook'])->name('memviewbook')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/review/{bookid}',[MemBookController::class,'review'])->name('review')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/quizfin/{accId}',[MemBookController::class,'quizfin'])->name('quizfin')->middleware('isLoggedIn');
//cart
Route::match(array('GET','POST'),'/cart',[MemBookController::class,'viewcart'])->name('cart')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/buybook/{accId}/{stat?}',[MemBookController::class,'buybook'])->name('buybook')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/deletebook/{cartid}',[MemBookController::class,'deletebook'])->name('deletebook')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/updatecart/{cartid}',[MemBookController::class,'updatecart'])->name('updatecart')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/address_save',[MemBookController::class,'shippingaddress'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/address/{amt}',[MemBookController::class,'address'])->name('address')->middleware('isLoggedIn');
// Route::view('/paymentprocess','paymentcard');
Route::match(array('GET','POST'),'/paymentpost',[MemBookController::class,'paymentprocess'])->name('paymentpost')->middleware('isLoggedIn');
// Route::match(array('GET','POST'),'/orderconfirm',[MemBookController::class,'orderconfirmation'])->middleware('isLoggedIn');
// Route::match(array('GET','POST'),'/payment',[PaymentController::class,'pay'])->name('payment');

// Route::controller(PaypalController::class)->group(function(){
//     Route::post('/request-payment', 'RequestPayment')->name('requestpayment');
//     Route::get('/payment-success', 'PaymentSuccess')->name('paymentsuccess');
//     Route::get('/payment-cancel', 'PaymentCancel')->name('paymentCancel');
// });
Route::match(array('GET','POST'),'/request-payment/{amount}',[PaypalController::class,'RequestPayment'])->name('requestpayment');
Route::match(array('GET','POST'),'/payment-success',[PaypalController::class,'PaymentSuccess'])->name('paymentsuccess');
Route::match(array('GET','POST'),'/payment-cancel',[PaypalController::class,'PaymentCancel'])->name('paymentCancel');
Route::get('/generatePDF',[MemBookController::class,'generatePDF'])->middleware('isLoggedIn');


//post management
Route::match(array('GET','POST'),'/scan',[PostController::class,'scanner']);
Route::match(array('GET','POST'),'/postUpload',[PostController::class,'postUpload'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/editposts',[PostController::class,'editposts'])->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/deletepost/{postid}',[PostController::class,'deletepost'])->name('deletepost')->middleware('isLoggedIn');


//friend connection
Route::match(array('GET','POST'),'/follow/{friendid}',[friendController::class,'follow'])->name('follow')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/friendprofile/{friendid}',[friendController::class,'friendprofileview'])->name('friendprofile')->middleware('isLoggedIn');

//Thirft
Route::match(array('GET','POST'),'/addtostore',[MemBookController::class,'addtostore'])->name('addtostore')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/viewthrift/{accId}/{userid}',[MemBookController::class,'thrift'])->name('viewthrift')->middleware('isLoggedIn');
// Route::match(array('GET','POST'),'/buythrift/{sellerid}/{storeid}',[MemBookController::class,'buythrift'])->name('buythrift')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/negothrift/{sellerid}/{storeid}',[MemBookController::class,'negothrift'])->name('negothrift')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/currsale',[MemBookController::class,'currsale'])->name('currsale')->middleware('isLoggedIn');
Route::match(array('GET','POST'),'/thriftreq/{id}/{stat}',[MemBookController::class,'thriftaction'])->name('thriftreq')->middleware('isLoggedIn');

//bot
use App\Http\Controllers\BotManController;
 Route::match(['get', 'post'], 'botman', [BotManController::class, 'handle']);

