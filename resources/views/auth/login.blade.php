<!DOCTYPE html>
<html lang="id">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
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

          <h1>Masuk</h1>

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
               <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus>

               <label for="password">Password</label>
               <input
                    id="password"
                    name="password"
                    type="password"
                    required>

               <button type="submit">Masuk</button>
          </form>

          <p class="link">
               Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
          </p>

     </div>

</body>
</html>
