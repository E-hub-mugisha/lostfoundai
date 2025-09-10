<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostDocumentController;
use App\Http\Controllers\FoundDocumentController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\OCRController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VisionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/lost-documents', [LostDocumentController::class, 'index'])->name('lost-documents.index');
    Route::post('/lost-documents', [LostDocumentController::class, 'store'])->name('lost-documents.store');
    Route::get('/lost-documents/{lost_document}/edit', [LostDocumentController::class, 'edit'])->name('lost-documents.edit'); // Optional if using modal
    Route::put('/lost-documents/{lost_document}', [LostDocumentController::class, 'update'])->name('lost-documents.update');
    Route::delete('/lost-documents/{lost_document}', [LostDocumentController::class, 'destroy'])->name('lost-documents.destroy');

    // Found IDs
    Route::get('/found-documents', [FoundDocumentController::class, 'index'])->name('found_documents.index');
    Route::post('/found-documents', [FoundDocumentController::class, 'store'])->name('found_documents.store');
    Route::get('/found-documents/{id}', [FoundDocumentController::class, 'show'])->name('found_documents.show');
    Route::put('/found-documents/{id}', [FoundDocumentController::class, 'update'])->name('found_documents.update');
    Route::delete('/found-documents/{id}', [FoundDocumentController::class, 'destroy'])->name('found_documents.destroy');

    Route::get('/ocr', [OCRController::class, 'index'])->name('image.index');
    Route::post('/ocr/upload', [OCRController::class, 'store'])->name('image.store');
    Route::get('/ocr/preview/{id}', [OCRController::class, 'preview'])->name('image.preview');

    Route::get('/ocr/extract/tesseract/{id}', [OCRController::class, 'extractWithTesseract'])->name('ocr.tesseract');
    Route::get('/ocr/extract/vision/{id}', [OCRController::class, 'extractWithVision'])->name('ocr.vision');
    Route::get('/ocr/extract/vision-document/{id}', [OCRController::class, 'extractWithVisionDocument'])->name('ocr.vision.document');

    Route::get('match/auto', [MatchController::class, 'autoMatch'])->name('match.auto');

    Route::get('/users', [UserProfileController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserProfileController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserProfileController::class, 'store'])->name('admin.users.store');
    Route::put('/user/update/{id}', [UserProfileController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserProfileController::class, 'destroy'])->name('admin.users.destroy');
});
require __DIR__ . '/auth.php';
