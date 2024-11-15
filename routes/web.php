<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

/**
 * Landing
 */
Route::get('/', function () {
    return view('pages.welcome');
})->name('home');

/**
 * Orders
 */
Route::get('/orders', [OrderController::class, 'index'])->name('order.list');
Route::post('/orders/new', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.view');
Route::delete('/orders/{order}/delete', [OrderController::class, 'destroy'])->name('order.delete');

/**
 * Addresses
 */
Route::post('/addresses/new', [AddressController::class, 'store'])->name('address.store');
Route::get('/addresses/{address}', [AddressController::class, 'show'])->name('address.view');
Route::delete('/addresses/{address}/delete', [AddressController::class, 'destroy'])->name('address.delete');

/**
 * Shipments
 */
Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipment.list');
Route::get('/shipments/new', [ShipmentController::class, 'create'])->name('shipment.create');
Route::get('/shipments/methods', [ShipmentController::class, 'getMethods'])->name('shipment.methods');
Route::post('/shipments/store', [ShipmentController::class, 'store'])->name('shipment.store');
Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipment.view');
Route::get('/shipments/{shipment}/packing-slip', [ShipmentController::class, 'showPackingSlip'])->name('shipment.show.packing-slip');
Route::get('/shipments/{shipment}/packing-slip/download', [ShipmentController::class, 'downloadPackingSlip'])->name('shipment.download.packing-slip');
Route::delete('/shipments/{shipment}/delete', [OrderController::class, 'destroy'])->name('order.delete');
