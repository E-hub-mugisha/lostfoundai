<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LostDocumentController;
use App\Http\Controllers\FoundDocumentController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\OCRController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VisionController;
use App\Models\LostDocument;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

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

    Route::get('/lost-documents/ai', [LostDocumentController::class, 'indexAI'])->name('documents.index-ai');
    Route::post('/lost-documents/process', [LostDocumentController::class, 'processAI'])->name('lost.process');
    Route::put('/lost-documents/{id}/verify', [LostDocumentController::class, 'updateVerify'])->name('lost-documents.verify');

    // Found IDs
    Route::get('/found-documents', [LostDocumentController::class, 'foundAI'])->name('found_documents.index');
    Route::post('/found-documents', [FoundDocumentController::class, 'store'])->name('found_documents.store');
    Route::get('/found-documents/{id}', [FoundDocumentController::class, 'show'])->name('found_documents.show');
    Route::put('/found-documents/{id}', [FoundDocumentController::class, 'update'])->name('found_documents.update');
    Route::delete('/found-documents/{id}', [FoundDocumentController::class, 'destroy'])->name('found_documents.destroy');
    Route::post('/found-documents/{id_number}/verify', [FoundDocumentController::class, 'verify'])->name('found_documents.verify');

    Route::post('/documents/match/confirm/{foundId}/{lostId}', [FoundDocumentController::class, 'confirmMatch'])
        ->name('documents.match.confirm');

    Route::get('/ocr', [OCRController::class, 'index'])->name('ocr.upload');
    Route::post('/ocr', [OCRController::class, 'process'])->name('ocr.process.image');

    Route::get('/vision', [VisionController::class, 'index'])->name('vision.upload');
    Route::post('/vision', [VisionController::class, 'process'])->name('vision.process');

    Route::get('/upload', [OCRController::class, 'uploadForm'])->name('image.upload.form');
    Route::post('/upload', [OCRController::class, 'store'])->name('image.upload.store');
    Route::get('/preview/{id}', [OCRController::class, 'preview'])->name('image.preview');
    Route::get('/extract-text/{id}', [OCRController::class, 'extractText'])->name('image.extractText');

    Route::get('/get/ocr', [OcrController::class, 'showUploadForm'])->name('ocr.form');
    Route::post('/get/ocr', [OcrController::class, 'processImage'])->name('ocr.process');

    Route::get('match/auto', [MatchController::class, 'autoMatch'])->name('match.auto');

    Route::get('/users', [UserProfileController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserProfileController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserProfileController::class, 'store'])->name('admin.users.store');
    Route::put('/user/update/{id}', [UserProfileController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserProfileController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/upload', [LostDocumentController::class, 'showUploadForm'])->name('documents.upload');
    Route::post('/upload-document', [LostDocumentController::class, 'upload'])->name('document.upload');
    Route::post('/preview', [LostDocumentController::class, 'preview'])->name('documents.preview');
    Route::post('/submit', [LostDocumentController::class, 'storeUploadedDocument'])->name('documents.store');

    Route::get('/found-documents/ai', [FoundDocumentController::class, 'indexAI'])->name('found.index-ai');
    Route::post('/found-documents/process', [FoundDocumentController::class, 'processAI'])->name('found.process');


    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports.index');
    Route::get('document/reports', [DashboardController::class, 'index'])->name('documents.reports');
    Route::get('reports/download', [DashboardController::class, 'download'])->name('documents.reports.download');
    Route::get('documents/reports/download/pdf', [DashboardController::class, 'downloadPdf'])->name('documents.reports.downloadPdf');
});
require __DIR__ . '/auth.php';
