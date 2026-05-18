<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">📖 Detail Buku</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="{{ $book->cover }}" alt="cover" class="img-fluid rounded mb-3" style="max-height:250px;">
                        </div>
                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr><th>Judul</th><td>: {{ $book->title }}</td></tr>
                                <tr><th>Penulis</th><td>: {{ $book->author }}</td></tr>
                                <tr><th>Tahun</th><td>: {{ $book->year }}</td></tr>
                                <tr><th>Penerbit</th><td>: {{ $book->publisher }}</td></tr>
                                <tr><th>Kota</th><td>: {{ $book->city }}</td></tr>
                                <tr><th>Rak</th><td>: {{ $book->bookshelf->name ?? '-' }} ({{ $book->bookshelf->code ?? '' }})</td></tr>
                            </table>
                        </div>
                    </div>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">✏️ Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>