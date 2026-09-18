<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Katalog Buku | Pondok Baca</title>
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23C08A3E'%3E%3Cpath d='M2 5c2-1 5-1 7 0v14c-2-1-5-1-7 0V5Z'/%3E%3Cpath d='M22 5c-2-1-5-1-7 0v14c2-1 5-1 7 0V5Z'/%3E%3C/svg%3E">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,340;9..144,480;9..144,600&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">
</head>
<body class="news-page">
<a href="#main-content" class="skip-link">Langsung ke konten utama</a>

<header class="site-header scrolled" id="siteHeader">
  <div class="nav-wrap">
    <a href="{{ url('/#home') }}" class="brand">
      <img src="/images/logo.png" alt="Logo Pondok Baca" width="70" height="150">
      Pondok Baca
    </a>
    <nav class="nav-links" id="navLinks">
      <a href="{{ url('/#home') }}" class="nav-link">Home</a>
      <a href="{{ url('/#activity') }}" class="nav-link">Activity</a>
      <a href="{{ route('katalog') }}" class="nav-link active">Books</a>
      <a href="{{ url('/#contact') }}" class="nav-link">Contact</a>
    </nav>
    <button class="nav-toggle" id="navToggle" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="navLinks">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<main id="main-content">
  <section class="books" aria-labelledby="catalogTitle">
    <div class="section-inner">
      <a class="back-link" href="{{ url('/#books') }}">&larr; Kembali ke beranda</a>
      <div class="section-head">
        <div class="mark"><span></span><span></span><span></span><span></span></div>
        <h1 id="catalogTitle">Katalog buku Pondok Baca</h1>
        <p>Cari judul atau nama penulis, lalu gunakan kategori untuk menemukan buku yang sesuai.</p>
      </div>

      <div class="catalog-search">
        <label for="bookSearch">Cari judul atau penulis
          <input id="bookSearch" type="search" placeholder="Contoh: semesta atau Tim Cendekia" autocomplete="off">
        </label>
      </div>
      <p class="catalog-count" id="catalogCount" role="status" aria-live="polite"></p>

      <div class="filter-row" role="tablist" aria-label="Filter kategori buku">
        <button class="filter-chip active" data-filter="all" role="tab" aria-selected="true">Semua</button>
        <button class="filter-chip" data-filter="fiksi" role="tab" aria-selected="false">Fiksi</button>
        <button class="filter-chip" data-filter="non-fiksi" role="tab" aria-selected="false">Non-Fiksi</button>
        <button class="filter-chip" data-filter="sains" role="tab" aria-selected="false">Sains</button>
        <button class="filter-chip" data-filter="anak" role="tab" aria-selected="false">Anak</button>
        <button class="filter-chip" data-filter="sejarah" role="tab" aria-selected="false">Sejarah</button>
      </div>

      <div class="book-grid" id="bookGrid">
        <article class="book-card" data-category="sains" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Mari Bahasa Inggris</h3><p class="book-author">Prof. Yoresky Bilma Bunga</p><p class="book-cat">Sains</p></article>
        <article class="book-card" data-category="fiksi" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Sang Dao Abadi</h3><p class="book-author">Prof. Immanuel Matasak</p><p class="book-cat">Fiksi</p></article>
        <article class="book-card" data-category="fiksi" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Legenda Pendekar Suci</h3><p class="book-author">Prof. Herdianto Bilma Bunga</p><p class="book-cat">Fiksi</p></article>
        <article class="book-card" data-category="fiksi" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Jejak di Tanah Basah</h3><p class="book-author">Rani Kusuma</p><p class="book-cat">Fiksi</p></article>
        <article class="book-card" data-category="fiksi" style="--spine:var(--slate)"><span class="book-status borrowed">Dipinjam</span><h3>Bintang yang Tak Padam</h3><p class="book-author">Aditya Prasetyo</p><p class="book-cat">Fiksi</p></article>
        <article class="book-card" data-category="non-fiksi" style="--spine:var(--brass)"><span class="book-status available">Tersedia</span><h3>Menghitung Ombak</h3><p class="book-author">Sarah Wijaya</p><p class="book-cat">Non-Fiksi</p></article>
        <article class="book-card" data-category="sains" style="--spine:var(--olive)"><span class="book-status available">Tersedia</span><h3>Semesta dalam Genggaman</h3><p class="book-author">Dr. Budi Santoso</p><p class="book-cat">Sains</p></article>
        <article class="book-card" data-category="fiksi" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Kisah dari Rak Belakang</h3><p class="book-author">Nadia Permata</p><p class="book-cat">Fiksi</p></article>
        <article class="book-card" data-category="non-fiksi" style="--spine:var(--brass)"><span class="book-status borrowed">Dipinjam</span><h3>Ekonomi untuk Semua</h3><p class="book-author">Hendra Wibowo</p><p class="book-cat">Non-Fiksi</p></article>
        <article class="book-card" data-category="anak" style="--spine:var(--slate)"><span class="book-status available">Tersedia</span><h3>Petualangan Kancil dan Kawan</h3><p class="book-author">Tim Cendekia</p><p class="book-cat">Anak</p></article>
        <article class="book-card" data-category="sejarah" style="--spine:var(--olive)"><span class="book-status available">Tersedia</span><h3>Jejak Nusantara</h3><p class="book-author">Prof. Siti Amalia</p><p class="book-cat">Sejarah</p></article>
        <article class="book-card" data-category="sains" style="--spine:var(--brass)"><span class="book-status available">Tersedia</span><h3>Rahasia di Balik Bintang</h3><p class="book-author">Dewi Anggraini</p><p class="book-cat">Sains</p></article>
        <article class="book-card" data-category="anak" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Dongeng Sebelum Tidur</h3><p class="book-author">Tim Cendekia</p><p class="book-cat">Anak</p></article>
        <article class="book-card" data-category="anak" style="--spine:var(--rust)"><span class="book-status available">Tersedia</span><h3>Aku Ingin Pulang</h3><p class="book-author">Tim Cendekia</p><p class="book-cat">Remaja</p></article>
        <article class="book-card" data-category="sejarah" style="--spine:var(--olive)"><span class="book-status available">Tersedia</span><h3>Jejak Bayangan</h3><p class="book-author">Prof. Sukilman</p><p class="book-cat">Sejarah</p></article>
        <article class="book-card" data-category="non-fiksi" style="--spine:var(--olive)"><span class="book-status available">Tersedia</span><h3>Seribu Satu Cara Menjadi Tidak Berguna</h3><p class="book-author">Rivaldi Kala Lembang</p><p class="book-cat">Non-Fiksi</p></article>
      </div>
    </div>
  </section>
</main>

<footer class="site-footer">
  <div class="container footer-inner">
    <div><p class="footer-brand">Pondok Baca</p><p class="footer-tag">Ruang baca dan belajar untuk semua warga.</p></div>
    <p class="copyright">&copy; 2026 Pondok Baca. Seluruh isi pada halaman ini adalah milik Pondok Baca.</p>
  </div>
</footer>
<script src="/js/script.js"></script>
</body>
</html>
