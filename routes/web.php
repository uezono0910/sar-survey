<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyAnswerController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyItemController;
use App\Models\SurveyAnswer;
use App\Models\Survey;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function() {
    Route::resource('survey', SurveyController::class);
    Route::resource('surveyitem', SurveyItemController::class);
    Route::get('surveyanswer/{surveyAnswer}/show', [SurveyAnswerController::class, 'show'])->name('surveyanswer.show');
    Route::get('surveyanswer/{surveyAnswer}/edit', [SurveyAnswerController::class, 'edit'])->name('surveyanswer.edit');
    Route::patch('surveyanswer/{surveyAnswer}/update', [SurveyAnswerController::class, 'update'])->name('surveyanswer.update');
    Route::delete('surveyanswer/{surveyAnswer}', [SurveyAnswerController::class, 'destroy'])->name('surveyanswer.destroy');
    // ログインユーザーのみアンケート一覧画面を表示
    Route::get('surveyanswer', [SurveyAnswerController::class, 'index'])->name('surveyanswer.index');
});

Route::get('survey/{survey}/answer', [SurveyAnswerController::class, 'create'])->name('surveyanswer.create');
Route::post('survey/{survey}/answer', [SurveyAnswerController::class, 'store'])->name('surveyanswer.store');

require __DIR__.'/auth.php';