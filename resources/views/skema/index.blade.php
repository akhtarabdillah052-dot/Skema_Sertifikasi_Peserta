<!DOCTYPE html>
<html lang="id">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Daftar Skema Sertifikasi</title>
     <style>
          * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

          body { display: flex; min-height: 100vh; background: #f3f4f6; color: #111; }

          /* Sidebar */
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

          /* Main */
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

          /* Toolbar */
          .toolbar {
               display: flex;
               justify-content: space-between;
               align-items: center;
               gap: 12px;
               margin-bottom: 18px;
               flex-wrap: wrap;
          }

          .toolbar h2 { font-size: 17px; }

          /* Buttons */
          .btn {
               display: inline-block;
               padding: 8px 14px;
               font-size: 13px;
               border: none;
               border-radius: 4px;
               text-decoration: none;
               cursor: pointer;
               background: #111;
               color: #fff;
          }

          .btn:hover { opacity: 0.9; }
          .btn-outline { background: #fff; color: #111; border: 1px solid #ccc; }
          .btn-gray { background: #6b7280; }
          .btn-orange { background: #d97706; }
          .btn-red { background: #dc2626; }

          /* Card */
          .card {
               background: #fff;
               border: 1px solid #ddd;
               border-radius: 8px;
               padding: 20px;
          }

          /* Table */
          table { width: 100%; border-collapse: collapse; }

          th {
               text-align: left;
               padding: 10px 8px;
               border-bottom: 1px solid #ddd;
               font-size: 13px;
               color: #555;
          }

          td {
               padding: 12px 8px;
               border-bottom: 1px solid #eee;
               font-size: 14px;
          }

          /* Alert */
          .alert {
               padding: 10px 14px;
               border-radius: 6px;
               margin-bottom: 16px;
               font-size: 14px;
               background: #ecfdf5;
               color: #065f46;
               border: 1px solid #a7f3d0;
          }

          .alert.err {
               background: #fee2e2;
               color: #991b1b;
               border-color: #fecaca;
          }

          /* Actions */
          .actions { display: flex; gap: 6px; }
          .actions form { display: inline; }

          .empty { padding: 30px; text-align: center; color: #666; }

          /* Responsive */
          @media (max-width: 768px) {
               body { flex-direction: column; }
               .sidebar { width: 100%; height: auto; position: static; flex-direction: row; justify-content: space-between; align-items: center; padding: 14px 16px; }
               .menu { flex-direction: row; }
               .menu a { padding: 6px 10px; font-size: 12px; }
               .topbar, .toolbar, .actions { flex-direction: column; align-items: stretch; }
               .page { padding: 16px; }
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
               <a href="{{ route('admin.dokumen.index') }}">
                Verifikasi Dokumen
            </a>
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
                    <div class="alert">{{ session('success') }}</div>
               @endif
               @if(session('error'))
                    <div class="alert err">{{ session('error') }}</div>
               @endif

               <div class="toolbar">
                    <h2>Data Skema</h2>
                    <div>
                         <a href="{{ route('dashboard') }}" class="btn btn-gray">Kembali</a>
                         <a href="{{ route('skema.create') }}" class="btn btn-outline">Tambah Skema</a>
                    </div>
               </div>

               <div class="card">
                    <table>
                         <thead>
                              <tr>
                                   <th>No</th>
                                   <th>Kode</th>
                                   <th>Nama Skema</th>
                                   <th>Jenis</th>
                                   <th>Unit</th>
                                   <th>Aksi</th>
                              </tr>
                         </thead>
                         <tbody>
                              @forelse($skemas as $key => $skema)
                              <tr>
                                   <td>{{ $key + 1 }}</td>
                                   <td>{{ $skema->kode_skema }}</td>
                                   <td>{{ $skema->nama_skema }}</td>
                                   <td>{{ $skema->jenis }}</td>
                                   <td>{{ $skema->jumlah_unit }}</td>
                                   <td>
                                        <div class="actions">
                                             <a href="{{ route('skema.edit', $skema->id) }}" class="btn btn-orange">Edit</a>
                                             <form action="{{ route('skema.destroy', $skema->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button class="btn btn-red">Hapus</button>
                                             </form>
                                        </div>
                                   </td>
                              </tr>
                              @empty
                              <tr>
                                   <td colspan="6" class="empty">Data skema belum tersedia.</td>
                              </tr>
                              @endforelse
                         </tbody>
                    </table>
               </div>

          </main>
     </div>

</body>
</html>
