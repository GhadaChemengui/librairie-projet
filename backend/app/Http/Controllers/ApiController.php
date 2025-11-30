<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function health(): JsonResponse
    {
        return response()->json([
            'status' => 'OK',
            'message' => 'Backend API is running',
            'timestamp' => now()
        ]);
    }
    
    public function books(): JsonResponse
    {
        return response()->json([
            'message' => 'Books endpoint - ready for implementation'
        ]);
    }
}