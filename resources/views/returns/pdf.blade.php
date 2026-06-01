<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengembalian</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Pengembalian</h2>
    <table>
        <thead>
            <tr><th>No</th><th>NPM</th><th>Buku</th><th>Denda</th><th>Jumlah</th></tr>
        </thead>
        <tbody>
            @foreach($returns as $index => $ret)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ret->loanDetail->loan->user_npm ?? '-' }}</td>
                <td>{{ $ret->loanDetail->book->title ?? '-' }}</td>
                <td>{{ $ret->charge ? 'Ya' : 'Tidak' }}</td>
                <td>Rp {{ number_format($ret->amount,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>