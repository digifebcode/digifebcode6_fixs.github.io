<?php

use App\Http\Controllers\RawSqlCategoryController;
use App\Http\Controllers\QueryBuilderCategoryController;
use Illuminate\Support\Facades\Route;

// Group Route untuk CRUD menggunakan Teknik 1: Raw SQL
Route::prefix('raw-category')->name('raw-category.')->group(function () {
    Route::get('/', [RawSqlCategoryController::class, 'index'])->name('index');
    Route::post('/', [RawSqlCategoryController::class, 'store'])->name('store');
    Route::put('/{id}', [RawSqlCategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [RawSqlCategoryController::class, 'destroy'])->name('destroy');
});

// Group Route untuk CRUD menggunakan Teknik 2: Query Builder
Route::prefix('qb-category')->name('qb-category.')->group(function () {
    Route::get('/', [QueryBuilderCategoryController::class, 'index'])->name('index');
    Route::post('/', [QueryBuilderCategoryController::class, 'store'])->name('store');
    Route::put('/{id}', [QueryBuilderCategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [QueryBuilderCategoryController::class, 'destroy'])->name('destroy');
});