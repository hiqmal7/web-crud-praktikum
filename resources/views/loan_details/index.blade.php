<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">📑 Detail Peminjaman</h2>
            <a href="{{ route('loan_details.create') }}" class="btn btn-primary">+ Tambah Detail</a>
            <a href="{{ route('loan_details.print-pdf') }}" class="btn btn-danger" target="_blank">🖨️ Cetak PDF</a>
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
                                    <th>Status</th>
                                    <th>Denda</th>
                                    <th width="240">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loanDetails as $index => $detail)
                                <tr>
                                    <td>{{ $loanDetails->firstItem() + $index }}</td>
                                    <td>{{ $detail->loan->user_npm ?? '-' }}</td>
                                    <td>{{ $detail->book->title ?? '-' }}</td>
                                    <td>
                                        @if($detail->is_return)
                                            <span class="badge bg-success">Dikembalikan</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $detail->return ? 'Rp '.number_format($detail->return->amount,0,',','.') : '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('loan_details.show', $detail) }}" class="btn btn-sm btn-info">👁️</a>
                                        <a href="{{ route('loan_details.edit', $detail) }}" class="btn btn-sm btn-warning">✏️</a>
                                        <form action="{{ route('loan_details.destroy', $detail) }}" method="POST" style="display:inline"
                                              onsubmit="return confirm('Hapus detail ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">🗑️</button>
                                        </form>
                                        @if(!$detail->is_return)
                                        <form action="{{ route('loan_details.mark-returned', $detail) }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-success" title="Tandai dikembalikan">✅</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada detail peminjaman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $loanDetails->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>