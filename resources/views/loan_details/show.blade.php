<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">📑 Detail Peminjaman</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>NPM Peminjam</th><td>: {{ $loanDetail->loan->user_npm ?? '-' }}</td></tr>
                        <tr><th>Nama Peminjam</th><td>: {{ $loanDetail->loan->user->first_name ?? '' }} {{ $loanDetail->loan->user->last_name ?? '' }}</td></tr>
                        <tr><th>Judul Buku</th><td>: {{ $loanDetail->book->title ?? '-' }}</td></tr>
                        <tr><th>Status</th><td>: {!! $loanDetail->is_return ? '<span class="badge bg-success">Dikembalikan</span>' : '<span class="badge bg-warning text-dark">Dipinjam</span>' !!}</td></tr>
                    </table>
                    <a href="{{ route('loan_details.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>