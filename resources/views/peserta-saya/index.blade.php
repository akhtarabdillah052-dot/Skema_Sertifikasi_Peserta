<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta Saya</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f3f4f6;
            min-height: 100vh;
            padding: 40px 20px;
            color: #111;
        }

        .container {
            max-width: 650px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        header .hello {
            font-size: 14px;
        }

        header button {
            padding: 7px 14px;
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
            margin-bottom: 8px;
        }

        h2 {
            font-size: 17px;
            margin-bottom: 12px;
        }

        .subtitle {
            font-size: 14px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 16px;
            margin-bottom: 6px;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button.submit {
            margin-top: 20px;
            padding: 11px 18px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
            line-height: 1.5;
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert.err,
        .error-list {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .error-list {
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .error-list p+p {
            margin-top: 6px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        .detail-table th,
        .detail-table td {
            text-align: left;
            padding: 11px 8px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .detail-table th {
            width: 125px;
            color: #666;
            font-weight: normal;
        }

        .section {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #ddd;
        }

        .document {
            padding: 13px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            line-height: 1.6;
        }

        .document-name {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .uploaded {
            color: #047857;
        }

        .missing {
            color: #b91c1c;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: #fef3c7;
            color: #92400e;
            font-size: 12px;
        }

        .status.diterima {
            background: #dcfce7;
            color: #166534;
        }

        .status.ditolak {
            background: #fee2e2;
            color: #991b1b;
        }

        .note {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 12px;
            }

            .card {
                padding: 20px 16px;
            }

            .detail-table th {
                width: 95px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <header>
            <div class="hello">
                Halo,
                <b>{{ Auth::user()->name ?? Auth::user()->email }}</b>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </header>

        <div class="card">

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert err">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-list">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if ($peserta)
                <h1>Data Pendaftaran Anda</h1>
                <p class="subtitle">
                    Berikut adalah data pendaftaran sertifikasi Anda.
                </p>

                <table class="detail-table">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $peserta->nama_peserta }}</td>
                    </tr>
                    <tr>
                        <th>Skema</th>
                        <td>
                            @if ($peserta->skema)
                                {{ $peserta->skema->kode_skema }}
                                - {{ $peserta->skema->nama_skema }}
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

                @php
                    $dokumen = $peserta->dokumen;
                @endphp

                <div class="section">
                    <h1>Pelengkapan Dokumen</h1>

                    <p class="subtitle">
                        Unggah KTP, ijazah, dan sertifikat. Format yang diterima
                        JPG, JPEG, PNG, atau PDF. Ukuran maksimal 2 MB per file.
                        File yang sudah pernah diunggah boleh dibiarkan kosong
                        jika tidak ingin menggantinya.
                    </p>

                    <div class="document">
                        <div class="document-name">KTP</div>

                        @if ($dokumen && $dokumen->ktp_path)
                            <div class="uploaded">✓ KTP sudah diunggah</div>
                        @else
                            <div class="missing">Belum mengunggah KTP</div>
                        @endif
                    </div>

                    <div class="document">
                        <div class="document-name">Ijazah</div>

                        @if ($dokumen && $dokumen->ijazah_path)
                            <div class="uploaded">✓ Ijazah sudah diunggah</div>
                        @else
                            <div class="missing">Belum mengunggah ijazah</div>
                        @endif
                    </div>

                    <div class="document">
                        <div class="document-name">Sertifikat</div>

                        @if ($dokumen && $dokumen->sertifikat_path)
                            <div class="uploaded">✓ Sertifikat sudah diunggah</div>
                        @else
                            <div class="missing">Belum mengunggah sertifikat</div>
                        @endif
                    </div>

                    <div style="margin-top: 18px;">
                        <div style="font-size:14px; margin-bottom:8px;">
                            Status verifikasi:
                        </div>

                        @if ($dokumen && $dokumen->status)
                            @php
                                $status = $dokumen->status;
                                $statusClass = match ($status) {
                                    'diterima' => 'diterima',
                                    'ditolak' => 'ditolak',
                                    default => '',
                                };
                            @endphp

                            <span class="status {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        @else
                            <span class="status">Belum dikonfirmasi admin</span>
                        @endif
                    </div>

                    <form action="{{ route('peserta-saya.dokumen.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @if (!$dokumen || !$dokumen->ktp_path || !$dokumen->ijazah_path || !$dokumen->sertifikat_path)
                            <form action="{{ route('peserta-saya.dokumen.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @if (!$dokumen || !$dokumen->ktp_path)
                                    <label for="ktp">Upload KTP</label>
                                    <input type="file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf"
                                        required>
                                @endif

                                @if (!$dokumen || !$dokumen->ijazah_path)
                                    <label for="ijazah">Upload Ijazah</label>
                                    <input type="file" id="ijazah" name="ijazah" accept=".jpg,.jpeg,.png,.pdf"
                                        required>
                                @endif

                                @if (!$dokumen || !$dokumen->sertifikat_path)
                                    <label for="sertifikat">Upload Sertifikat</label>
                                    <input type="file" id="sertifikat" name="sertifikat"
                                        accept=".jpg,.jpeg,.png,.pdf" required>
                                @endif

                                <p class="note">
                                    Lengkapi dokumen yang belum diunggah. Setelah semua dokumen
                                    diunggah, form ini akan hilang.
                                </p>

                                <button type="submit" class="submit">
                                    Upload Dokumen
                                </button>
                            </form>
                        @else
                            <div class="alert">
                                Semua dokumen berhasil diunggah. Silakan menunggu konfirmasi admin.
                            </div>
                        @endif

                    </form>
                </div>
            @else
                <h1>Form Pendaftaran Peserta</h1>

                <p class="subtitle">
                    Isi data di bawah untuk mendaftar sebagai peserta sertifikasi.
                </p>

                <form action="{{ route('peserta-saya.store') }}" method="POST">
                    @csrf

                    <label for="skema_id">Pilih Skema Sertifikasi</label>
                    <select id="skema_id" name="skema_id" required>
                        <option value="">-- Pilih Skema --</option>

                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                                {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>

                    <label for="nama_peserta">Nama Lengkap</label>
                    <input type="text" id="nama_peserta" name="nama_peserta"
                        value="{{ old('nama_peserta', Auth::user()->name) }}" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        required>

                    <label for="no_hp">No. HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>

                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>

                    <button type="submit" class="submit">
                        Daftar Sekarang
                    </button>
                </form>
            @endif

        </div>
    </div>
</body>

</html>
