<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik dasar
        $totalMuseums = Post::count();
        $totalReviews = Review::count();
        $totalUsers = User::count();
        $averageRating = Review::avg('rating') ?? 0;

        // Ulasan terbaru
        $recentReviews = Review::with(['user', 'post'])
            ->latest()
            ->take(5)
            ->get();

        // Museum terpopuler berdasarkan jumlah ulasan
        $popularMuseums = Post::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_count')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalMuseums',
            'totalReviews',
            'totalUsers',
            'averageRating',
            'recentReviews',
            'popularMuseums'
        ));
    }
}