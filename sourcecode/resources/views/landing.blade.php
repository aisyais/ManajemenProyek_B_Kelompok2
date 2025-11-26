<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TaduLapor - Landing Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg1:#18324a; /* dark blue */
      --bg2:#562332; /* maroon */
      --accent:#ffd24d; /* yellow */
      --card:#eceff4;
      --muted: rgba(255,255,255,0.85);
      --container: 1100px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;font-family:Montserrat,system-ui,Arial; color:#fff; background:linear-gradient(180deg,var(--bg1),var(--bg2));
      -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;
    }
    .wrap{max-width:var(--container);margin:24px auto;padding:24px}

    /* Header / hero */
    .hero{display:flex;gap:24px;align-items:center;padding:48px 24px;border-radius:6px;}
    .hero .left{flex:1}
    .brand{display:flex;gap:12px;align-items:center;margin-bottom:36px}
    .logo{width:56px;height:56px;border-radius:10px;background:linear-gradient(135deg,#c32,#f44);display:flex;align-items:center;justify-content:center;font-weight:800}
    .brand h1{margin:0;font-size:20px;color:var(--accent)}
    .hero h2{font-size:44px;margin:0 0 18px 0;line-height:1.02;font-weight:800}
    .hero p.lead{color:var(--muted);max-width:520px;margin-bottom:28px}
    .btn{display:inline-block;background:var(--accent);color:#1b1b1b;padding:14px 26px;border-radius:38px;text-decoration:none;font-weight:700;box-shadow:0 6px 18px rgba(0,0,0,0.2)}

    .hero .right{width:420px;display:flex;align-items:center;justify-content:center}
    .hero .illustration{width:360px;height:320px;background:#fff;border:4px solid rgba(109,182,255,0.8);border-radius:8px;padding:10px;display:flex;align-items:center;justify-content:center}
    .hero .illustration img{max-width:100%;height:auto;display:block}

    /* About section */
    .about{margin:48px 0;padding:36px;border-radius:14px;background:linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));}
    .about h3{font-size:36px;text-align:center;margin:6px 0 26px}
    .about .lead-box{background:rgba(255,255,255,0.07);padding:18px;border-radius:12px;color:rgba(255,255,255,0.9);max-width:900px;margin:0 auto 30px}
    .cards{display:grid;grid-template-columns:1fr;gap:18px;max-width:920px;margin:0 auto}
    .card{background:rgba(255,255,255,0.9);color:#111;padding:18px;border-radius:12px}
    .card h4{background:#fff;padding:10px;border-radius:10px;text-align:center;display:inline-block;margin: -36px auto 12px auto}

    /* features */
    .features{padding:36px 12px}
    .features h3{text-align:center;font-size:32px;margin-bottom:24px}
    .feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:1100px;margin:0 auto}
    .feature{background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));padding:12px;border-radius:18px;display:flex;flex-direction:column;align-items:center}
    .feature img{width:100%;height:170px;object-fit:cover;border-radius:14px}
    .feature p{margin:12px 0 0 0;background:#fff;color:#222;padding:12px;border-radius:10px;width:100%;text-align:center}

    /* footer */
    footer{margin-top:28px;padding:26px 18px;border-radius:8px;background:rgba(0,0,0,0.18);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap}
    footer .left{display:flex;gap:12px;align-items:center}
    footer .left .ft-logo{width:56px;height:56px;background:#fff;border-radius:8px}
    footer .links{display:flex;gap:18px;align-items:center;color:rgba(255,255,255,0.8)}

    /* responsiveness */
    @media(max-width:1000px){
      .hero{flex-direction:column;align-items:flex-start}
      .hero .right{width:100%}
      .feature-grid{grid-template-columns:repeat(2,1fr)}
    }
    @media(max-width:700px){
      .hero h2{font-size:28px}
      .feature-grid{grid-template-columns:1fr}
      .hero .illustration{width:280px;height:240px}
    }
  </style>
</head>
<body>
  <div class="wrap">
    <!-- HERO -->
    <section class="hero">
      <div class="left">
        <div class="brand">
          <img src="{{ asset('images/tadulapor.png') }}" alt="Logo" style="width:60px; height:auto;">
          
          <div>
            <h1>TaduLapor</h1>
            <div style="font-size:12px;color:rgba(255,255,255,0.8);">Tadulako Mendengar</div>
          </div>
        </div>

        <h2>Aspirasi Mahasiswa, Akses Mudah, <br> Tindak Lanjut Cepat</h2>
        <p class="lead">Ciptakan lingkungan kampus yang transparan dan responsif. Kirim keluhan, saran, atau laporan terkait layanan kampus dengan cepat dan terdokumentasi.</p>
        <a class="btn" href="{{ route('login') }}">Sampaikan Suaramu</a> 
      </div>

      <div class="right">
        <div class="illustration">
          <!-- ganti src dengan nama file gambar hero kamu -->
          <img src="{{ asset('images/Buku.png') }}" alt="illustration">
        </div>
      </div>
    </section>

    <!-- ABOUT -->
    <section class="about">
      <h3>About Us</h3>
      <div class="lead-box">Tadulapor adalah platform resmi yang dibuat untuk membantu mahasiswa Universitas Tadulako menyampaikan berbagai keluhan, saran, atau laporan terkait layanan kampus secara cepat, mudah, dan transparan.</div>

      <div class="cards">
        <div class="card">
          <h4>Latar Belakang</h4>
          <p>Tadulapor lahir dari kebutuhan mahasiswa Universitas Tadulako untuk memiliki saluran pelaporan yang terpusat. Banyak mahasiswa kesulitan melaporkan kendala seperti masalah nilai, KRS, atau fasilitas fakultas. Dengan adanya Tadulapor, semua laporan bisa ditangani dengan lebih cepat dan terorganisir.</p>
        </div>

        <div class="card">
          <h4>Tujuan</h4>
          <p>Website ini bertujuan untuk:
            <ul>
              <li>Menjadi media komunikasi dua arah antara mahasiswa dan pihak universitas.</li>
              <li>Mempermudah proses pelaporan masalah akademik maupun non-akademik.</li>
              <li>Meningkatkan transparansi dan efisiensi dalam penyelesaian keluhan mahasiswa.</li>
            </ul>
          </p>
        </div>
      </div>
    </section>

    <!-- FEATURES -->
    <section class="features">
      <h3>Mengapa Memilih TaduLapor</h3>
      <div class="feature-grid">
        <div class="feature">
          <img src="feature1.jpg" alt="Pelaporan Cepat & Mudah">
          <p>Pelaporan Cepat &amp; Mudah</p>
        </div>
        <div class="feature">
          <img src="feature2.jpg" alt="Data Terjamin Aman">
          <p>Data Terjamin Aman</p>
        </div>
        <div class="feature">
          <img src="feature3.jpg" alt="Khusus Mahasiswa">
          <p>Khusus Mahasiswa Universitas Tadulako</p>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <div class="left">
          <img src="{{ asset('images/tadulapor.png') }}" alt="Logo" style="width:50px; height:auto;">
          
          <div>
            <div style="font-weight:700">TaduLapor</div>
            <div style="font-size:12px;color:rgba(255,255,255,0.7)">Tadulako Mendengar</div>
          </div>
      </div>

      <div class="links">
        <div>About</div>
        <div>Mengapa memilih TaduLapor</div>
        <div style="opacity:0.9">2025 TaduLapor. All right Reserved</div>
      </div>
    </footer>
  </div>
</body>
</html>