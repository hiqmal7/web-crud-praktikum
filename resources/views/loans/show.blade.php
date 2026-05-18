<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">📋 Detail Peminjaman</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th>NPM</th><td>: {{ $loan->user_npm }}</td></tr>
                        <tr><th>Nama Peminjam</th><td>: {{ $loan->user->first_name }} {{ $loan->user->last_name }}</td></tr>
                        <tr><th>Tanggal Pinjam</th><td>: {{ $loan->loan_at->format('d M Y') }}</td></tr>
                        <tr><th>Batas Kembali</th><td>: {{ $loan->return_at->format('d M Y') }}</td></tr>
                    </table>

                    <h5 class="mt-4">📚 Buku yang Dipinjam</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>Judul Buku</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @foreach($loan->loanDetails as $detail)
                            <tr>
                                <td>{{ $detail->book->title ?? '-' }}</td>
                                <td>
                                    @if($detail->is_return)
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Dikembalikan</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>