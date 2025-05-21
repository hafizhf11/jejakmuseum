<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        if (!$query) {
            return redirect('/');
        }
        
        // Cari di Koleksi Museum (Posts)
        $posts = Post::where(function($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
              ->orWhere('provinsi', 'like', '%' . $query . '%')
              ->orWhere('kabupaten', 'like', '%' . $query . '%');
        })
        ->with(['category'])
        ->latest()
        ->paginate(6, ['*'], 'posts_page');
        
        // Cari di Artikel
        $articles = Article::where(function($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
              ->orWhere('body', 'like', '%' . $query . '%')
              ->orWhere('excerpt', 'like', '%' . $query . '%');
        })
        ->published()
        ->with('user')
        ->latest('published_at')
        ->paginate(6, ['*'], 'articles_page');
        
        return view('search.results', [
            'title' => 'Hasil Pencarian: ' . $query,
            'active' => 'search',
            'query' => $query,
            'posts' => $posts,
            'articles' => $articles,
        ]);
    }
}