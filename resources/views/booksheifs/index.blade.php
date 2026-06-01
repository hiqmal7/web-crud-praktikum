<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">🗄️ Daftar Rak Buku</h2>
            <a href="{{ route('booksheifs.create') }}" class="btn btn-primary">+ Tambah Rak</a>
            <a href="{{ route('booksheifs.print-pdf') }}" class="btn btn-danger" target="_blank">🖨️ Cetak PDF</a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr><th>No</th><th>Kode</th><th>Nama</th><th>Jumlah Buku</th><th width="150">Aksi</th></tr>
                        </thead>
                        <tbody>
                            @forelse($booksheifs as $index => $bs)
                            <tr>
                                <td>{{ $booksheifs->firstItem() + $index }}</td>
                                <td><span class="badge bg-secondary">{{ $bs->code }}</span></td>
                                <td>{{ $bs->name }}</td>
                                <td>{{ $bs->books_count }} buku</td>
                                <td>
                                    <a href="{{ route('booksheifs.show', $bs) }}" class="btn btn-sm btn-info">👁️</a>
                                    <a href="{{ route('booksheifs.edit', $bs) }}" class="btn btn-sm btn-warning">✏️</a>
                                    <form action="{{ route('booksheifs.destroy', $bs) }}" method="POST" style="display:inline"
                                          onsubmit="return confirm('Hapus rak ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center">Belum ada rak buku.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $booksheifs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>