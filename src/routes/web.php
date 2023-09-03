<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them willz
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ログインした後のプロフィール画面の処理
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/quizzes', [QuizController::class, 'quiz'])->name('quizzes');
Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
// 編集
Route::get('/quizzes/{id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
// 更新
Route::patch('/quizzes/{id}', [QuizController::class, 'update'])->name('quizzes.update');
// 削除
Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');


Route::get('/users', [UserController::class, 'users']);




require __DIR__.'/auth.php';
