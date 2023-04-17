<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
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

    Route::get('umkm/report/index', [ReportController::class, 'index'])->name('report.index');
    Route::get('report/labarugi', [ReportController::class, 'labarugi'])->name('report.labarugi');
    Route::get('report/neraca', [ReportController::class, 'neraca'])->name('report.neraca');
    Route::get('report/healthanalysis', [ReportController::class, 'healthanalysis'])->name('report.healthanalysis');


    Route::resource('umkm/kas', KasController::class);
    Route::get('kas/receive_money', [KasController::class, 'receive_money'])->name('kas.receive_money');
    Route::post('kas/receive_money', [KasController::class, 'store_receive_money'])->name('receive_money.store');
    Route::get('kas/transfer_fund', [KasController::class, 'transfer_fund'])->name('kas.transfer_fund');
    Route::get('kas/send_money', [KasController::class, 'send_money'])->name('kas.send_money');
    Route::post('kas/send_money', [KasController::class, 'store_send_money'])->name('send_money.store');

    Route::resource('umkm/cost', CostController::class);
    Route::resource('umkm/purchase', PurchaseController::class);
    Route::resource('umkm/sale', SaleController::class);

    Route::resource('umkm/asset', AssetController::class);
    Route::resource('umkm/coa', CoaController::class);
    Route::resource('umkm/contact', ContactController::class);
    Route::resource('umkm/product', ProductController::class);
});

require __DIR__ . '/auth.php';
