<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function (){
    //Auth Routes - user not logged
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});


Route::middleware([CheckIsLogged::class])->group(function (){
    //Auth Routes - user logged
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    // Edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/editNoteSubmit/{id}', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');

    // Delete note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteConfirm');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
