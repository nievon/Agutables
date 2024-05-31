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
    Route::post('/update', [ExcelController::class, 'update'])->name('update');
    Route::get('/exceltable', [ExcelController::class, 'index'])->name('excel');
    Route::post('/update-cell', [ExcelController::class, 'updateCell'])->name('update.cell');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/books', [ExcelController::class, 'index'])->name('books.index');
    Route::get('/books/{book}/download', [ExcelController::class, 'download'])->name('books.download');
    Route::get('/books/create', [ExcelController::class, 'create'])->name('books.create');
    Route::post('/books', [ExcelController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [ExcelController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [ExcelController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [ExcelController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [ExcelController::class, 'destroy'])->name('books.destroy');
    Route::get('/search/users', [ExcelController::class, 'searchUsers'])->name('search.users');
    Route::get('/books/{book}/share', [ExcelController::class, 'share'])->name('books.share');
    Route::post('/books/{book}/share', [ExcelController::class, 'addUser'])->name('books.addUser');
    Route::delete('/books/{book}/share/{user}', [ExcelController::class, 'removeUser'])->name('books.removeUser');
    Route::resource('books', ExcelController::class);
    Route::get('/shared-books', [ExcelController::class, 'sharedWithMe'])->name('books.sharedWithMe');
    Route::post('/books/{book}/update-cell', [ExcelController::class, 'updateCell'])->name('books.updateCell');
});
