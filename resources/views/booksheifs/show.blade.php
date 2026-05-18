<x-app-layout>
    <x-slot name="header"><h2 class="fw-bold">🗄️ Detail Rak</h2></x-slot>
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $booksheif->name }} ({{ $booksheif->code }})</h5>
                    <hr>
                    <h6>📚 Buku di Rak Ini ({{ $booksheif->books->count() }})</h6>
                    <ul class="list-group">
                        @foreach($booksheif->books as $book)
                            <li class="list-group-item">{{ $book->title }} - {{ $book->author }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booksheifs.index') }}" class="btn btn-secondary mt-3">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>