<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ParamController;
use App\Http\Controllers\Admin\ProductGroupController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('products', [ProductController::class, 'index'])->name('client.products.index');