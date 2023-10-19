<?php

use App\Http\Controllers\Invoice\InvoiceCancelController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Invoice\InvoiceFinalizeController;
use App\Http\Controllers\Invoice\InvoicePaidController;
use App\Http\Controllers\Invoice\InvoiceVoidController;
use Illuminate\Support\Facades\Route;

Route::resource('invoices', InvoiceController::class)
    ->only(['index', 'store', 'show', 'destroy']);

Route::put('invoices/{invoice}/finalize', InvoiceFinalizeController::class)->name('invoice.finalize');
Route::put('invoices/{invoice}/paid', InvoicePaidController::class)->name('invoice.paid');

Route::put('invoices/{invoice}/cancel', InvoiceCancelController::class)->name('invoice.cancel');
Route::put('invoices/{invoice}/void', InvoiceVoidController::class)->name('invoice.void');
