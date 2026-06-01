<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Daftar Buku</h2>
    <table>
        <thead>
            <tr><th>No</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Penerbit</th><th>Kota</th><th>Rak</th></tr>
        </thead>
        <tbody>
            @foreach($books as $i => $b)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $b->title }}</td>
                <td>{{ $b->author }}</td>
                <td>{{ $b->year }}</td>
                <td>{{ $b->publisher }}</td>
                <td>{{ $b->city }}</td>
                <td>{{ $b->bookshelf->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>