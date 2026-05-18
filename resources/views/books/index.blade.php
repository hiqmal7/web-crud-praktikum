<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">📚 Daftar Buku</h2>
            <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Tahun</th>
                                    <th>Rak</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $index => $book)
                                <tr>
                                    <td>{{ $books->firstItem() + $index }}</td>
                                    <td>
                                        <img src="{{ $book->cover }}" alt="cover" class="img-thumbnail" style="max-height:70px;">
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->year }}</td>
                                    <td>{{ $book->bookshelf->name ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info" title="Detail">👁️</a>
                                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning" title="Edit">✏️</a>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline"
                                              onsubmit="return confirm('Hapus buku ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Hapus">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data buku.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>