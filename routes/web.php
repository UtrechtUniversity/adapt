<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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

Route::get('/', [FormController::class, 'index'])->name('index');

Route::get('/form1', [FormController::class, 'form1'])->name('form1');
Route::get('/form2', [FormController::class, 'form2'])->name('form2');
Route::get('/form3', [FormController::class, 'form3'])->name('form3');

Route::post('/', [FormController::class, 'processForm'])->name('process-form');
Route::post('/form3', [FormController::class, 'processKeywordsFormExcel'])->name('process-keywords-form-excel');