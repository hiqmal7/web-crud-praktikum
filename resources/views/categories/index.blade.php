<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">🏷️ Daftar Kategori</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
            <a href="{{ route('categories.print-pdf') }}" class="btn btn-danger" target="_blank">🖨️ Cetak PDF</a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="10%">No</th>
                                <th>Nama Kategori</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $index => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $index }}</td>
                                <td>{{ $category->category }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline"
                                          onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada kategori.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>