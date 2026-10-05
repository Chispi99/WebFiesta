<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{codigo}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/admin/login', function () {
    if (session('admin_logged_in')) {
        return redirect()->route('admin.index');
    }
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {
    if ($request->input('password') === env('ADMIN_PASSWORD', 'fiesta123')) {
        $request->session()->put('admin_logged_in', true);
        return redirect()->route('admin.index');
    }
    return back()->withErrors(['password' => 'Contraseña incorrecta']);
})->name('admin.login.submit');

Route::middleware([\App\Http\Middleware\AdminAuth::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/logout', function (\Illuminate\Http\Request $request) {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    })->name('admin.logout');
    Route::post('/{id}/pay', [AdminController::class, 'markAsPaid'])->name('admin.pay');
    Route::delete('/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
    Route::get('/download', [AdminController::class, 'downloadCsv'])->name('admin.download');
});
