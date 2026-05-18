<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">➕ Tambah Pengembalian</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('returns.store') }}" method="POST">
                        @csrf
                        <x-select label="Detail Peminjaman (Buku)" name="loan_detail_id" :options="$loanDetails" optionLabel="book.title" placeholder="-- Pilih detail peminjaman --" required />
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Apakah ada denda?</label>
                            <select name="charge" id="charge" class="form-select" required>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <x-input label="Jumlah Denda (Rp)" name="amount" type="number" value="0" min="0" />
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <a href="{{ route('returns.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>