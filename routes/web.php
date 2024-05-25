<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProxyController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();
Route::get('/', [TableController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['admin'])->group(function () {
    Route::get('/adminpanel', [AdminController::class, 'index'])->name('adminpanel');
    Route::post('/adminpanel/update/{id}', [AdminController::class, 'updateRole'])->name('adminpanel.rule');
    Route::post('/adminpanel/delete/{id}', [AdminController::class, 'deleteUser'])->name('adminpanel.user');
    Route::get('/adminpanel/createtable', [AdminController::class, 'addTablesView'])->name('adminpanel.addTables');
    Route::post('/adminpanel/createtable', [AdminController::class, 'addTables'])->name('adminpanel.addTables');
    Route::post('/update', [ExcelController::class, 'update'])->name('update');
    Route::get('/exceltable', [ExcelController::class, 'index'])->name('excel');
    Route::post('/update-cell', [ExcelController::class, 'updateCell'])->name('update.cell');
    Route::get('/table/{id}', [TableController::class, 'table'])->name('tables')->middleware('auth');
});
Route::middleware(['moder'])->group(function () {
    Route::post('/update', [ExcelController::class, 'update'])->name('update');
    Route::get('/exceltable', [ExcelController::class, 'index'])->name('excel');
    Route::post('/update-cell', [ExcelController::class, 'updateCell'])->name('update.cell');
    Route::get('/table/{id}', [TableController::class, 'table'])->name('tables')->middleware('auth');
});
Route::middleware(['redactor'])->group(function () {
    Route::post('/update', [ExcelController::class, 'update'])->name('update');
    Route::get('/exceltable', [ExcelController::class, 'index'])->name('excel');
    Route::post('/update-cell', [ExcelController::class, 'updateCell'])->name('update.cell');
    Route::get('/table/{id}', [TableController::class, 'table'])->name('tables')->middleware('auth');
});
