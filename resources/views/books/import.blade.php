<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">📥 Import Buku dari Excel</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('books.import-excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih file Excel (.xlsx, .xls, .csv)</label>
                            <input type="file" name="file" class="form-control" required>
                            @error('file')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">
                                Format kolom: <strong>judul, penulis, tahun, penerbit, kota, cover_url (opsional), bookshelf_id</strong>
                            </small>
                        </div>
                        <button type="submit" class="btn btn-primary">📥 Import</button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>