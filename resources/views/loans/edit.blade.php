<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">✏️ Edit Peminjaman</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('loans.update', $loan) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <x-select label="Peminjam (NPM)" name="user_npm" :options="$users" optionValue="npm" optionLabel="npm" :value="$loan->user_npm" required />
                            </div>
                            <div class="col-md-3">
                                <x-input label="Tanggal Pinjam" name="loan_at" type="date" :value="$loan->loan_at->format('Y-m-d')" required />
                            </div>
                            <div class="col-md-3">
                                <x-input label="Batas Kembali" name="return_at" type="date" :value="$loan->return_at->format('Y-m-d')" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">📝 Update</button>
                        <a href="{{ route('loans.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>