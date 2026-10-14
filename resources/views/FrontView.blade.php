{{-- resources/views/FrontView.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Portal Sertifikasi Siswa</title>

     <style>
          * { margin:0; padding:0; box-sizing:border-box; font-family:"Segoe UI",Tahoma,sans-serif; }

          body {
               min-height:100vh;
               background:#0f172a;
               background-image:
                    radial-gradient(circle at 15% 20%, #1e293b 0%, transparent 45%),
                    radial-gradient(circle at 85% 80%, #1e293b 0%, transparent 45%);
               color:#fff;
               display:flex;
               flex-direction:column;
          }

          nav {
               display:flex;
               justify-content:space-between;
               align-items:center;
               padding:22px 60px;
               max-width:1200px;
               width:100%;
               margin:0 auto;
          }

          .brand {
               display:flex;
               align-items:center;
               gap:10px;
               font-size:13px;
               font-weight:700;
               letter-spacing:2px;
               color:#fff;
          }
          .brand::before {
               content:"V";
               width:32px; height:32px;
               background:#1e293b; color:#fff;
               border-radius:9px;
               display:flex; justify-content:center; align-items:center;
               font-size:14px; letter-spacing:0;
          }

          .nav-links { display:flex; gap:12px; }

          .btn {
               padding:11px 22px;
               font-size:13px;
               font-weight:600;
               border-radius:10px;
               text-decoration:none;
               cursor:pointer;
               border:none;
               transition:.2s;
               display:inline-block;
          }

          .btn-ghost {
               background:transparent;
               color:#cbd5e1;
               border:1px solid #334155;
          }
          .btn-ghost:hover { background:#1e293b; color:#fff; }

          .btn-primary {
               background:#fff;
               color:#0f172a;
          }
          .btn-primary:hover { background:#e2e8f0; transform:translateY(-1px); }

          /* ============ HERO ============ */
          .hero {
               flex:1;
               display:flex;
               flex-direction:column;
               justify-content:center;
               align-items:center;
               text-align:center;
               padding:60px 24px;
               max-width:820px;
               margin:0 auto;
          }

          .hero .tag {
               display:inline-block;
               font-size:11px;
               font-weight:700;
               letter-spacing:2px;
               text-transform:uppercase;
               color:#94a3b8;
               background:#1e293b;
               padding:7px 16px;
               border-radius:20px;
               margin-bottom:26px;
          }

          .hero h1 {
               font-size:48px;
               line-height:1.15;
               font-weight:700;
               margin-bottom:20px;
          }
          .hero h1 span { color:#94a3b8; }

          .hero p {
               font-size:15px;
               line-height:1.8;
               color:#94a3b8;
               margin-bottom:38px;
               max-width:600px;
          }

          .hero-actions {
               display:flex;
               gap:14px;
               flex-wrap:wrap;
               justify-content:center;
          }

          .hero-actions .btn {
               padding:15px 34px;
               font-size:14px;
          }

          .stats {
               display:flex;
               gap:50px;
               justify-content:center;
               margin-top:70px;
               flex-wrap:wrap;
          }
          .stat { text-align:center; }
          .stat .num {
               font-size:32px;
               font-weight:700;
               color:#fff;
          }
          .stat .lbl {
               font-size:12px;
               letter-spacing:1px;
               text-transform:uppercase;
               color:#64748b;
               margin-top:6px;
          }

          footer {
               text-align:center;
               padding:24px;
               font-size:12px;
               color:#475569;
          }

          @media (max-width:768px) {
               nav { padding:18px 22px; }
               .hero h1 { font-size:32px; }
               .hero p { font-size:14px; }
               .hero-actions .btn { width:100%; text-align:center; }
               .stats { gap:30px; }
          }
     </style>
</head>

<body>

     <nav>
          <div class="brand">PORTAL SERTIFIKASI</div>

          <div class="nav-links">
               @auth
                    {{-- Jika sudah login, arahkan ke dashboard --}}
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
               @else
                    {{-- Jika belum login --}}
                    <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
               @endauth
          </div>
     </nav>

     <main class="hero">

          <span class="tag">Sistem Sertifikasi Kompetensi</span>

          <h1>Portal Sertifikasi <span>Siswa</span></h1>

          <p>
               Platform terintegrasi untuk pengelolaan data peserta, skema sertifikasi,
               dan proses asesmen kompetensi. Akses seluruh informasi sertifikasi Anda
               dalam satu tempat.
          </p>

          <div class="hero-actions">
               @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Buka Dashboard</a>
               @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Masuk ke Aplikasi</a>
                    <a href="{{ route('register') }}" class="btn btn-ghost">Buat Akun Baru</a>
               @endauth
          </div>

          <div class="stats">
               <div class="stat">
                    <div class="num">{{ $totalSkema ?? '0' }}</div>
                    <div class="lbl">Skema Sertifikasi</div>
               </div>
               <div class="stat">
                    <div class="num">{{ $totalPeserta ?? '0' }}</div>
                    <div class="lbl">Peserta Terdaftar</div>
               </div>
               <div class="stat">
                    <div class="num">BNSP</div>
                    <div class="lbl">Standar Nasional</div>
               </div>
          </div>

     </main>

     <footer>
          &copy; {{ date('Y') }} Portal Sertifikasi Siswa. Seluruh hak cipta dilindungi.
     </footer>

</body>

</html>