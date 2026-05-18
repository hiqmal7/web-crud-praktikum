<x-app-layout>
    <x-slot name="header"><h2 class="fw-bold">✏️ Edit Rak Buku</h2></x-slot>
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('booksheifs.update', $booksheif) }}" method="POST">
                        @csrf @method('PUT')
                        <x-input label="Kode Rak" name="code" :value="$booksheif->code" required />
                        <x-input label="Nama Rak" name="name" :value="$booksheif->name" required />
                        <button class="btn btn-warning">📝 Update</button>
                        <a href="{{ route('booksheifs.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>