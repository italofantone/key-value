<?php

use Illuminate\Support\Facades\Route;

Route::get('v1/setting/{key}', function (string $key) {
    return response()->json([
        $key => setting($key),
    ]);
});