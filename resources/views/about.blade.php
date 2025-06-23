@extends('layouts.main')

@section('container')
<div class="about-page">
    <!-- Hero Section yang Diperbaiki -->
    <div class="about-header">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="fw-bold">Tentang Jejak Museum Indonesia</h1>
                    <p class="lead">Menelusuri jejak sejarah dan budaya Indonesia melalui museum</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- About Section -->
        <div class="row mb-5">
            <div class="col-lg-6">
                <div class="section-heading mb-4">
                    <span class="section-icon">
                        <i class="bi bi-info-circle"></i>
                    </span>
                    <h2>Apa itu Jejak Museum Indonesia?</h2>
                </div>
                <p>Jejak Museum Indonesia adalah platform digital yang bertujuan untuk memperkenalkan kekayaan sejarah dan budaya melalui daftar museum-museum di seluruh penjuru nusantara. Website ini hadir untuk memudahkan masyarakat dalam mengeksplorasi, mengenal, dan mengunjungi museum-museum yang ada di Indonesia.</p>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="about-image-container">
                    <img src="/img/recom.jpg" width="500" height="300" alt="Koleksi Museum Indonesia" class="about-image rounded shadow-sm">
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="mission-section mb-5">
            <div class="section-heading mb-4">
                <span class="section-icon">
                    <i class="bi bi-bullseye"></i>
                </span>
                <h2>Tujuan Kami</h2>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="mission-card">
                        <span class="mission-icon">
                            <i class="bi bi-collection"></i>
                        </span>
                        <h3>Mengumpulkan Data</h3>
                        <p>Data koleksi museum secara akurat dan terorganisir</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="mission-card">
                        <span class="mission-icon">
                            <i class="bi bi-map"></i>
                        </span>
                        <h3>Menjadi Referensi</h3>
                        <p>Bagi masyarakat sebelum mengunjungi museum</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="mission-card">
                        <span class="mission-icon">
                            <i class="bi bi-heart"></i>
                        </span>
                        <h3>Mendorong Minat</h3>
                        <p>Terhadap pelestarian sejarah dan budaya Indonesia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section mb-5">
            <div class="section-heading mb-4">
                <span class="section-icon">
                    <i class="bi bi-gift"></i>
                </span>
                <h2>Apa yang Kami Tawarkan?</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="feature-item">
                        <span class="feature-icon">
                            <i class="bi bi-archive"></i>
                        </span>
                        <div class="feature-text">
                            <h4>Informasi Koleksi</h4>
                            <p>Data dari berbagai museum di Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="feature-item">
                        <span class="feature-icon">
                            <i class="bi bi-image"></i>
                        </span>
                        <div class="feature-text">
                            <h4>Deskripsi dan Foto</h4>
                            <p>Penjelasan detail dan dokumentasi visual</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="feature-item">
                        <span class="feature-icon">
                            <i class="bi bi-journal-text"></i>
                        </span>
                        <div class="feature-text">
                            <h4>Artikel dan Cerita</h4>
                            <p>Wawasan seputar sejarah koleksi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="feature-item">
                        <span class="feature-icon">
                            <i class="bi bi-search"></i>
                        </span>
                        <div class="feature-text">
                            <h4>Fitur Pencarian</h4>
                            <p>Berdasarkan lokasi, jenis dan nama museum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Important Section -->
        <div class="importance-section mb-5">
            <div class="section-heading mb-4">
                <span class="section-icon">
                    <i class="bi bi-question-circle"></i>
                </span>
                <h2>Mengapa Ini Penting?</h2>
            </div>
            <div class="importance-content p-4">
                <p class="mb-0">Banyak museum menyimpan kekayaan sejarah yang belum dikenal luas. Dengan platform ini, kami ingin mendekatkan publik pada sumber edukasi sejarah dan budaya secara mudah dan modern.</p>
            </div>
        </div>

        <!-- Team Section -->
        <div class="team-section mb-5">
            <div class="section-heading mb-4">
                <span class="section-icon">
                    <i class="bi bi-people"></i>
                </span>
                <h2>Siapa di Balik Website Ini?</h2>
            </div>
            <div class="team-content p-4">
                <p class="mb-0">Website ini dikembangkan oleh tim <strong>mahasiswa</strong> dari Sekolah Vokasi IPB University dengan dedikasi tinggi untuk mempromosikan warisan budaya Indonesia.</p>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <div class="section-heading mb-4">
                <span class="section-icon">
                    <i class="bi bi-envelope"></i>
                </span>
                <h2>Hubungi Kami</h2>
            </div>
            <div class="contact-content p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <p class="mb-0">Punya saran, kritik, atau ingin museum Anda tampil di sini?<br>
                        Silakan hubungi kami melalui <a href="mailto:kontak@jejakkebudayaan.id" class="contact-link">kontak@jejakkebudayaan.id</a></p>
                    </div>
                    <div class="social-icons mt-3 mt-md-0">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
