<?php

namespace Route\Framework;

use App\Framework\Helpers\Route;
use App\Framework\Controllers\HomeController;
use App\Framework\Controllers\ProductController;
use App\Framework\Controllers\LoginController;
use App\Framework\Controllers\UserController;
use App\Framework\Controllers\HttpErrorsController;

Route::get('/', [HomeController::class, 'index']);

Route::get('login',[LoginController::class,'form']);
Route::post('login',[LoginController::class,'login']);
Route::get('login/logout',[LoginController::class,'logout']);

Route::get('user/form',[UserController::class,'userForm']);
Route::post('user/create_user',[UserController::class,'createUser']);

Route::get('produtos/page/{pagination}',[ProductController::class,'list'])
    ->authRequired();
Route::get('produtos/add',[ProductController::class,'createForm']);
Route::post('produtos/add',[ProductController::class,'create']);
Route::get('produtos/edit/{id}',[ProductController::class,'editForm']);
Route::post('produtos/update',[ProductController::class,'edit']);
Route::delete('produtos/delete', [ProductController::class,'destroy']);
Route::get('produtos/curl', [ProductController::class,'getProdutosApi']);

Route::get('404',[HttpErrorsController::class,'index']);