<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Detail Peminjaman</h2>
    <table>
        <thead>
            <tr><th>No</th><th>NPM</th><th>Buku</th><th>Status</th><th>Denda</th></tr>
        </thead>
        <tbody>
            @foreach($loanDetails as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->loan->user_npm ?? '-' }}</td>
                <td>{{ $detail->book->title ?? '-' }}</td>
                <td>{{ $detail->is_return ? 'Dikembalikan' : 'Dipinjam' }}</td>
                <td>{{ $detail->return ? 'Rp '.number_format($detail->return->amount,0,',','.') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>