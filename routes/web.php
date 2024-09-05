<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin-page',[TaskController::class,'index'])->name('admin-page');
Route::get('user-page',[userController::class, 'user']);
Route::get('create',[TaskController::class , 'create']);
Route::post('/task/add',[TaskController::class , 'store'])->name('AddTasks');
Route::get('/EditTask/{id}/',[TaskController::class ,'editTask'])->name('EditTask');
Route::put('/postTasks',[TaskController::class ,'update'])->name('UpdateTask');
Route::delete('/delete/{id}',[TaskController::class ,'DeleteTask'])->name('DeleteTask');
Route::get('search',[TaskController::class, 'search'])->name('search');

require __DIR__.'/auth.php';
