<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil post terbaru dengan cara yang sama seperti di PostController
        // tetapi tanpa filter dan tanpa pagination karena kita hanya ingin beberapa item
        $latestPosts = Post::with('category')
            ->latest()
            ->take(8)
            ->get();

        return view('home', [
            'title' => 'Home',
            'active' => 'home',
            'latestPosts' => $latestPosts,
            'latestArticles' => Article::published()->with('user')->latest('published_at')->take(4)->get()
        ]);
    }
}