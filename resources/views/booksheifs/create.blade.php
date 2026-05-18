<x-app-layout>
    <x-slot name="header"><h2 class="fw-bold">➕ Tambah Rak Buku</h2></x-slot>
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('booksheifs.store') }}" method="POST">
                        @csrf
                        <x-input label="Kode Rak" name="code" placeholder="A-001" required />
                        <x-input label="Nama Rak" name="name" placeholder="Rak Fiksi" required />
                        <button class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('booksheifs.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>