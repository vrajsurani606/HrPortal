<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AttendanceController;
use App\Models\Company;
use Illuminate\Http\Request;

// Public API routes
Route::get('check-company-email', function (Request $request) {
    $email = $request->query('email');
    
    if (!$email) {
        return response()->json(['exists' => false]);
    }
    
    $exists = Company::where('company_email', $email)->exists();
    
    return response()->json(['exists' => $exists]);
});

Route::middleware('auth:sanctum')->group(function () {
    // Attendance routes
    Route::prefix('attendance')->group(function () {
        Route::get('status', [AttendanceController::class, 'checkStatus']);
        Route::post('check-in', [AttendanceController::class, 'checkIn']);
        Route::post('check-out', [AttendanceController::class, 'checkOut']);
        Route::get('history', [AttendanceController::class, 'history']);
    });
});
