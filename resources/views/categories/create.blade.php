<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">➕ Tambah Kategori</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <x-input label="Nama Kategori" name="category" placeholder="Contoh: Fiksi" required />
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>