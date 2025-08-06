<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MultimediaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Multimedia;

///sadsdss

Route::get('/', [MultimediaController::class, 'portfolio'])->name('portfolio');

// Test route to check storage
Route::get('/test-storage', function() {
    $storagePath = storage_path('app/public/multimedia');
    $publicPath = public_path('storage/multimedia');
    $exists = Storage::disk('public')->exists('multimedia');
    
    return response()->json([
        'storage_path' => $storagePath,
        'public_path' => $publicPath,
        'storage_exists' => $exists,
        'files_in_storage' => Storage::disk('public')->files('multimedia'),
        'directories' => Storage::disk('public')->directories(),
    ]);
});

// Test route to create sample multimedia entry
Route::get('/create-test-image', function() {
    // Create a sample multimedia entry for testing
    $multimedia = Multimedia::create([
        'title' => 'Test Image',
        'description' => 'This is a test image for display verification',
        'file_path' => '/storage/multimedia/test-image.jpg',
        'type' => 'image',
    ]);
    
    return response()->json([
        'message' => 'Test image created successfully',
        'multimedia' => $multimedia,
        'file_path' => $multimedia->file_path,
        'full_url' => url($multimedia->file_path)
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Multimedia management routes
    Route::resource('multimedia', MultimediaController::class)->except(['show']);
});

require __DIR__.'/auth.php';
