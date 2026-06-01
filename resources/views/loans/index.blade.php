<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">📋 Daftar Peminjaman</h2>
            <a href="{{ route('loans.create') }}" class="btn btn-primary">+ Tambah Peminjaman</a>
            <a href="{{ route('loans.print-pdf') }}" class="btn btn-danger" target="_blank">🖨️ Cetak PDF</a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NPM</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                    <th width="180">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loans as $index => $loan)
                                @php
                                    $allReturned = $loan->loanDetails->every(fn($d) => $d->is_return);
                                    $overdue = !$allReturned && now()->gt($loan->return_at);
                                @endphp
                                <tr>
                                    <td>{{ $loans->firstItem() + $index }}</td>
                                    <td>{{ $loan->user_npm }}</td>
                                    <td>{{ $loan->user->first_name ?? '' }} {{ $loan->user->last_name ?? '' }}</td>
                                    <td>{{ $loan->loan_at->format('d M Y') }}</td>
                                    <td>{{ $loan->return_at->format('d M Y') }}</td>
                                    <td>
                                        @if($allReturned)
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($overdue)
                                            <span class="badge bg-danger">Terlambat</span>
                                        @else
                                            <span class="badge bg-warning">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-info">👁️ Detail</a>
                                        <a href="{{ route('loans.edit', $loan) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                        <form action="{{ route('loans.destroy', $loan) }}" method="POST" style="display:inline"
                                              onsubmit="return confirm('Hapus peminjaman ini? Pastikan semua buku sudah dikembalikan.')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data peminjaman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $loans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>