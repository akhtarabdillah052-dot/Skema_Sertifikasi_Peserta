<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Sertifikasi Siswa</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f3f4f6;margin:0;min-height:100vh;display:flex;justify-content:center;align-items:center;padding:20px}
        .card{background:white;width:100%;max-width:500px;padding:35px;box-sizing:border-box;border:1px solid #ddd;border-radius:8px}
        h1{font-size:26px;color:#1e293b;margin:0 0 15px}
        p{font-size:15px;color:#555;line-height:1.7;margin-bottom:25px}
        .btn{display:inline-block;padding:11px 20px;text-decoration:none;border-radius:5px;font-size:14px;margin-right:8px}
        .primary{background:#1e3a5f;color:white}
        .outline{border:1px solid #ccc;color:#333}
        .primary:hover{background:#294d75}
        .outline:hover{background:#f3f4f6}
        .footer{margin-top:30px;padding-top:15px;border-top:1px solid #eee;font-size:12px;color:#888}
        @media(max-width:400px){.card{padding:25px 20px}.btn{margin-bottom:8px}}
    </style>
</head>
<body>
    <div class="card">
        <h1>Portal Sertifikasi Siswa</h1>
        <p>Sistem pengelolaan data peserta dan skema sertifikasi kompetensi untuk memudahkan proses pendaftaran dan pengelolaan informasi sertifikasi.</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn primary">Buka Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn primary">Masuk</a>
            <a href="{{ route('register') }}" class="btn outline">Daftar</a>
        @endauth
        <div class="footer">&copy; {{ date('Y') }} Portal Sertifikasi Siswa</div>
    </div>
</body>
</html>
