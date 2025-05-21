@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<!-- Statistik Ringkasan -->
<div class="row mb-4">
    <!-- Total Museum -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Museum</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMuseums }}</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="home" class="text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Ulasan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Ulasan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalReviews }}</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="message-square" class="text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengguna -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="users" class="text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rating Rata-rata -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Rating Rata-rata</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($averageRating, 1) }}/5.0</div>
                    </div>
                    <div class="col-auto">
                        <i data-feather="star" class="text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Aktivitas -->
<div class="row">
    <!-- Ulasan Terbaru -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ulasan Terbaru</h6>
                <a href="{{ url('/dashboard/reviews') }}" class="btn btn-sm btn-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recentReviews->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Museum</th>
                                    <th>Rating</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReviews as $review)
                                <tr>
                                    <td>{{ $review->user->name }}</td>
                                    <td>{{ $review->post->title }}</td>
                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}">★</span>
                                        @endfor
                                    </td>
                                    <td>{{ $review->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center p-3">Belum ada ulasan.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Museum Terpopuler -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Museum Terpopuler</h6>
                <a href="{{ url('/dashboard/posts') }}" class="btn btn-sm btn-primary">
                    Kelola Museum
                </a>
            </div>
            <div class="card-body">
                @if($popularMuseums->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Museum</th>
                                    <th>Ulasan</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularMuseums as $museum)
                                <tr>
                                    <td>{{ $museum->title }}</td>
                                    <td>{{ $museum->reviews_count }}</td>
                                    <td>
                                        {{ number_format($museum->reviews_avg_rating, 1) }} <span class="text-warning">★</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center p-3">Belum ada museum.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Grafik Dashboard -->
<div class="row mt-4">
    <div class="col-12">
        <h4 class="mb-3">Analisis Dashboard</h4>
    </div>
    
    <!-- Grafik Distribusi Rating -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Distribusi Rating</h6>
            </div>
            <div class="card-body">
                <canvas id="ratingChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik Museum per Kategori -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Museum per Kategori</h6>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Grafik Tren Ulasan -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tren Ulasan 6 Bulan Terakhir</h6>
            </div>
            <div class="card-body">
                <canvas id="reviewTrendChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Grafik Distribusi Rating
    const ratingCtx = document.getElementById('ratingChart').getContext('2d');
    const ratingData = {{ json_encode($ratingDistribution) }};
    const totalRatings = ratingData.reduce((a, b) => a + b, 0);
    
    new Chart(ratingCtx, {
        type: 'pie',
        data: {
            labels: ['1 Bintang', '2 Bintang', '3 Bintang', '4 Bintang', '5 Bintang'],
            datasets: [{
                data: ratingData,
                backgroundColor: ['#e74a3b', '#f6c23e', '#36b9cc', '#1cc88a', '#4e73df'],
                hoverBackgroundColor: ['#be3c2d', '#dda926', '#2c98a8', '#17a673', '#3b62ca'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const percentage = totalRatings > 0 ? Math.round((value / totalRatings) * 100) : 0;
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        },
    });

    // Grafik Museum per Kategori
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryData = @json($museumsByCategory);
    
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: categoryData.map(item => item.name),
            datasets: [{
                label: 'Jumlah Museum',
                data: categoryData.map(item => item.posts_count),
                backgroundColor: '#4e73df',
                borderColor: '#4e73df',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Grafik Tren Ulasan
    const trendCtx = document.getElementById('reviewTrendChart').getContext('2d');
    const trendData = @json($reviewTrends);
    
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: trendData.map(item => item.month),
            datasets: [{
                label: 'Jumlah Ulasan',
                data: trendData.map(item => item.count),
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0 // Menampilkan hanya nilai bulat
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.parsed.y} ulasan`;
                        }
                    }
                }
            }
        }
    });
});
</script>
<style>
/* Styles for dashboard cards */
.border-left-primary {
    border-left: 4px solid #4e73df;
}

.border-left-success {
    border-left: 4px solid #1cc88a;
}

.border-left-info {
    border-left: 4px solid #36b9cc;
}

.border-left-warning {
    border-left: 4px solid #f6c23e;
}

.text-primary {
    color: #4e73df !important;
}

.text-success {
    color: #1cc88a !important;
}

.text-info {
    color: #36b9cc !important;
}

.text-warning {
    color: #f6c23e !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.font-weight-bold {
    font-weight: 700 !important;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}

.shadow {
    box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

</style>
@endsection