<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/', [LoginController::class, 'login'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/questions', [QuestionController::class, 'index'])->name('question.index');
Route::get('/questions/create', [QuestionController::class, 'create'])->name('question.create');
Route::post('/questions', [QuestionController::class, 'store'])->name('question.store');
Route::get('/questions/complete', [QuestionController::class, 'complete'])->name('question.complete');
Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
Route::get('/questions/{question}/delete', [QuestionController::class, 'delete'])->name('question.delete');
Route::get('/questions/search', [QuestionSearchController::class, 'showSearchForm'])->name('question.search');
Route::get('/questions/detail/{question}', [QuestionController::class, 'detail'])->name('question.detail');
