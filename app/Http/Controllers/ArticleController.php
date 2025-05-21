<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        return view('articles.index', [
            'title' => 'Semua Artikel',
            'active' => 'articles',
            'articles' => Article::published()
                        ->with('user')
                        ->latest('published_at')
                        ->paginate(6)
        ]);
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::with('user')
                ->where('slug', $slug)
                ->firstOrFail();
        
        // Pastikan hanya menampilkan artikel yang dipublikasi
        if (!$article->published_at && !auth()->check()) {
            abort(404);
        }

        // Ambil artikel terkait (3 artikel terbaru selain artikel ini)
        $relatedArticles = Article::where('id', '!=', $article->id)
                                ->where('published_at', '!=', null)
                                ->latest('published_at')
                                ->take(3)
                                ->get();
        
        return view('articles.show', [
            'title' => $article->title,
            'active' => 'articles',
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }
}