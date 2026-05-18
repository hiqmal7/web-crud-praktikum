<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">✏️ Edit Pengembalian</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('returns.update', $return) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Apakah ada denda?</label>
                            <select name="charge" class="form-select" required>
                                <option value="0" {{ !$return->charge ? 'selected' : '' }}>Tidak</option>
                                <option value="1" {{ $return->charge ? 'selected' : '' }}>Ya</option>
                            </select>
                        </div>
                        <x-input label="Jumlah Denda (Rp)" name="amount" type="number" :value="$return->amount" min="0" />
                        <button type="submit" class="btn btn-warning">📝 Update</button>
                        <a href="{{ route('returns.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>