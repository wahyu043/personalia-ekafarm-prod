<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir Permohonan Cuti</title>
    <style>
        @page {
            margin: 40px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
        }

        p {
            margin: 4px 0;
        }

        hr {
            border: 0;
            border-top: 1px solid #666;
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        td {
            padding: 6px 8px;
            vertical-align: top;
        }

        .label {
            width: 32%;
        }

        .content {
            width: 68%;
        }

        .status-box {
            display: inline-block;
            padding: 2px 6px;
            border: 1px solid #4c6647;
            border-radius: 4px;
            font-size: 11px;
            text-transform: uppercase;
        }

        .paragraph {
            margin-top: 16px;
            line-height: 1.5;
            text-align: justify;
        }

        .box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 16px;
        }

        .sign-table {
            width: 100%;
            margin-top: 60px;
            text-align: center;
        }

        .sign-table td {
            width: 33%;
            vertical-align: top;
        }

        .sign-space {
            margin-top: 48px;
            border-top: 1px solid #000;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <div style="text-align:center; margin-bottom:10px;">
        <h2 style="font-size:16px;">FORMULIR PERMOHONAN CUTI</h2>
        <p><strong>CV. AGRO SUKSES ABADI (EKAFARM)</strong></p>
        <hr>
    </div>

    @php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    $today = Carbon::now()->translatedFormat('d F Y');
    @endphp

    <table>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="content">: {{ $cuti->user->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">NIP</td>
            <td class="content">: {{ $cuti->user->nip ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pengajuan</td>
            <td class="content">: {{ \Carbon\Carbon::parse($cuti->tanggal_pengajuan)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Periode Cuti</td>
            <td class="content">:
                {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d F Y') }}
                s.d.
                {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td class="label">Alasan Cuti</td>
            <td class="content">: {{ $cuti->alasan }}</td>
        </tr>
        @if ($cuti->bukti)
        <tr>
            <td class="label">Lampiran Bukti</td>
            <td class="content">: {{ basename($cuti->bukti) }}</td>
        </tr>
        @endif
        @if ($cuti->pengganti)
        <tr>
            <td class="label">Karyawan Pengganti</td>
            <td class="content">: {{ $cuti->pengganti }}</td>
        </tr>
        @endif
        <tr>
            <td class="label">Status Pengajuan</td>
            <td class="content">:
                <span class="status-box">{{ strtoupper($cuti->status ?? 'Pending') }}</span>
            </td>
        </tr>
    </table>

    {{-- Kotak tanda tangan karyawan pengganti --}}
    @if ($cuti->pengganti)
    <div class="box" style="width:60%; margin-left:0;">
        <p><strong>Karyawan Pengganti:</strong></p>
        <div style="margin-top:48px; border-top:1px solid #000; width:60%;"></div>
        <p>{{ $cuti->pengganti }}</p>
    </div>
    @endif

    {{-- Kotak catatan manajer/SPV (manual) --}}
    <div class="box">
        <p style="text-align:center; font-weight:bold;">Catatan Manajer / SPV</p>
        <div style="height:60px;"></div>
    </div>

    <div class="paragraph">
        Dengan ini saya mengajukan permohonan cuti sebagaimana data tersebut di atas.
        Besar harapan saya permohonan ini dapat disetujui. Atas perhatian dan
        kebijakannya saya ucapkan terima kasih.
    </div>

    <table class="sign-table">
        <tr>
            <td>
                <p><strong>Pemohon</strong></p>
                <div class="sign-space"></div>
                <p>{{ $cuti->user->name ?? '-' }}</p>
            </td>
            <td>
                <p><strong>HR / Personalia</strong></p>
                <div class="sign-space"></div>
                <p>{{ $cuti->ttd_hr ?? '____________________' }}</p>
            </td>
            <td>
                <p><strong>Manajer / SPV</strong></p>
                <div class="sign-space"></div>
                <p>{{ $cuti->ttd_manager ?? '____________________' }}</p>
            </td>
        </tr>
    </table>

</body>

</html>