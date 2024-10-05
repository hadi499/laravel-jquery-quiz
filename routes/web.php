<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');
Route::post('/question/create', [QuestionController::class, 'store'])->name('question.store');

Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{id}/data', [QuizController::class, 'data'])->name('quiz.data');
Route::post('/quiz/{id}/save', [QuizController::class, 'save'])->name('quiz.save');
