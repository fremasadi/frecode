<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.pages.home');
})->name('home');

Route::get('/symlink', function () {
    try {
        $targetFolder = storage_path('app/public');
        $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage'; // Bypassing public_path() just in case
        
        if (!file_exists($linkFolder)) {
            symlink($targetFolder, $linkFolder);
            return 'Storage link berhasil dibuat manual by PHP!';
        }
        
        return 'Storage link sudah ada.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
