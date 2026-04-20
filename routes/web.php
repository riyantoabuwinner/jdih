<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/dokumen', [PublicController::class, 'search'])->name('public.documents.index');
Route::get('/dokumen/{slug}', [PublicController::class, 'showDocument'])->name('public.documents.show');
Route::get('/dokumen/view/{slug}', [PublicController::class, 'viewPdf'])->name('public.documents.view-pdf');
Route::get('/dokumen/download/{slug}', [PublicController::class, 'downloadPdf'])->name('public.documents.download');
Route::get('/berita/kategori/{slug}', [PublicController::class, 'newsByCategory'])->name('public.news.category');

// Satisfaction Survey Module
Route::get('/survey', [\App\Http\Controllers\SurveyController::class, 'index'])->name('public.survey');
Route::post('/survey', [\App\Http\Controllers\SurveyController::class, 'store'])->name('public.survey.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('menus/update-order', [\App\Http\Controllers\Admin\MenuController::class, 'updateOrder'])->name('menus.update-order');
    Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
    
    Route::match(['get', 'post', 'delete'], 'bulk-delete/documents', [\App\Http\Controllers\Admin\DocumentController::class, 'bulkDelete'])->name('documents.bulk-delete');
    Route::resource('documents', \App\Http\Controllers\Admin\DocumentController::class);
    Route::post('documents/{document}/status', [\App\Http\Controllers\Admin\DocumentController::class, 'updateStatus'])->name('documents.update-status');
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    // News Management
    Route::match(['get', 'post', 'delete'], 'bulk-delete/news', [\App\Http\Controllers\Admin\NewsController::class, 'bulkDelete'])->name('news.bulk-delete');
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('news-categories', \App\Http\Controllers\Admin\NewsCategoryController::class);

    // Page Management
    Route::match(['get', 'post', 'delete'], 'bulk-delete/pages', [\App\Http\Controllers\Admin\PageController::class, 'bulkDelete'])->name('pages.bulk-delete');
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::get('logs', [\App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs.index');
    Route::get('requests', [\App\Http\Controllers\Admin\RequestController::class, 'index'])->name('requests.index');
    
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    Route::resource('faqs', \App\Http\Controllers\Admin\FAQController::class);
    Route::get('/feedbacks', [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/guides', [\App\Http\Controllers\Admin\GuideController::class, 'index'])->name('guides.index');
    Route::delete('feedbacks/{feedback}', [\App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

    Route::post('impersonate/{user}', [\App\Http\Controllers\Admin\ImpersonateController::class, 'impersonate'])->name('impersonate.start');
    Route::post('impersonate-leave', [\App\Http\Controllers\Admin\ImpersonateController::class, 'leave'])->name('impersonate.leave');

    // Pelaporan Module
    Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/documents', [\App\Http\Controllers\Admin\ReportController::class, 'documents'])->name('reports.documents');

    // Backup Management
    Route::get('backups', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backups.index');
    Route::post('backups/run', [\App\Http\Controllers\Admin\BackupController::class, 'runManual'])->name('backups.run');
    Route::post('backups/settings', [\App\Http\Controllers\Admin\BackupController::class, 'updateSettings'])->name('backups.updateSettings');
    Route::get('backups/download/{file}', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('backups.download');
    Route::delete('backups/delete/{file}', [\App\Http\Controllers\Admin\BackupController::class, 'destroy'])->name('backups.destroy');
});

// System pages are now handled by the catch-all /{slug} route at the bottom

Route::get('/faq', [PublicController::class, 'faq'])->name('public.faq');
Route::get('/feedback', [PublicController::class, 'feedback'])->name('public.feedback');
Route::post('/feedback', [PublicController::class, 'storeFeedback'])->name('public.feedback.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Chatbot API Route
Route::post('/api/chatbot', [\App\Http\Controllers\Public\ChatbotController::class, 'ask'])->name('api.chatbot');

Route::get('/{slug}', [PublicController::class, 'showPage'])->name('public.pages.show');
