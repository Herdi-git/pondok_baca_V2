<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\ContactMessageController;
use App\Models\Book;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $books = Book::query()
        ->orderBy('title')
        ->get()
        ->groupBy('category')
        ->flatMap(fn ($categoryBooks) => $categoryBooks->take(3))
        ->values();

    return view('index', [
        'books' => $books,
        'comments' => ContactMessage::query()->where('status', 'approved')->latest()->get(),
    ]);
});

Route::get('/katalog', function () {
    return view('katalog', ['books' => Book::query()->orderBy('title')->get()]);
})->name('katalog');

Route::get('/api/books', [BookController::class, 'index'])->name('api.books.index');
Route::get('/api/comments', [BookController::class, 'comments'])->name('api.comments.index');
Route::post('/contact-messages', [ContactMessageController::class, 'store'])->name('contact-messages.store');

Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->middleware('auth')->name('admin.logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', AdminBookController::class)->except('show');
    Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::patch('messages/{contactMessage}/approve', [AdminMessageController::class, 'approve'])->name('messages.approve');
    Route::patch('messages/{contactMessage}/read', [AdminMessageController::class, 'read'])->name('messages.read');
    Route::delete('messages/{contactMessage}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
});

Route::get('/berita/{berita}', function (string $berita) {
    abort_unless(in_array($berita, ['berita1', 'berita2', 'berita3', 'berita4', 'berita5'], true), 404);

    return response()->file(resource_path("views/berita/{$berita}.html"));
})->name('berita');
