<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Pastikan ini ada

class FavoriteController extends Controller // <-- Tambahkan extends Controller di sini
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Method toggle dan index yang sudah ada
    public function toggle(Post $post)
    {
        $user = Auth::user();
        
        if ($user->hasFavorited($post)) {
            $user->favorites()->detach($post);
            $status = false;
        } else {
            $user->favorites()->attach($post);
            $status = true;
        }
        
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Ditambahkan ke favorit' : 'Dihapus dari favorit',
            'count' => $post->favoritedBy()->count()
        ]);
    }
    
    public function index()
    {
        $favorites = Auth::user()->favorites()->latest()->paginate(12);
        return view('favorites.index', [
            'favorites' => $favorites,
            'title' => 'Koleksi Favorit Saya',
            'active' => 'favorites'
        ]);
    }
}