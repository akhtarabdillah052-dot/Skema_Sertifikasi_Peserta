<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Daftar Skema Sertifikasi</title>

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
          .btn.orange { background:#f59e0b; }
          .btn.red { background:#dc2626; }

          .card { background:#fff; border-radius:16px; box-shadow:0 10px 30px rgba(15,23,42,.08); padding:26px; }

          .alert { padding:13px 18px; border-radius:10px; margin-bottom:18px; font-size:14px; display:flex; justify-content:space-between; align-items:center; }
          .alert.ok { background:#f0fdf4; color:#166534; border-left:4px solid #16a34a; }
          .alert.err { background:#fef2f2; color:#991b1b; border-left:4px solid #dc2626; }
          .alert button { background:none; border:none; font-size:16px; color:inherit; cursor:pointer; }

          table { width:100%; border-collapse:collapse; }
          th { background:#0f172a; color:#fff; padding:14px 12px; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:.4px; }
          td { padding:14px 12px; border-bottom:1px solid #e2e8f0; font-size:13px; }
          tbody tr:hover { background:#f8fafc; }

          .badge { display:inline-block; padding:5px 10px; font-size:12px; font-weight:700; background:#e2e8f0; border-radius:5px; }
          .badge.blue { background:#e0e7ff; color:#3730a3; }

          .actions { display:flex; gap:6px; flex-wrap:wrap; }
          .actions form { display:inline; }
          .empty { padding:40px; text-align:center; color:#64748b; }

          @media (max-width:768px) {
               body { flex-direction:column; }
               .sidebar { width:100%; height:auto; position:static; flex-direction:row; justify-content:space-between; align-items:center; padding:15px 20px; }
               .menu { flex-direction:row; }
               .menu a { padding:8px 12px; font-size:12px; }
               .topbar, .toolbar, .actions { flex-direction:column; align-items:stretch; }
               .topbar { padding:14px 20px; }
               .page { padding:20px; }
               .btn { width:100%; text-align:center; }
          }
     </style>
</head>

<body>

     <aside class="sidebar">
          <div class="brand">SERTIFIKASI BNSP</div>
          <nav class="menu">
               <a href="{{ route('dashboard') }}">Dashboard</a>
               <a href="{{ route('skema.index') }}" class="active">Skema Sertifikasi</a>
               <a href="{{ route('peserta.index') }}">Data Peserta</a>
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
               <h1>Daftar Skema Sertifikasi</h1>
               <p>Kelola data skema sertifikasi yang tersedia.</p>

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
                    <h2>Data Skema</h2>
                    <div>
                         <a href="{{ route('dashboard') }}" class="btn gray">Kembali</a>
                         <a href="{{ route('skema.create') }}" class="btn white">Tambah Skema</a>
                    </div>
               </div>

               <div class="card">
                    <table>
                         <thead>
                              <tr>
                                   <th style="width:5%">No</th>
                                   <th>Kode</th>
                                   <th>Nama Skema</th>
                                   <th>Jenis</th>
                                   <th>Jumlah Unit</th>
                                   <th style="width:18%">Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              @forelse($skemas as $key => $skema)
                              <tr>
                                   <td>{{ $key + 1 }}</td>
                                   <td><span class="badge">{{ $skema->kode_skema }}</span></td>
                                   <td><strong>{{ $skema->nama_skema }}</strong></td>
                                   <td><span class="badge blue">{{ $skema->jenis }}</span></td>
                                   <td>{{ $skema->jumlah_unit }} Unit</td>
                                   <td>
                                        <div class="actions">
                                             <a href="{{ route('skema.edit', $skema->id) }}" class="btn orange">Edit</a>
                                             <form action="{{ route('skema.destroy', $skema->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn red">Hapus</button>
                                             </form>
                                        </div>
                                   </td>
                              </tr>
                              @empty
                              <tr>
                                   <td colspan="6" class="empty">
                                        Data skema sertifikasi belum tersedia.
                                        <br><br>
                                        <a href="{{ route('skema.create') }}" class="btn white">Tambah Skema</a>
                                   </td>
                              </tr>
                              @endforelse
                         </tbody>
                    </table>
               </div>
          </main>
     </div>

</body>

</html>