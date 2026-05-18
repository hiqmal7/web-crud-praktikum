<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">➕ Tambah Buku</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-input label="Judul Buku" name="title" required />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Penulis" name="author" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <x-input label="Tahun Terbit" name="year" type="number" required />
                            </div>
                            <div class="col-md-4">
                                <x-input label="Penerbit" name="publisher" required />
                            </div>
                            <div class="col-md-4">
                                <x-input label="Kota Terbit" name="city" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <x-input label="URL Cover" name="cover" placeholder="https://..." required />
                            </div>
                            <div class="col-md-6">
                                <x-select label="Rak Buku" name="bookshelf_id" :options="$booksheifs" optionLabel="name" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>