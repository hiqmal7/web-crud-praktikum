<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">✏️ Edit Buku</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <x-input label="Judul Buku" name="title" :value="$book->title" required />
                            </div>
                            <div class="col-md-6">
                                <x-input label="Penulis" name="author" :value="$book->author" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <x-input label="Tahun Terbit" name="year" type="number" :value="$book->year" required />
                            </div>
                            <div class="col-md-4">
                                <x-input label="Penerbit" name="publisher" :value="$book->publisher" required />
                            </div>
                            <div class="col-md-4">
                                <x-input label="Kota Terbit" name="city" :value="$book->city" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <x-input label="URL Cover" name="cover" :value="$book->cover" />
                            </div>
                            <div class="col-md-6">
                                <x-select label="Rak Buku" name="bookshelf_id" :options="$booksheifs" optionLabel="name" :value="$book->bookshelf_id" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">📝 Update</button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>