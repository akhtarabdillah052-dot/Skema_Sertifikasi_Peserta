<!DOCTYPE html>
<html lang="id">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Portal Sertifikasi Siswa</title>
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
               max-width: 480px;
               padding: 40px 32px;
               border: 1px solid #ddd;
               border-radius: 8px;
               text-align: center;
          }

          h1 {
               font-size: 24px;
               margin-bottom: 12px;
          }

          p {
               color: #555;
               line-height: 1.6;
               margin-bottom: 28px;
          }

          .actions {
               display: flex;
               gap: 10px;
               justify-content: center;
          }

          .btn {
               padding: 10px 22px;
               border-radius: 4px;
               text-decoration: none;
               font-size: 14px;
          }

          .btn-primary {
               background: #111;
               color: #fff;
          }

          .btn-outline {
               background: #fff;
               color: #111;
               border: 1px solid #ccc;
          }
     </style>
</head>
<body>

     <div class="card">

          <h1>Portal Sertifikasi Siswa</h1>
          <p>Sistem pengelolaan data peserta dan skema sertifikasi kompetensi.</p>

          <div class="actions">
               @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Buka Dashboard</a>
               @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-outline">Daftar</a>
               @endauth
          </div>

     </div>

</body>
</html>
