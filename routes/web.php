<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.pages.home');
})->name('home');

Route::get('/symlink', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Storage link berhasil dibuat!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
