<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">✏️ Edit Detail Peminjaman</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('loan_details.update', $loanDetail) }}" method="POST">
                        @csrf @method('PUT')
                        <x-select label="Peminjaman" name="loan_id" :options="$loans" optionLabel="user_npm" :value="$loanDetail->loan_id" required />
                        <x-select label="Buku" name="book_id" :options="$books" optionLabel="title" :value="$loanDetail->book_id" required />
                        <button type="submit" class="btn btn-warning">📝 Update</button>
                        <a href="{{ route('loan_details.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>