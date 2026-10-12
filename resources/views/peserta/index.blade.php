<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Daftar Peserta Sertifikasi</title>

     <style>
          * { margin:0; padding:0; box-sizing:border-box; font-family:"Segoe UI",Tahoma,sans-serif; }
          body { display:flex; min-height:100vh; background:#f1f5f9; color:#0f172a; }

          .sidebar { width:240px; background:#0f172a; color:#fff; padding:25px 20px; display:flex; flex-direction:column; gap:30px; position:sticky; top:0; height:100vh; }
          .brand { display:flex; align-items:center; gap:10px; font-size:13px; font-weight:700; letter-spacing:1.5px; }
          .brand::before { content:"V"; width:30px; height:30px; background:#1e293b; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:14px; }
          .menu { display:flex; flex-direction:column; gap:6px; }
          .menu a { padding:11px 14px; font-size:13px; color:#94a3b8; text-decoration:none; border-radius:9px; }
          .menu a:hover, .menu a.active { background:#1e293b; color:#fff; }

          .content { flex:1; display:flex; flex-direction:column; }
          .topbar { display:flex; justify-content:space-between; align-items:center; padding:18px 35px; background:#fff; border-bottom:1px solid #e2e8f0; font-size:14px; color:#64748b; }
          .topbar b { color:#0f172a; }
          .topbar button { padding:8px 18px; background:transparent; color:#0f172a; font-size:13px; font-weight:600; border:1px solid #cbd5e1; border-radius:20px; cursor:pointer; }
          .topbar button:hover { background:#0f172a; color:#fff; border-color:#0f172a; }

          .page { padding:35px; flex:1; }
          .page h1 { font-size:24px; margin-bottom:6px; }
          .page p { font-size:14px; color:#64748b; margin-bottom:30px; }

          .toolbar { display:flex; justify-content:space-between; align-items:center; gap:15px; margin-bottom:22px; flex-wrap:wrap; }
          .toolbar h2 { font-size:18px; }
          .toolbar div { display:flex; gap:10px; flex-wrap:wrap; }

          .btn { padding:10px 18px; font-size:13px; font-weight:600; color:#fff; background:#0f172a; border:none; border-radius:9px; text-decoration:none; cursor:pointer; }
          .btn:hover { opacity:.9; }
          .btn.gray { background:#64748b; }
          .btn.white { background:#fff; color:#0f172a; border:1px solid #cbd5e1; }
          .btn.blue { background:#0ea5e9; }
          .btn.orange { background:#f59e0b; }
          .btn.red { background:#dc2626; }

          .card { background:#fff; border-radius:16px; box-shadow:0 10px 30px rgba(15,23,42,.08); overflow:hidden; padding:26px; }

          .alert { padding:13px 18px; border-radius:10px; margin-bottom:18px; font-size:14px; display:flex; justify-content:space-between; align-items:center; }
          .alert.ok { background:#f0fdf4; color:#166534; border-left:4px solid #16a34a; }
          .alert.err { background:#fef2f2; color:#991b1b; border-left:4px solid #dc2626; }
          .alert button { background:none; border:none; font-size:16px; color:inherit; cursor:pointer; }

          .search { display:flex; gap:10px; margin-bottom:22px; flex-wrap:wrap; }
          .search input { flex:1; min-width:220px; padding:11px 14px; font-size:14px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; outline:none; }
          .search input:focus { border-color:#0f172a; background:#fff; }

          table { width:100%; border-collapse:collapse; }
          th { background:#0f172a; color:#fff; padding:14px 12px; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:.4px; }
          td { padding:14px 12px; border-bottom:1px solid #e2e8f0; font-size:13px; }
          tbody tr:hover { background:#f8fafc; }
          .actions { display:flex; gap:6px; flex-wrap:wrap; }
          .actions form { display:inline; }
          .empty { padding:40px; text-align:center; color:#64748b; }

          @media (max-width:768px) {
               body { flex-direction:column; }
               .sidebar { width:100%; height:auto; position:static; flex-direction:row; justify-content:space-between; align-items:center; padding:15px 20px; }
               .menu { flex-direction:row; }
               .menu a { padding:8px 12px; font-size:12px; }
               .topbar, .toolbar, .search, .actions { flex-direction:column; align-items:stretch; }
               .topbar { padding:14px 20px; }
               .page { padding:20px; }
               .btn, .search input, .search button { width:100%; text-align:center; }
          }
     </style>
</head>

<body>

     <aside class="sidebar">
          <div class="brand">SERTIFIKASI BNSP</div>
          <nav class="menu">
               <a href="{{ route('dashboard') }}">Dashboard</a>
               <a href="{{ route('skema.index') }}">Skema Sertifikasi</a>
               <a href="{{ route('peserta.index') }}" class="active">Data Peserta</a>
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
               <h1>Daftar Peserta Sertifikasi</h1>
               <p>Kelola data peserta yang terdaftar pada sistem sertifikasi.</p>

               @if(session('success'))
               <div class="alert ok">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()">x</button>
               </div>
               @endif

               @if(session('error'))
               <div class="alert err">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()">x</button>
               </div>
               @endif

               <div class="toolbar">
                    <h2>Data Peserta</h2>
                    <div>
                         <a href="{{ route('dashboard') }}" class="btn gray">Kembali</a>
                         <a href="{{ route('peserta.create') }}" class="btn white">Tambah Peserta</a>
                    </div>
               </div>

               <div class="card">

                    <form action="{{ route('peserta.index') }}" method="GET" class="search">
                         <input type="text" name="cari" placeholder="Cari nama atau email..." value="{{ request('cari') }}">
                         <button type="submit" class="btn">Cari</button>
                    </form>

                    <table>
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>Nama</th>
                                   <th>Skema</th>
                                   <th>Email</th>
                                   <th>No. HP</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              @forelse($pesertas as $key => $peserta)
                              <tr>
                                   <td>{{ $key + 1 }}</td>
                                   <td>{{ $peserta->nama_peserta }}</td>
                                   <td>{{ $peserta->skema->nama_skema ?? 'Tidak Ada Skema' }}</td>
                                   <td>{{ $peserta->email }}</td>
                                   <td>{{ $peserta->no_hp }}</td>
                                   <td>
                                        <div class="actions">
                                             <a href="{{ route('peserta.show', $peserta->id) }}" class="btn blue">Detail</a>
                                             <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn orange">Edit</a>
                                             <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn red">Hapus</button>
                                             </form>
                                        </div>
                                   </td>
                              </tr>
                              @empty
                              <tr>
                                   <td colspan="6" class="empty">Data peserta tidak ditemukan.</td>
                              </tr>
                              @endforelse
                         </tbody>
                    </table>

               </div>
          </main>
     </div>

</body>

</html>