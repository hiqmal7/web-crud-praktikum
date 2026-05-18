<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">✏️ Edit Kategori</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf @method('PUT')
                        <x-input label="Nama Kategori" name="category" :value="$category->category" required />
                        <button type="submit" class="btn btn-warning">📝 Update</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>