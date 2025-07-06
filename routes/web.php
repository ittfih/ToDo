<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TaskGroupController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);

Route::resource('/taskgroup', TaskGroupController::class);

Route::prefix('/task')->group(function () {
    Route::post('/', [TaskController::class, 'store'])->name('task.store');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::patch('/{task}/status', [TaskController::class, 'updateTaskStatus'])->name('task.status');
});

Route::prefix('/permission')->group(function () {
    Route::get('/{taskGroupId}', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/{taskGroupId}/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/{taskGroupId}', [PermissionController::class, 'store'])->name('permission.store');
    //Route::get('/{taskGroupId}/{permission}', [PermissionController::class, 'show'])->name('permission.show');
    Route::get('/{taskGroupId}/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::patch('/{taskGroupId}/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/{taskGroupId}/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');
});

//Route::resource('/task', TaskController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
