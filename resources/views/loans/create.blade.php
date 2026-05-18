<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">➕ Tambah Peminjaman</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-select label="Peminjam (NPM)" name="user_npm" :options="$users" optionValue="npm" optionLabel="npm" required />
                            </div>
                            <div class="col-md-3">
                                <x-input label="Tanggal Pinjam" name="loan_at" type="date" :value="date('Y-m-d')" required />
                            </div>
                            <div class="col-md-3">
                                <x-input label="Batas Kembali" name="return_at" type="date" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Buku yang Dipinjam <span class="text-danger">*</span></label>
                            <div class="row">
                                @foreach($books as $book)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="book_ids[]" value="{{ $book->id }}" id="book_{{ $book->id }}">
                                        <label class="form-check-label" for="book_{{ $book->id }}">
                                            {{ $book->title }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('book_ids')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('loans.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>