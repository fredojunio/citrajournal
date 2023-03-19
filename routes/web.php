<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PageController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('user', UserController::class);
    Route::resource('umkm', UmkmController::class);
    Route::post('/umkm/save_umkm', [UmkmController::class, 'save_umkm'])->name('umkm.save_umkm');
});

Route::group([
    'middleware' => 'umkm',
    'prefix' => 'umkm',
    'as' => 'umkm.'
], function () {
    Route::get('/umkm/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::resource('coa', CoaController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('cost', CostController::class);
    Route::resource('kas', KasController::class);
    Route::resource('product', ProductController::class);
    Route::resource('purchase', PurchaseController::class);
    Route::resource('purchasedetail', PurchaseDetailController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('saledetail', SaleDetailController::class);
    Route::resource('stock', StockController::class);
});

require __DIR__ . '/auth.php';
