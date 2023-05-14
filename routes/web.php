<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\Customers_ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\Invoices_ReportController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('index', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('invoices',InvoicesController::class);

Route::resource('sections',SectionsController::class);


Route::resource('products',ProductsController::class);

Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);
Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);

Route::get('/section/{id}',[InvoicesController::class,'getproducts']);

Route::get('/InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
Route::get('View_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'open_file'])->name('open_file');
Route::get('download/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'get_file'])->name('get_file');

Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('/Status_show/{id}',[InvoicesController::class,'show'])->name('Status_show');

Route::post('/Status_Update/{id}',[InvoicesController::class,'Status_Update'])->name('Status_Update');


Route::get('/edit_invoice/{id}',[InvoicesController::class,'edit']);
Route::get('/Invoice_Paid',[InvoicesController::class,'Invoice_Paid'])->name('Invoice_Paid');
Route::get('/Invoice_UnPaid',[InvoicesController::class,'Invoice_unPaid'])->name('Invoice_unPaid');
Route::get('/Invoice_Partial',[InvoicesController::class,'Invoice_Partial'])->name('Invoice_Partial');
Route::get('/Print_invoice/{id}',[InvoicesController::class,'Print_invoice'])->name('Print_invoice');
Route::get('export_invoices', [InvoicesController::class, 'export']);

Route::resource('Archive',InvoiceAchiveController::class);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
});
Route::get('/invoices_report',[Invoices_ReportController::class,'index']);
Route::post('/Search_invoices',[Invoices_ReportController::class,'Search_invoices']);
Route::get('/customers_report',[Customers_ReportController::class,'index']);
Route::post('/Search_customers',[Customers_ReportController::class,'Search_customers']);
Route::get('chart', [ChartJSController::class, 'index']);

Route::get('MarkAsRead_all', [InvoicesController::class])->name('MarkAsRead_all');


Route::get('/{page}',[AdminController::class,'index']);

