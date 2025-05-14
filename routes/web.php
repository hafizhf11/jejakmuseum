<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

// Route untuk halaman publik
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Jejak Museum Indonesia",
        "email" => "museumind@gmial.com",
        "image" => "museum.jpg",
        'active' => 'about',
    ]);
});

Route::get('/profil', function () {
    return view('profil', [
        "title" => "Profil",
        'active' => 'profil'
    ]);
});

Route::get('/koleksi', [PostController::class, 'index']);
 
// halaman single post koleksi
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

// Authentication routes
Route::get('/login', [LoginController::class , 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class , 'authenticate']);
Route::post('/logout', [LoginController::class , 'logout']);

Route::get('/register', [RegisterController::class , 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class , 'store']);

// Favorites routes
Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorite/{id}', [FavoriteController::class, 'toggleById'])->name('favorite.toggle');
    Route::post('/favorite-test/{id}', function($id) {
        return response()->json(['success' => true, 'id' => $id]);
    })->name('favorite.test');
    Route::post('/favorite-test-auth/{id}', function($id) {
        return response()->json(['success' => true, 'id' => $id, 'user' => auth()->id()]);
    })->name('favorite.test.auth');
});

// Reviews routes
Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/my-reviews', [ReviewController::class, 'index'])->name('my.reviews');
});

// ======= DASHBOARD ROUTES =======
// PENTING: Konsolidasikan semua route dashboard di satu group
Route::middleware(['auth', 'is.admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard home
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Post routes
    Route::get('/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->name('posts.checkSlug');
    Route::resource('/posts', DashboardPostController::class);
    
    // Review routes
    Route::get('/reviews', [DashboardReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [DashboardReviewController::class, 'show'])->name('reviews.show');
    Route::delete('/reviews/{review}', [DashboardReviewController::class, 'destroy'])->name('reviews.destroy');
});