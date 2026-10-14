<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dashboard Peserta</title>

     <style>
          * { margin:0; padding:0; box-sizing:border-box; font-family:"Segoe UI",Tahoma,sans-serif; }

          body { display:flex; min-height:100vh; background:#f1f5f9; color:#0f172a; }

          aside {
               width:240px;
               background:#0f172a;
               color:#fff;
               padding:25px 20px;
               display:flex;
               flex-direction:column;
               gap:30px;
               position:sticky;
               top:0;
               height:100vh;
          }

          aside .brand {
               display:flex;
               align-items:center;
               gap:10px;
               font-size:13px;
               font-weight:700;
               letter-spacing:1.5px;
          }
          aside .brand::before {
               content:"V";
               width:30px; height:30px;
               background:#1e293b; color:#fff;
               border-radius:8px;
               display:flex; justify-content:center; align-items:center;
               font-size:14px; letter-spacing:0;
          }

          aside nav {
               display:flex;
               flex-direction:column;
               gap:6px;
          }
          aside nav a {
               display:flex;
               align-items:center;
               gap:10px;
               padding:11px 14px;
               font-size:13px;
               font-weight:500;
               color:#94a3b8;
               text-decoration:none;
               border-radius:9px;
               transition:.2s;
          }
          aside nav a:hover { background:#1e293b; color:#fff; }
          aside nav a.active { background:#1e293b; color:#fff; font-weight:600; }

          /* ============ MAIN ============ */
          .main { flex:1; display:flex; flex-direction:column; }

          header {
               display:flex;
               justify-content:space-between;
               align-items:center;
               padding:18px 35px;
               background:#fff;
               border-bottom:1px solid #e2e8f0;
          }
          header .hello { font-size:14px; color:#64748b; }
          header .hello b { color:#0f172a; }

          header button {
               padding:8px 18px;
               background:transparent;
               color:#0f172a;
               font-size:13px;
               font-weight:600;
               border:1px solid #cbd5e1;
               border-radius:20px;
               cursor:pointer;
               transition:.2s;
          }
          header button:hover { background:#0f172a; color:#fff; border-color:#0f172a; }

          main {
               padding:35px;
               flex:1;
          }

          main h1 { font-size:24px; font-weight:700; margin-bottom:6px; }
          main > p { font-size:14px; color:#64748b; margin-bottom:30px; }

          .alert {
               background:#fef2f2;
               color:#991b1b;
               border-left:4px solid #dc2626;
               padding:13px 18px;
               border-radius:10px;
               margin-bottom:20px;
               font-size:14px;
          }

          /* ============ CARDS ============ */
          .cards {
               display:grid;
               grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
               gap:22px;
          }

          .card {
               padding:26px;
               border-radius:16px;
               color:#fff;
               position:relative;
               overflow:hidden;
               box-shadow:0 10px 30px rgba(15,23,42,.15);
          }
          .card::after {
               content:"";
               position:absolute;
               width:130px; height:130px;
               border-radius:50%;
               background:rgba(255,255,255,.08);
               top:-45px; right:-45px;
          }

          .card h3 {
               font-size:12px;
               font-weight:600;
               letter-spacing:1px;
               text-transform:uppercase;
               opacity:.8;
               margin-bottom:20px;
          }

          .card .number {
               font-size:44px;
               font-weight:700;
               margin-bottom:22px;
          }

          .card a {
               display:inline-block;
               color:#fff;
               font-size:13px;
               font-weight:600;
               text-decoration:none;
               border-bottom:1px solid rgba(255,255,255,.4);
               padding-bottom:2px;
               transition:.2s;
          }
          .card a:hover { border-color:#fff; }

          .dark { background:linear-gradient(135deg,#0f172a,#1e293b); }
          .gray { background:linear-gradient(135deg,#475569,#64748b); }

          /* ============ RESPONSIVE ============ */
          @media (max-width:768px) {
               body { flex-direction:column; }
               aside { width:100%; height:auto; position:static; flex-direction:row; justify-content:space-between; align-items:center; padding:15px 20px; }
               aside nav { flex-direction:row; gap:4px; }
               aside nav a { padding:8px 12px; font-size:12px; }
               header { padding:14px 20px; flex-direction:column; gap:10px; align-items:flex-start; }
               main { padding:20px; }
               main h1 { font-size:20px; }
          }
     </style>
</head>

<body>

     <aside>
          <div class="brand">SERTIFIKASI BNSP</div>

          <nav>
               <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
               <a href="{{ route('skema.index') }}">Skema Sertifikasi</a>
               <a href="{{ route('peserta.index') }}"class="active">Data Peserta</a>
          </nav>
     </aside>

     <div class="main">

          <header>
               <div class="hello">
                    Halo, <b>{{ Auth::user()->name ?? Auth::user()->email ?? 'Admin' }}</b>
               </div>

               <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
               </form>
          </header>

          <main>
               <h1>Selamat Datang di Aplikasi Pengelolaan Data Peserta</h1>
               <p>Ringkasan data sistem sertifikasi kompetensi.</p>

               @if(session('error'))
               <div class="alert">
                    {{ session('error') }}
               </div>
               @endif

               <div class="cards">

                    <div class="card dark">
                         <h3>Total Skema Sertifikasi</h3>
                         <div class="number">{{ $totalSkema }}</div>
                         <a href="{{ route('skema.index') }}">Lihat Detail</a>
                    </div>

                    <div class="card gray">
                         <h3>Total Peserta Terdaftar</h3>
                         <div class="number">{{ $totalPeserta }}</div>
                         <a href="{{ route('peserta.index') }}">Lihat Detail</a>
                    </div>

               </div>
          </main>

     </div>

</body>

</html>     