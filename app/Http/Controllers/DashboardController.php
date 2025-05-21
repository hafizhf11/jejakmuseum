<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik dasar (tidak berubah)
        $totalMuseums = Post::count();
        $totalReviews = Review::count();
        $totalUsers = User::count();
        $averageRating = Review::avg('rating') ?? 0;

        // Ulasan terbaru (tidak berubah)
        $recentReviews = Review::with(['user', 'post'])
            ->latest()
            ->take(5)
            ->get();

        // Museum terpopuler berdasarkan jumlah ulasan (tidak berubah)
        $popularMuseums = Post::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_count')
            ->take(5)
            ->get();

        // ===== DATA UNTUK GRAFIK (TAMBAHAN) =====

        // 1. Data untuk grafik distribusi rating
        $ratingDistribution = [
            Review::where('rating', 1)->count(),
            Review::where('rating', 2)->count(),
            Review::where('rating', 3)->count(),
            Review::where('rating', 4)->count(),
            Review::where('rating', 5)->count(),
        ];

        // 2. Data untuk grafik museum per kategori
        $museumsByCategory = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();

        // 3. Data untuk grafik tren ulasan bulanan (6 bulan terakhir)
        $reviewTrends = Review::select(
                DB::raw('DATE_FORMAT(created_at, "%b %Y") as month'),
                DB::raw('MONTH(created_at) as month_num'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month', 'month_num', 'year')
            ->orderBy('year')
            ->orderBy('month_num')
            ->get();

        return view('dashboard.index', compact(
            'totalMuseums',
            'totalReviews',
            'totalUsers',
            'averageRating',
            'recentReviews',
            'popularMuseums',
            'ratingDistribution',
            'museumsByCategory',
            'reviewTrends'
        ));
    }
}