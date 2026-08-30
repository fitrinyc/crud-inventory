<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () { return redirect('/id/dashboard'); });

Route::prefix('{locale}')->middleware('locale')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
