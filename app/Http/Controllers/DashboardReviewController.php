<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        // Ambil semua review dengan join ke posts dan users
        $reviews = DB::table('reviews')
            ->join('posts', 'reviews.post_id', '=', 'posts.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select(
                'reviews.id',
                'reviews.rating',
                'reviews.comment',
                'reviews.created_at',
                'posts.title as post_title',
                'posts.image as post_image',
                'posts.slug as post_slug',
                'users.name as user_name'
            )
            ->orderBy('reviews.created_at', 'desc')
            ->paginate(10);

        return view('dashboard.reviews.index', [
            'reviews' => $reviews
        ]);
    }

    /**
     * Show the details of a review
     */
    public function show($id)
    {
        $review = DB::table('reviews')
            ->join('posts', 'reviews.post_id', '=', 'posts.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select(
                'reviews.*',
                'posts.title as post_title',
                'posts.image as post_image',
                'posts.id as post_id',
                'posts.slug as post_slug', 
                'users.name as user_name',
                'users.email as user_email'
            )
            ->where('reviews.id', $id)
            ->first();

        if (!$review) {
            return redirect()->route('dashboard.reviews.index')
                ->with('error', 'Review tidak ditemukan');
        }

        return view('dashboard.reviews.show', compact('review'));
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        
        if (!$review) {
            return redirect()->route('dashboard.reviews.index')
                ->with('error', 'Review tidak ditemukan');
        }

        $review->delete();

        return redirect()->route('dashboard.reviews.index')
            ->with('success', 'Review berhasil dihapus');
    }
}