<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'code' => 200,
        'message' => 'Project run successfully',
        'data' => null
    ]);
});
