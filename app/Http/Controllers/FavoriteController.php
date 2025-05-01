<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for a post
     */
    public function toggle(Post $post)
    {
        try {
            // Pastikan user sudah login
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            $user = Auth::user();
            
            // Log aksi untuk debugging
            Log::info('Toggle favorite request for post: ' . $post->id . ' by user: ' . $user->id);
            
            // Cek jika post sudah di-favorite
            $exists = $user->favorites()->where('post_id', $post->id)->exists();
            
            if ($exists) {
                // Hapus dari favorit
                $user->favorites()->detach($post->id);
                $status = false;
                $message = 'Dihapus dari favorit';
                Log::info('Removed from favorites');
            } else {
                // Tambahkan ke favorit
                $user->favorites()->attach($post->id);
                $status = true;
                $message = 'Ditambahkan ke favorit';
                Log::info('Added to favorites');
            }
            
            // Return JSON response
            return response()->json([
                'status' => $status,
                'message' => $message,
                'count' => $post->favoritedBy()->count()
            ]);
        } catch (\Exception $e) {
            Log::error('Error pada toggle favorite: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Display user's favorites
     */
    public function index()
{
    try {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $user = Auth::user();
        
        // Log untuk debugging
        \Log::info('Loading favorites for user', [
            'user_id' => $user->id,
            'username' => $user->name
        ]);
        
        // Langkah 1: Cek data mentah di tabel pivot
        $rawFavorites = \DB::table('favorites')
            ->where('user_id', $user->id)
            ->get();
        
        \Log::info('Raw favorites from pivot table', [
            'count' => $rawFavorites->count(),
            'data' => $rawFavorites->toArray()
        ]);
        
        // Langkah 2: Ambil Post dengan relasi yang benar
        $favorites = Post::whereIn('id', function($query) use ($user) {
            $query->select('post_id')
                ->from('favorites')
                ->where('user_id', $user->id);
        })->latest()->paginate(12);
        
        \Log::info('Favorites loaded', [
            'count' => $favorites->count(),
            'ids' => $favorites->pluck('id')->toArray()
        ]);
        
        return view('favorites.index', [
            'favorites' => $favorites,
            'title' => 'Koleksi Favorit Saya',
            'active' => 'favorites'
        ]);
    } catch (\Exception $e) {
        \Log::error('Error loading favorites', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->route('home')
            ->with('error', 'Terjadi kesalahan saat memuat halaman favorit: ' . $e->getMessage());
    }
}

/**
 * User's favorite posts
 */
public function favorites()
{
    // Pastikan ini mengembalikan Post objects lengkap, bukan pivot saja
    return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')
                ->withTimestamps();
}

    /**
 * Toggle favorite status using direct ID
 */
public function toggleById($id)
{
    try {
        // Log untuk debugging
        Log::info('Toggle favorite request by ID', ['post_id' => $id]);
        
        // Cari post secara manual
        $post = Post::findOrFail($id);
        
        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $user = Auth::user();
        
        // Cek jika post sudah di-favorite
        $exists = $user->favorites()->where('post_id', $post->id)->exists();
        
        if ($exists) {
            // Hapus dari favorit
            $user->favorites()->detach($post->id);
            $status = false;
            $message = 'Dihapus dari favorit';
            Log::info('Removed from favorites');
        } else {
            // Tambahkan ke favorit
            $user->favorites()->attach($post->id);
            $status = true;
            $message = 'Ditambahkan ke favorit';
            Log::info('Added to favorites');
        }
        
        // Return JSON response
        return response()->json([
            'status' => $status,
            'message' => $message,
            'count' => $post->favoritedBy()->count()
        ]);
    } catch (\Exception $e) {
        Log::error('Error pada toggle favorite: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}