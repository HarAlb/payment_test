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
use App\Services\Payment\PaymentController;

/** @var $router Illuminate\Routing\Router */
$router->any('/confirm_url', [\App\Services\Payment\PaymentController::class, 'confirm']);
