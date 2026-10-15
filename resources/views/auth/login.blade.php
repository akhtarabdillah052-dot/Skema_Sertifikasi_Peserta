<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Portal Sertifikasi Siswa</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f3f4f6;min-height:100vh;margin:0;display:flex;justify-content:center;align-items:center;padding:20px}
        .card{background:#fff;width:100%;max-width:380px;padding:32px;box-sizing:border-box;border:1px solid #ddd;border-radius:8px}
        h1{font-size:26px;color:#1e293b;margin:0 0 10px}
        .description{font-size:14px;color:#666;line-height:1.6;margin-bottom:22px}
        label{display:block;margin:14px 0 6px;font-size:14px;color:#333}
        input{width:100%;padding:10px;box-sizing:border-box;border:1px solid #ccc;border-radius:5px;font-size:14px}
        input:focus{outline:1px solid #1e3a5f;border-color:#1e3a5f}
        button{width:100%;margin-top:20px;padding:11px;cursor:pointer;border:0;background:#1e3a5f;color:#fff;border-radius:5px;font-size:14px}
        button:hover{background:#294d75}
        .error{color:#b00020;font-size:13px;margin-bottom:12px}
        .error p{margin:4px 0}
        .link{margin-top:20px;font-size:13px;color:#555;text-align:center}
        a{color:#1e3a5f}
        .footer{margin-top:22px;padding-top:14px;border-top:1px solid #eee;font-size:12px;color:#888;text-align:center}
    </style>
</head>
<body>
    <div class="card">
        <h1>Masuk</h1>
        <p class="description">Portal Sertifikasi Siswa. Silakan masuk ke akun Anda untuk melanjutkan.</p>
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
            <button type="submit">Masuk</button>
        </form>
        <p class="link">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        <div class="footer">&copy; {{ date('Y') }} Portal Sertifikasi Siswa</div>
    </div>
</body>
</html>
