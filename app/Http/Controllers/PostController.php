<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
      
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' Category by ' . $category->name;
        }

        return view('koleksi', [
            "title" => "All Posts" . $title,
            "active" => 'koleksi',
            "posts" => Post::latest()->filter(request(['search', 'category']))->paginate(6)->withQueryString()
        ]);
    }
    
    public function show(Post $post)
    {
        $relatedMuseums = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->latest()
                            ->take(4)
                            ->get();
        
        return view('post', [
            "title" => "Single Post",
            "active" => 'posts',
            "post" => $post,
            "relatedMuseums" => $relatedMuseums
        ]);
    }
}
