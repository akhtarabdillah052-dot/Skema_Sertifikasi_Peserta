<!DOCTYPE html>
<html lang="id">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Peserta Saya</title>
     <style>
          * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

          body {
               background: #f3f4f6;
               min-height: 100vh;
               padding: 40px 20px;
          }

          .container {
               max-width: 560px;
               margin: 0 auto;
          }

          header {
               display: flex;
               justify-content: space-between;
               align-items: center;
               margin-bottom: 24px;
          }

          header .hello { font-size: 14px; }

          header button {
               padding: 6px 14px;
               border: 1px solid #ccc;
               background: #fff;
               border-radius: 4px;
               cursor: pointer;
          }

          .card {
               background: #fff;
               border: 1px solid #ddd;
               border-radius: 8px;
               padding: 28px;
          }

          h1 {
               font-size: 20px;
               margin-bottom: 6px;
          }

          .subtitle {
               font-size: 14px;
               color: #666;
               margin-bottom: 24px;
          }

          label {
               display: block;
               margin-top: 14px;
               margin-bottom: 4px;
               font-size: 14px;
          }

          input, select, textarea {
               width: 100%;
               padding: 9px 12px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-family: inherit;
               font-size: 14px;
          }

          textarea { resize: vertical; min-height: 80px; }

          button.submit {
               margin-top: 20px;
               padding: 10px 20px;
               background: #111;
               color: #fff;
               border: none;
               border-radius: 4px;
               cursor: pointer;
               font-size: 14px;
          }

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

          .error-list {
               background: #fee2e2;
               color: #991b1b;
               border: 1px solid #fecaca;
               padding: 10px 14px;
               border-radius: 6px;
               margin-bottom: 16px;
               font-size: 14px;
          }

          .error-list p { margin: 0; }

          /* Detail peserta */
          .detail-table {
               width: 100%;
               border-collapse: collapse;
          }

          .detail-table th,
          .detail-table td {
               text-align: left;
               padding: 10px 8px;
               border-bottom: 1px solid #eee;
               font-size: 14px;
          }

          .detail-table th {
               width: 140px;
               color: #666;
               font-weight: normal;
          }
     </style>
</head>
<body>

     <div class="container">

          <header>
               <div class="hello">
                    Halo, <b>{{ Auth::user()->name ?? Auth::user()->email }}</b>
               </div>
               <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
               </form>
          </header>

          <div class="card">

               @if(session('success'))
                    <div class="alert">{{ session('success') }}</div>
               @endif
               @if(session('error'))
                    <div class="alert err">{{ session('error') }}</div>
               @endif

               @if ($errors->any())
                    <div class="error-list">
                         @foreach ($errors->all() as $error)
                              <p>{{ $error }}</p>
                         @endforeach
                    </div>
               @endif

               @if($peserta)
                    {{-- SUDAH DAFTAR: Tampilkan data --}}
                    <h1>Data Pendaftaran Anda</h1>
                    <p class="subtitle">Anda sudah terdaftar sebagai peserta sertifikasi.</p>

                    <table class="detail-table">
                         <tr>
                              <th>Nama</th>
                              <td>{{ $peserta->nama_peserta }}</td>
                         </tr>
                         <tr>
                              <th>Skema</th>
                              <td>
                                   @if($peserta->skema)
                                        {{ $peserta->skema->kode_skema }} - {{ $peserta->skema->nama_skema }}
                                   @else
                                        -
                                   @endif
                              </td>
                         </tr>
                         <tr>
                              <th>Email</th>
                              <td>{{ $peserta->email }}</td>
                         </tr>
                         <tr>
                              <th>No. HP</th>
                              <td>{{ $peserta->no_hp }}</td>
                         </tr>
                         <tr>
                              <th>Alamat</th>
                              <td>{{ $peserta->alamat }}</td>
                         </tr>
                    </table>

               @else
                    {{-- BELUM DAFTAR: Tampilkan form --}}
                    <h1>Form Pendaftaran Peserta</h1>
                    <p class="subtitle">Isi data di bawah untuk mendaftar sebagai peserta sertifikasi.</p>

                    <form action="{{ route('peserta-saya.store') }}" method="POST">
                         @csrf

                         <label for="skema_id">Pilih Skema Sertifikasi</label>
                         <select id="skema_id" name="skema_id" required>
                              <option value="">-- Pilih Skema --</option>
                              @foreach($skemas as $skema)
                                   <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                        {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                                   </option>
                              @endforeach
                         </select>

                         <label for="nama_peserta">Nama Lengkap</label>
                         <input type="text" id="nama_peserta" name="nama_peserta"
                                value="{{ old('nama_peserta', Auth::user()->name) }}" required>

                         <label for="email">Email</label>
                         <input type="email" id="email" name="email"
                                value="{{ old('email', Auth::user()->email) }}" required>

                         <label for="no_hp">No. HP</label>
                         <input type="text" id="no_hp" name="no_hp"
                                value="{{ old('no_hp') }}" required>

                         <label for="alamat">Alamat</label>
                         <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>

                         <button type="submit" class="submit">Daftar Sekarang</button>
                    </form>
               @endif

          </div>

     </div>
     
</body>
</html>
