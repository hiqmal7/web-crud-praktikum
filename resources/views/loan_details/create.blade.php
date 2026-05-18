<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">➕ Tambah Detail Peminjaman</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('loan_details.store') }}" method="POST">
                        @csrf
                        <x-select label="Peminjaman (NPM)" name="loan_id" :options="$loans" optionLabel="user_npm" required />
                        <x-select label="Buku" name="book_id" :options="$books" optionLabel="title" required />
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('loan_details.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>