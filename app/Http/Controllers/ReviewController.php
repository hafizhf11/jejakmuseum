<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review
     */
    public function store($postId, Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Cek apakah post ada
        $post = Post::findOrFail($postId);

        // Cek apakah user sudah memberi review sebelumnya
        $existingReview = Review::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk museum ini.');
        }

        // Buat review baru
        Review::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }

    /**
     * Update review
     */
    public function update(Request $request, $id)
    {
        // Tambahkan logging untuk debug
        \Log::info('Review update requested', [
            'review_id' => $id, 
            'user_id' => auth()->id(),
            'data' => $request->all()
        ]);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Cari review berdasarkan ID
        $review = Review::findOrFail($id);
        
        // Log review yang ditemukan
        \Log::info('Review found', ['review' => $review]);

        // Pastikan hanya pemilik review yang bisa update
        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah review ini.');
        }

        // Update review
        $updated = $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);
        
        // Log hasil update
        \Log::info('Review update result', ['success' => $updated]);

        return redirect()->back()->with('success', 'Review berhasil diperbarui!');
    }
    /**
     * Delete review
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Pastikan hanya pemilik review yang bisa hapus
        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus review ini.');
        }

        $review->delete();
        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }

    public function index()
    {
        // Ambil semua review milik user yang login
        $reviews = Review::where('user_id', Auth::id())
            ->with(['post' => function($query) {
                $query->select('id', 'title', 'slug', 'image', 'provinsi', 'kabupaten', 'category_id');
            }])
            ->latest()
            ->paginate(12);

        return view('reviews.index', [
            'title' => 'Riwayat Ulasan Saya',
            'active' => 'reviews',
            'reviews' => $reviews
        ]);
    }
}