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

});
