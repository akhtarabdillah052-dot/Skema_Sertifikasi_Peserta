<!DOCTYPE html>
<html lang="id">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dashboard</title>
     <style>
          * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

          body { display: flex; min-height: 100vh; background: #f3f4f6; color: #111; }

<<<<<<< HEAD
          .sidebar {
               width: 220px;
               background: #111;
               color: #fff;
               padding: 24px 16px;
               display: flex;
               flex-direction: column;
               gap: 24px;
               height: 100vh;
               position: sticky;
               top: 0;
=======
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
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
          }

          .brand { font-size: 13px; font-weight: bold; letter-spacing: 1px; }

          .menu { display: flex; flex-direction: column; gap: 4px; }

          .menu a {
               padding: 9px 12px;
               font-size: 13px;
               color: #bbb;
               text-decoration: none;
               border-radius: 6px;
          }

          .menu a:hover { background: #222; color: #fff; }
          .menu a.active { background: #222; color: #fff; }

          .content { flex: 1; display: flex; flex-direction: column; }

          .topbar {
               display: flex;
               justify-content: space-between;
               align-items: center;
               padding: 16px 28px;
               background: #fff;
               border-bottom: 1px solid #ddd;
               font-size: 14px;
          }

          .topbar button {
               padding: 6px 14px;
               border: 1px solid #ccc;
               background: #fff;
               border-radius: 4px;
               cursor: pointer;
          }

          .page { padding: 28px; flex: 1; }
          .page h1 { font-size: 22px; margin-bottom: 6px; }
          .page p { font-size: 14px; color: #666; margin-bottom: 24px; }

          .cards {
               display: grid;
               grid-template-columns: 1fr 1fr;
               gap: 16px;
          }

          .card {
               background: #fff;
               border: 1px solid #ddd;
               border-radius: 8px;
               padding: 24px;
          }

          .card h3 {
               font-size: 13px;
               color: #666;
               margin-bottom: 12px;
               font-weight: normal;
          }

          .card .number {
               font-size: 32px;
               font-weight: bold;
               margin-bottom: 12px;
          }

          .card a {
               font-size: 13px;
               color: #111;
          }

          .alert {
               padding: 10px 14px;
               border-radius: 6px;
               margin-bottom: 16px;
               font-size: 14px;
               background: #fee2e2;
               color: #991b1b;
               border: 1px solid #fecaca;
          }

          /* Responsive */
          @media (max-width: 768px) {
               body { flex-direction: column; }
               .sidebar { width: 100%; height: auto; position: static; flex-direction: row; justify-content: space-between; align-items: center; padding: 14px 16px; }
               .menu { flex-direction: row; }
               .menu a { padding: 6px 10px; font-size: 12px; }
               .topbar { flex-direction: column; align-items: stretch; gap: 10px; }
               .page { padding: 16px; }
               .cards { grid-template-columns: 1fr; }
          }
     </style>
</head>
<body>

     <aside class="sidebar">
          <div class="brand">SERTIFIKASI BNSP</div>

<<<<<<< HEAD
          <nav class="menu">

               @if(Auth::user()->role === 'admin')

                    {{-- Menu Admin --}}
                    <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
                    <a href="{{ route('skema.index') }}">Skema Sertifikasi</a>
                    <a href="{{ route('peserta.index') }}">Data Peserta</a>

               @else

                    {{-- Menu User Biasa --}}
                    <a href="{{ route('peserta-saya.index') }}" class="active">Peserta Saya</a>

               @endif

=======
          <nav>
               <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
               <a href="{{ route('skema.index') }}">Skema Sertifikasi</a>
               <a href="{{ route('peserta.index') }}"class="active">Data Peserta</a>
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
          </nav>
     </aside>

     <div class="content">

          <div class="topbar">
               <div>Halo, <b>{{ Auth::user()->name ?? Auth::user()->email ?? 'Admin' }}</b></div>
               <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
               </form>
          </div>

          <main class="page">

               <h1>Dashboard</h1>
               <p>Ringkasan data sistem sertifikasi.</p>

               @if(session('error'))
                    <div class="alert">{{ session('error') }}</div>
               @endif

               <div class="cards">

                    <div class="card">
                         <h3>Total Skema Sertifikasi</h3>
                         <div class="number">{{ $totalSkema }}</div>
                         <a href="{{ route('skema.index') }}">Lihat detail →</a>
                    </div>

                    <div class="card">
                         <h3>Total Peserta Terdaftar</h3>
                         <div class="number">{{ $totalPeserta }}</div>
                         <a href="{{ route('peserta.index') }}">Lihat detail →</a>
                    </div>

               </div>

          </main>
     </div>

</body>
<<<<<<< HEAD
</html>
=======

</html>     
>>>>>>> 8443a6891394839ca84e081da441ff504954d6b6
