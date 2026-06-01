<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Kategori</h2>
    <table>
        <thead><tr><th>No</th><th>Nama Kategori</th></tr></thead>
        <tbody>
            @foreach($categories as $index => $cat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $cat->category }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>