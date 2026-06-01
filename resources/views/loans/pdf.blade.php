<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Peminjaman</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>No</th><th>NPM</th><th>Nama Peminjam</th>
                <th>Tgl Pinjam</th><th>Batas Kembali</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $index => $loan)
            @php
                $allReturned = $loan->loanDetails->every(fn($d) => $d->is_return);
                $overdue = !$allReturned && now()->gt($loan->return_at);
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $loan->user_npm }}</td>
                <td>{{ $loan->user->first_name ?? '' }} {{ $loan->user->last_name ?? '' }}</td>
                <td>{{ $loan->loan_at->format('d M Y') }}</td>
                <td>{{ $loan->return_at->format('d M Y') }}</td>
                <td>
                    @if($allReturned) Selesai
                    @elseif($overdue) Terlambat
                    @else Dipinjam
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>