<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MasterController;
use App\Http\Middleware\CheckUserExists;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return ('login');
// });

// Defult Rout Login page
Route::get('/', [AuthController::class, 'index']);

Route::get('home', [AuthController::class, 'dashboard'])->name('home');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('login_post', [AuthController::class, 'postLogin'])->name('login_post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(CheckUserExists::class)->namespace('\App\Http\Controllers')->group(function(){
// Master-Category
Route::get('category', [MasterController::class, 'category'])->name('category');
Route::post('category_post', [MasterController::class, 'categorypost'])->name('category_post');
Route::get('GetCategoryid', [MasterController::class, 'GetCategoryid'])->name('GetCategoryid');
Route::post('deleteCat', [MasterController::class, 'deleteCat'])->name('deleteCat');

//Master-Profession Level
Route::get('Profession-Level', [MasterController::class, 'Profession_Level'])->name('Profession-Level');

// Question Sets
Route::get('Question-Set', [MasterController::class, 'question_set'])->name('Question-Set');
Route::post('Question-Configurastion-Step2', [MasterController::class, 'question_configurastion_step2'])->name('Question-Configurastion-step2');
Route::post('Question_Post', [MasterController::class, 'question_post'])->name('Question_Post');


    });
