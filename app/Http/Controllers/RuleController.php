<?php

namespace App\Http\Controllers;

class RuleController extends Controller
{
    public function index()
    {
        $path = public_path('RuleBook/RuleBook.pdf');
        if (!file_exists($path)) {
            abort(404, 'Rule book not found');
        }
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
