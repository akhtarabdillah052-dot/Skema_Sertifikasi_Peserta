<!DOCTYPE html>
<html lang="id">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Daftar</title>
     <style>
          body {
               font-family: Arial, sans-serif;
               background: #f3f4f6;
               min-height: 100vh;
               margin: 0;
               display: flex;
               justify-content: center;
               align-items: center;
               padding: 20px;
          }

          .card {
               background: #fff;
               width: 100%;
               max-width: 380px;
               padding: 32px;
               border: 1px solid #ddd;
               border-radius: 8px;
          }

          h1 {
               font-size: 22px;
               margin-bottom: 20px;
          }

          label {
               display: block;
               margin-top: 12px;
               margin-bottom: 4px;
          }

          input {
               width: 100%;
               padding: 8px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
          }

          .hint {
               font-size: 12px;
               color: #777;
               margin-top: 4px;
          }

          button {
               margin-top: 18px;
               padding: 9px 16px;
               cursor: pointer;
               border: none;
               background: #111;
               color: #fff;
               border-radius: 4px;
          }

          .error {
               color: #b00020;
               margin-bottom: 12px;
          }

          .error p { margin: 0; }

          .link { margin-top: 16px; }
     </style>
</head>
<body>

     <div class="card">

          <h1>Buat Akun</h1>

          @if ($errors->any())
          <div class="error">
               @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
               @endforeach
          </div>
          @endif

          <form action="{{ route('register') }}" method="POST">
               @csrf

               <label for="name">Nama Lengkap</label>
               <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus>

               <label for="email">Email</label>
               <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required>

               <label for="password">Password</label>
               <input
                    id="password"
                    name="password"
                    type="password"
                    required>

               <label for="password_confirmation">Konfirmasi Password</label>
               <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required>

               <label for="admin_code">Kode Admin (opsional)</label>
               <input
                    id="admin_code"
                    name="admin_code"
                    type="text"
                    value="{{ old('admin_code') }}"
                    placeholder="Kosongkan jika bukan admin">
               <p class="hint">Isi hanya jika Anda memiliki kode akses admin.</p>

               <button type="submit">Daftar</button>
          </form>

          <p class="link">
               Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
          </p>

     </div>

</body>
</html>
