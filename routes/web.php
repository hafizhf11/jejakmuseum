<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\FavoriteController;

// use App\Http\Middleware\IsAdmin;
// use App\Http\Middleware\Authenticate;

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        'active' => 'home'
    ]);
})->middleware('web');

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
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Route::get('/login', [LoginController::class , 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class , 'authenticate']);
Route::post('/logout', [LoginController::class , 'logout']);

Route::get('/register', [RegisterController::class , 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class , 'store']);

Route::middleware(['web', 'auth', 'is.admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
    
    Route::resource('/dashboard/posts', DashboardPostController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// Tambahkan ini di web.php untuk testing
Route::post('/favorite-test/{id}', function($id) {
    return response()->json(['success' => true, 'id' => $id]);
})->name('favorite.test');

// Route untuk halaman favorit (GET request)
Route::get('/favorites', [FavoriteController::class, 'index'])
    ->middleware('auth')
    ->name('favorites.index');

Route::post('/favorite-test-auth/{id}', function($id) {
    return response()->json(['success' => true, 'id' => $id, 'user' => auth()->id()]);
})->middleware('auth')->name('favorite.test.auth');

// Tambahkan di web.php 
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');