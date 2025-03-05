<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PayableController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\CollectedController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReimburseController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AllocationController;

// Public Routes
Route::get('/', function () { return view('index'); })->name('index');

// Authentication Routes
Route::get('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'register'])->name('auth.register');
Route::get('/auth/signin', [AuthController::class, 'showLoginForm'])->name('auth.signin');
Route::post('/auth/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/login', function () {
    return redirect()->route('signin');
})->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/forgot', function () { return view('auth.forgot'); });

// Dashboard Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'graph'])->name('dashboard');


// Payable Routes
Route::prefix('payable')->group(function () {
    Route::get('/audit', [PayableController::class, 'index'])->name('payable.audit');
    Route::post('/payable/store', [PayableController::class, 'store'])->name('payable.store');
    Route::post('/payable/{id}/approve', [PayableController::class, 'approve'])->name('payable.approve');
    Route::get('/audit', [PayableController::class, 'show'])->name('audit');
    Route::post('/{id}/reject', [PayableController::class, 'reject'])->name('payable.reject');
});

// Receivable Routes
Route::prefix('receivable')->group(function () {
    Route::post('/receivable/store', [ReceivableController::class, 'store'])->name('receivable.store');
    Route::get('/audit', [ReceivableController::class, 'show'])->name('audit');

});

// Finance Routes
Route::prefix('finance')->group(function () {
    Route::get('/receivables', [FinanceController::class, 'show'])->name('receivables');
    Route::post('/receivables/{id}/approve', [FinanceController::class, 'approve'])->name('receivables.approve');
    Route::post('/payable/{id}/reject', [PayableController::class, 'reject'])->name('payable.reject');

});

// Compliance Routes
Route::get('/compliance', [ComplianceController::class, 'show'])->name('compliance');

// Collected Routes
Route::get('/collected', [CollectedController::class, 'show'])->name('collected');

// Payment Routes
Route::get('/payment', [PaymentController::class, 'show'])->name('payment');

// Reimburse Routes
Route::prefix('reimburse')->group(function () {
    Route::post('/reimburse/store', [ReimburseController::class, 'store'])->name('reimburse.store');
    Route::get('/reimburse', [ReimburseController::class, 'show'])->name('reimburse');
    Route::patch('/reimburse/{id}/approve', [ReimburseController::class, 'approve'])->name('reimburse.approve');
    Route::patch('/reimburse/{id}/reject', [ReimburseController::class, 'reject'])->name('reimburse.reject');
});

// Tax Routes
Route::prefix('tax')->group(function () {
    Route::post('/tax', [TaxController::class, 'store'])->name('tax.store');
    Route::get('/tax', [TaxController::class, 'show'])->name('tax');
    Route::post('/tax/approve/{id}', [TaxController::class, 'approve'])->name('tax.approve');
    Route::post('/tax/reject/{id}', [TaxController::class, 'reject'])->name('tax.reject');
});

// Ledger Routes
Route::prefix('ledger')->group(function () {
    Route::get('/ledger', [LedgerController::class, 'show'])->name('ledger');
    Route::post('/ledger', [LedgerController::class, 'store'])->name('ledger.store');
});

// Transaction Logs
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
});

Route::get('/journal', [JournalController::class, 'index'])->name('journal');


//Budget Allocation

Route::get('/allocation',[AllocationController::class, 'show'])->name('allocation');
Route::post('/allocation', [AllocationController::class, 'store'])->name('allocation.store');
Route::get('/allocation', [AllocationController::class, 'index'])->name('allocation');


