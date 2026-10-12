<!doctype html>
<html lang="id">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Login - Portal Sertifikasi Siswa</title>
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<style>
          * { margin:0; padding:0; box-sizing:border-box; font-family:"Segoe UI",Tahoma,sans-serif; }

          body {
               display:flex; justify-content:center; align-items:center;
               min-height:100vh; padding:20px;
               background:#0f172a;
               background-image:
                    radial-gradient(circle at 15% 20%, #1e293b 0%, transparent 45%),
                    radial-gradient(circle at 85% 80%, #1e293b 0%, transparent 45%);
          }

          .login-box {
               width:100%; max-width:420px;
               background:#fff;
               padding:40px 35px;
               border-radius:20px;
               box-shadow:0 25px 60px rgba(0,0,0,.5);
               position:relative;
          }

          .brand {
               display:flex; align-items:center; gap:10px;
               font-size:12px; font-weight:700;
               letter-spacing:2px; color:#0f172a;
               margin-bottom:28px;
          }
          .brand::before {
               content:"V";
               width:30px; height:30px;
               background:#0f172a; color:#fff;
               border-radius:9px;
               display:flex; justify-content:center; align-items:center;
               font-size:14px; letter-spacing:0;
          }

          h1 { font-size:26px; font-weight:700; color:#0f172a; margin-bottom:8px; }
          p  { font-size:13px; color:#64748b; line-height:1.6; margin-bottom:28px; }

          label {
               display:block;
               font-size:11px; font-weight:700;
               letter-spacing:1px; text-transform:uppercase;
               color:#334155; margin-bottom:7px;
          }

          input {
               width:100%;
               padding:13px 15px;
               font-size:14px; font-family:inherit;
               color:#0f172a; background:#f8fafc;
               border:1px solid #e2e8f0;
               border-radius:12px;
               outline:none;
               margin-bottom:20px;
               transition:.2s;
          }
          input:focus { border-color:#0f172a; background:#fff; box-shadow:0 0 0 4px rgba(15,23,42,.08); }
          input.invalid { border-color:#dc2626; background:#fef2f2; }

          .alert {
               background:#fef2f2; color:#991b1b;
               border-left:3px solid #dc2626;
               padding:12px 16px; border-radius:10px;
               margin-bottom:20px;
          }
          .alert p { margin:0; color:inherit; font-size:13px; }

          .toggle {
               position:absolute;
               right:52px;
               background:none; border:none;
               font-size:11px; font-weight:700;
               letter-spacing:1px; color:#94a3b8;
               cursor:pointer; padding:0;
          }
          .toggle:hover { color:#0f172a; }

          .submit {
               width:100%;
               padding:14px;
               background:#0f172a; color:#fff;
               font-size:14px; font-weight:700;
               letter-spacing:.5px;
               border:none; border-radius:12px;
               cursor:pointer;
               margin-top:6px;
               transition:.2s;
          }
          .submit:hover { background:#1e293b; transform:translateY(-1px); }
          .submit:active { transform:translateY(0); }

          .footer {
               text-align:center;
               font-size:12px; color:#64748b;
               margin-top:26px;
          }
          .footer a {
               color:#0f172a; font-weight:700;
               text-decoration:none;
               border-bottom:1px solid #cbd5e1;
               padding-bottom:1px;
          }
          .footer a:hover { border-color:#0f172a; }
     </style>

<body class="login">

     <form class=" login-box" action="{{ route('login') }}" method="POST" autocomplete="off">
     @csrf

     <div class="brand">
          <span>PORTAL SERTIFIKASI</span>
     </div>

     <h1>Selamat Datang.</h1>
     <p>Silakan masuk menggunakan akun email dan password Anda untuk mengakses sistem data siswa.</p>

     @if ($errors->any())
     <div class="alert">
          @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach
     </div>
     @endif

     <label for="email">Alamat Email</label>
     <input
          id="email"
          name="email"
          type="email"
          placeholder="nama@sekolah.sch.id"
          value="{{ old('email') }}"
          class="@error('email') invalid @enderror"
          required
          autofocus>

     <label for="password">Kata Sandi</label>
  <button type="button" id="passwordToggle" class="toggle">lihat</button>
     <input
          id="password"
          name="password"
          type="password"
          placeholder="Masukkan password" 

          required>
          
   

     <button type="submit" class="submit">Masuk Ke Aplikasi</button>

     <p class="footer">
          Belum memiliki hak akses? <a href="#">Hubungi Admin</a>
     </p>
     </form>

     <script>
          const password = document.getElementById("password");
          const tombol = document.getElementById("passwordToggle");

          tombol.addEventListener("click", function() {
               if (password.type === "password") {
                    password.type = "text";
                    tombol.textContent = "SEMBUNYI";
               } else {
                    password.type = "password";
                    tombol.textContent = "LIHAT";
               }
          });
     </script>

</body>

</html>