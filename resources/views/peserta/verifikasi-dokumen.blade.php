<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Dokumen - Sertifikasi BNSP</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: #f3f4f6;
            color: #111;
        }

        .sidebar {
            width: 220px;
            background: #111;
            color: white;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .menu a {
            padding: 10px 12px;
            font-size: 13px;
            color: #bbb;
            text-decoration: none;
            border-radius: 6px;
        }

        .menu a:hover,
        .menu a.active {
            background: #222;
            color: white;
        }

        .content {
            flex: 1;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 28px;
            background: white;
            border-bottom: 1px solid #ddd;
        }

        .topbar button {
            padding: 7px 14px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }

        .page {
            padding: 28px;
        }

        h1 {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .description {
            font-size: 14px;
            color: #666;
            margin-bottom: 24px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .table-wrap {
            overflow-x: auto;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        th {
            background: #fafafa;
            color: #555;
        }

        .document-link {
            display: inline-block;
            color: #1d4ed8;
            margin: 3px 0;
            text-decoration: none;
        }

        .document-link:hover {
            text-decoration: underline;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 5px;
            background: #fef3c7;
            color: #92400e;
            font-size: 12px;
            white-space: nowrap;
        }

        .status.diterima {
            background: #dcfce7;
            color: #166534;
        }

        .status.ditolak {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions form {
            margin-bottom: 6px;
        }

        .actions button {
            width: 110px;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .approve {
            background: #15803d;
        }

        .reject {
            background: #b91c1c;
        }

        .empty {
            padding: 30px;
            text-align: center;
            color: #666;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 16px;
            }

            .menu {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .topbar {
                padding: 16px;
            }

            .page {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">SERTIFIKASI BNSP</div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('skema.index') }}">Skema Sertifikasi</a>
            <a href="{{ route('peserta.index') }}">Data Peserta</a>
            <a href="{{ route('admin.dokumen.index') }}" class="active">
                Verifikasi Dokumen
            </a>
        </nav>
    </aside>

    <div class="content">

        <header class="topbar">
            <div>
                Halo, <b>{{ Auth::user()->name ?? (Auth::user()->email ?? 'Admin') }}</b>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </header>

        <main class="page">
            <h1>Verifikasi Dokumen</h1>

            <p class="description">
                Periksa dokumen peserta dan tentukan hasil verifikasinya.
            </p>

            @if (session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert error">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Dokumen KTP</th>
                            <th>Dokumen Ijazah</th>
                            <th>Dokumen Sertifikat</th>
                            <th>Status</th>
                            <th>Keputusan Admin</th>
                        </tr>
                    </thead>


<tbody>
    @forelse ($dokumens as $dokumen)
        @php
            $status = $dokumen->status ?? 'menunggu konfirmasi';

            $statusClass = match ($status) {
                'diterima' => 'diterima',
                'ditolak' => 'ditolak',
                default => '',
            };
        @endphp

        <tr>
            <td>
                <strong>
                    {{ $dokumen->peserta->nama_peserta ?? 'Peserta tidak ditemukan' }}
                </strong>
            </td>

            <td>
                @if ($dokumen->ktp_path)
                    <a class="document-link"
                       href="{{ route('admin.dokumen.file', [
                           'dokumen' => $dokumen->id,
                           'jenis' => 'ktp',
                       ]) }}"
                       target="_blank"
                       rel="noopener noreferrer">
                        Lihat KTP
                    </a>
                @else
                    Belum diunggah
                @endif
            </td>

            <td>
                @if ($dokumen->ijazah_path)
                    <a class="document-link"
                       href="{{ route('admin.dokumen.file', [
                           'dokumen' => $dokumen->id,
                           'jenis' => 'ijazah',
                       ]) }}"
                       target="_blank"
                       rel="noopener noreferrer">
                        Lihat Ijazah
                    </a>
                @else
                    Belum diunggah
                @endif
            </td>

            <td>
                @if ($dokumen->sertifikat_path)
                    <a class="document-link"
                       href="{{ route('admin.dokumen.file', [
                           'dokumen' => $dokumen->id,
                           'jenis' => 'sertifikat',
                       ]) }}"
                       target="_blank"
                       rel="noopener noreferrer">
                        Lihat Sertifikat
                    </a>
                @else
                    Belum diunggah
                @endif
            </td>

            <td>
                <span class="status {{ $statusClass }}">
                    {{ ucfirst($status) }}
                </span>
            </td>

            <td class="actions">
                @if ($status === 'menunggu konfirmasi')
                    <form action="{{ route('admin.dokumen.status', $dokumen->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin menerima dokumen ini?')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="diterima">
                        <button type="submit" class="approve">Konfirmasi</button>
                    </form>

                    <form action="{{ route('admin.dokumen.status', $dokumen->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin menolak dokumen ini?')">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="reject">Tolak</button>
                    </form>
                @else
                    <span style="color:#666">Sudah diverifikasi</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="empty">
                Belum ada dokumen yang diunggah peserta.
            </td>
        </tr>
    @endforelse
</tbody>

                </table>
            </div>
        </main>
    </div>

</body>

</html>
