<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVarificationMiddleware;
use Illuminate\Support\Facades\Route;


//API Route
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])
->middleware([TokenVarificationMiddleware::class]);

Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware([TokenVarificationMiddleware::class]);

//logout
Route::get('/logout',[UserController::class, 'UserLogout']);


//Page Route
Route::get('/userLogin',[UserController::class, 'LoginPage']);
Route::get('/userRegistration',[UserController::class, 'RegistrationPage']);
Route::get('/sendOtp',[UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class, 'VerifyOtpPage']);
Route::get('/resetPassword',[UserController::class, 'ResetPasswordPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class, 'DashboardPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/userProfile',[UserController::class, 'ProfilePage'])->middleware([TokenVarificationMiddleware::class]);

Route::get('/categoryPage',[CategoryController::class, 'CategoryPage'])->middleware([TokenVarificationMiddleware::class]);


//Category API
Route::post('/create-category',[CategoryController::class, 'CategoryCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/delete-category',[CategoryController::class, 'CategoryDelete'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/list-category',[CategoryController::class, 'CategoryList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/update-category',[CategoryController::class, 'CategoryUpdate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/category-by-id',[CategoryController::class, 'CategoryById'])->middleware([TokenVarificationMiddleware::class]);
