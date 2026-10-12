<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Skema Sertifikasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #eef1f6;
            color: #333;
        }

        header,
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 15px 30px;
            background: #0f172a;
            color: #fff;
        }

        .container,
        main {
            width: 92%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .card,
        .login-box {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .08);
            margin-bottom: 20px;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        p {
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .btn,
        button {
            padding: 10px 16px;
            color: #fff;
            background: #0f172a;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-secondary {
            background: #64748b;
        }

        .btn-light {
            background: #fff;
            color: #0f172a;
            border: 1px solid #ccc;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
        }

        .btn-info {
            background: #0ea5e9;
        }

        .actions,
        .aksi,
        .header-buttons,
        .button-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .alert {
            background: #fef2f2;
            color: #991b1b;
            padding: 12px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #0f172a;
            color: #fff;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .dark {
            background: #0f172a;
            color: #fff;
        }

        .gray {
            background: #64748b;
            color: #fff;
        }

        .card .number {
            font-size: 38px;
            font-weight: bold;
            margin: 15px 0;
        }

        body.login {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #0f172a;
        }
    </style>
    ```

</head>

<body>

    ```
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-title">
            Sistem Sertifikasi
        </div>

        <div class="navbar-subtitle">
            Manajemen Skema Sertifikasi
        </div>
    </div>


    <!-- Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="page-header">

            <div>
                <h1>Edit Skema Sertifikasi</h1>

                <p>
                    Perbarui informasi skema sertifikasi.
                </p>
            </div>

            <a href="{{ route('skema.index') }}"
                class="btn btn-back">
                ← Kembali
            </a>

        </div>


        <!-- Card -->
        <div class="card">

            <div class="card-header">
                <h2>Form Edit Skema</h2>
            </div>


            <div class="card-body">

                {{-- Alert Error --}}
                @if(session('error'))

                <div class="alert alert-danger">

                    <span>
                        {{ session('error') }}
                    </span>

                    <button type="button"
                        class="close-alert"
                        onclick="this.parentElement.remove()">
                        &times;
                    </button>

                </div>

                @endif


                <!-- Form -->
                <form action="{{ route('skema.update', $skema->id) }}"
                    method="POST">

                    @csrf

                    @method('PUT')


                    <!-- Kode Skema -->
                    <div class="form-group">

                        <label for="kode_skema"
                            class="form-label">
                            Kode Skema
                        </label>

                        <input type="text"
                            name="kode_skema"
                            id="kode_skema"
                            class="form-control @error('kode_skema') is-invalid @enderror"
                            value="{{ old('kode_skema', $skema->kode_skema) }}"
                            required>

                        @error('kode_skema')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <!-- Nama Skema -->
                    <div class="form-group">

                        <label for="nama_skema"
                            class="form-label">
                            Nama Skema Sertifikasi
                        </label>

                        <input type="text"
                            name="nama_skema"
                            id="nama_skema"
                            class="form-control @error('nama_skema') is-invalid @enderror"
                            value="{{ old('nama_skema', $skema->nama_skema) }}"
                            required>

                        @error('nama_skema')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <!-- Jenis Skema -->
                    <div class="form-group">

                        <label for="jenis"
                            class="form-label">
                            Jenis Skema
                        </label>

                        <select name="jenis"
                            id="jenis"
                            class="form-select @error('jenis') is-invalid @enderror"
                            required>

                            <option value="">
                                -- Pilih Jenis --
                            </option>

                            <option value="KKNI"
                                {{ old('jenis', $skema->jenis) == 'KKNI' ? 'selected' : '' }}>
                                KKNI
                            </option>

                            <option value="Klaster"
                                {{ old('jenis', $skema->jenis) == 'Klaster' ? 'selected' : '' }}>
                                Klaster
                            </option>

                            <option value="Okupasi"
                                {{ old('jenis', $skema->jenis) == 'Okupasi' ? 'selected' : '' }}>
                                Okupasi
                            </option>

                        </select>


                        @error('jenis')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <!-- Jumlah Unit -->
                    <div class="form-group">

                        <label for="jumlah_unit"
                            class="form-label">
                            Jumlah Unit Kompetensi
                        </label>

                        <input type="number"
                            name="jumlah_unit"
                            id="jumlah_unit"
                            class="form-control @error('jumlah_unit') is-invalid @enderror"
                            value="{{ old('jumlah_unit', $skema->jumlah_unit) }}"
                            min="1"
                            required>

                        @error('jumlah_unit')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror

                    </div>


                    <!-- Tombol -->
                    <div class="actions">

                        <button type="submit"
                            class="btn btn-primary">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('skema.index') }}"
                            class="btn btn-secondary">
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>


        <!-- Footer -->
        <div class="footer">
            Sistem Manajemen Skema Sertifikasi
        </div>

    </div>

</body>

</html>