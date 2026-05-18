<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">💵 Daftar Pengembalian</h2>
            <a href="{{ route('returns.create') }}" class="btn btn-primary">+ Tambah Pengembalian</a>
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
                                    <th>NPM Peminjam</th>
                                    <th>Judul Buku</th>
                                    <th>Denda?</th>
                                    <th>Jumlah Denda</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($returns as $index => $return)
                                <tr>
                                    <td>{{ $returns->firstItem() + $index }}</td>
                                    <td>{{ $return->loanDetail->loan->user_npm ?? '-' }}</td>
                                    <td>{{ $return->loanDetail->book->title ?? '-' }}</td>
                                    <td>{{ $return->charge ? '✅ Ya' : '❌ Tidak' }}</td>
                                    <td>Rp {{ number_format($return->amount,0,',','.') }}</td>
                                    <td>
                                        <a href="{{ route('returns.show', $return) }}" class="btn btn-sm btn-info">👁️</a>
                                        <a href="{{ route('returns.edit', $return) }}" class="btn btn-sm btn-warning">✏️</a>
                                        <form action="{{ route('returns.destroy', $return) }}" method="POST" style="display:inline"
                                              onsubmit="return confirm('Hapus data pengembalian ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">🗑️</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data pengembalian.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $returns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>