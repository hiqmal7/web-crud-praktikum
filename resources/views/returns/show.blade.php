<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">💵 Detail Pengembalian</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>NPM Peminjam</th><td>: {{ $return->loanDetail->loan->user_npm ?? '-' }}</td></tr>
                        <tr><th>Nama Peminjam</th><td>: {{ $return->loanDetail->loan->user->first_name ?? '' }} {{ $return->loanDetail->loan->user->last_name ?? '' }}</td></tr>
                        <tr><th>Judul Buku</th><td>: {{ $return->loanDetail->book->title ?? '-' }}</td></tr>
                        <tr><th>Denda</th><td>: {{ $return->charge ? 'Ya' : 'Tidak' }}</td></tr>
                        <tr><th>Jumlah</th><td>: Rp {{ number_format($return->amount,0,',','.') }}</td></tr>
                    </table>
                    <a href="{{ route('returns.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>