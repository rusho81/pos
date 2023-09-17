<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\TokenVarificationMiddleware;


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
Route::get('/summary',[DashboardController::class, 'Summary'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/userProfile',[UserController::class, 'ProfilePage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/ProductPage',[ProductController::class, 'ProductPage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/invoicePage',[InvoiceController::class, 'InvoicePage'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/salePage',[InvoiceController::class, 'SalePage'])->middleware([TokenVarificationMiddleware::class]);


Route::get('/categoryPage',[CategoryController::class, 'CategoryPage'])->middleware([TokenVarificationMiddleware::class]);


//Category API
Route::post('/create-category',[CategoryController::class, 'CategoryCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/delete-category',[CategoryController::class, 'CategoryDelete'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/list-category',[CategoryController::class, 'CategoryList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/update-category',[CategoryController::class, 'CategoryUpdate'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/category-by-id',[CategoryController::class, 'CategoryById'])->middleware([TokenVarificationMiddleware::class]);


//Product API
Route::post("/create-product",[ProductController::class,'CreateProduct'])->middleware([TokenVarificationMiddleware::class]);
Route::post("/delete-product",[ProductController::class,'DeleteProduct'])->middleware([TokenVarificationMiddleware::class]);
Route::post("/update-product",[ProductController::class,'UpdateProduct'])->middleware([TokenVarificationMiddleware::class]);
Route::get("/list-product",[ProductController::class,'ProductList'])->middleware([TokenVarificationMiddleware::class]);
Route::post("/product-by-id",[ProductController::class,'ProductByID'])->middleware([TokenVarificationMiddleware::class]);


//Customer API
Route::post('/create-customer',[CustomerController::class, 'CreateCustomer'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/list-customer',[CustomerController::class, 'CustomerList'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/customer-delete',[CustomerController::class, 'CustomerDelete'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/customer-udpate',[CustomerController::class, 'CustomerUpdate'])->middleware([TokenVarificationMiddleware::class]);

//Invoice 
Route::post('/invoice-create',[InvoiceController::class, 'InvoiceCreate'])->middleware([TokenVarificationMiddleware::class]);
Route::get('/invoice-select',[InvoiceController::class, 'InvoiceSelect'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/invoice-details',[InvoiceController::class, 'InvoiceDetails'])->middleware([TokenVarificationMiddleware::class]);
Route::post('/invoice-delete',[InvoiceController::class, 'InvoiceDelete'])->middleware([TokenVarificationMiddleware::class]);
