document.addEventListener('DOMContentLoaded', function() {
    // Grafik Aktivitas
    if (document.getElementById('activityChart')) {
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        
        new Chart(activityCtx, {
            type: 'line',
            data: {
                labels: activityData.dates,
                datasets: [{
                    label: 'Ulasan Baru',
                    data: activityData.reviews,
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Pengguna Baru',
                    data: activityData.users,
                    backgroundColor: 'rgba(28, 200, 138, 0.05)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    pointRadius: 3,
                    pointBackgroundColor: 'rgba(28, 200, 138, 1)',
                    pointBorderColor: 'rgba(28, 200, 138, 1)',
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: 'rgba(28, 200, 138, 1)',
                    pointHoverBorderColor: 'rgba(28, 200, 138, 1)',
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    x: {
                        time: {
                            unit: 'date'
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            beginAtZero: true
                        },
                        grid: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    }

    // Grafik Distribusi Rating
    if (document.getElementById('ratingDistributionChart')) {
        const ratingCtx = document.getElementById('ratingDistributionChart').getContext('2d');
        
        new Chart(ratingCtx, {
            type: 'doughnut',
            data: {
                labels: ["1 Bintang", "2 Bintang", "3 Bintang", "4 Bintang", "5 Bintang"],
                datasets: [{
                    data: ratingDistribution,
                    backgroundColor: ['#e74a3b', '#f6c23e', '#36b9cc', '#1cc88a', '#4e73df'],
                    hoverBackgroundColor: ['#be3d30', '#d9aa35', '#2c9faf', '#17a673', '#2e59d9'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }
});