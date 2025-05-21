<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.articles.index', [
            'articles' => Article::with('user')
                        ->orderBy('created_at', 'desc')
                        ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:articles',
            'image' => 'image|file|max:5120',
            'body' => 'required',
            'excerpt' => 'nullable',
            'published_at' => 'nullable|date'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('article-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        
        // Set published_at if publish is selected, otherwise set to null
        if($request->status === 'published') {
            $validatedData['published_at'] = $request->published_at ?? now();
        } else {
            $validatedData['published_at'] = null;
        }
        
        Article::create($validatedData);

        return redirect('/dashboard/articles')->with('success', 'Artikel baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('dashboard.articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('dashboard.articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $rules = [
            'title' => 'required|max:255',
            'image' => 'image|file|max:5120',
            'body' => 'required',
            'excerpt' => 'nullable',
            'published_at' => 'nullable|date'
        ];

        if($request->slug != $article->slug) {
            $rules['slug'] = 'required|unique:articles';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('article-images');
        }
        
        // Set published_at if publish is selected, otherwise set to null
        if($request->status === 'published') {
            $validatedData['published_at'] = $request->published_at ?? now();
        } else {
            $validatedData['published_at'] = null;
        }
        
        Article::where('id', $article->id)
            ->update($validatedData);

        return redirect('/dashboard/articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::delete($article->image);
        }
        
        Article::destroy($article->id);

        return redirect('/dashboard/articles')->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Check if slug is unique
     */
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}