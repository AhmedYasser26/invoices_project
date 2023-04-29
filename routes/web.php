<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ReportController;
// use App\Http\Controllers\reportsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
    // return view('welcome');
});

// Auth::routes();

Route::get('/Home', function () {
    return view('Home');
})->middleware(['auth', 'verified'])->name('Home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/Home', [HomeController::class, 'index'])->name('Home');

Route::resource('invoices', InvoicesController::class);
Route::resource('sections' , SectionController::class);
Route::resource('products', ProductController::class);


Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
// Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
Route::get('/edit_invoice/{id}', [InvoicesController::class , 'edit']);
Route::get('/Status_show/{id}', [InvoicesController::class , 'show'])->name('showStatus');
Route::post('/Status_Update/{id}', [InvoicesController::class , 'Status_Update'])->name('updateStatus');
Route::get('invoicePrint/{id}', [InvoiceController::class, 'invoicePrint']);

// Route::get('reports', [reportsController::class]);

// Route::resource('testrep', repController::class);

Route::resource('report', ReportController::class);
// Route::post('invoices_search', [ReportController::class, 'Search']);

// Route::get('reports', [reportsController::class]);
// Route::get('reports', [reportsController::class, 'index']);
// Route::post('Search', [reportsController::class, 'invocesSearch']);

// Route::get('Home', [HomeController::class, 'index']);
// Route::resource()

Route::resource('/{page}', AdminController::class);




