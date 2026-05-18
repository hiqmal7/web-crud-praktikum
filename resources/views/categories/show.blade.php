<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">🏷️ Detail Kategori</h2>
    </x-slot>
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $category->category }}</h5>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>