<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5>Total Buku</h5>
                            <h3>{{ $totalBooks ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5>Total User</h5>
                            <h3>{{ $totalUsers ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5>Pinjaman Aktif</h5>
                            <h3>{{ $activeLoans ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5>Buku Dipinjam</h5>
                            <h3>{{ $borrowedBooks ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5>Total Pengembalian</h5>
                            <h3>{{ $totalReturns ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-dark">
                        <div class="card-body">
                            <h5>Total Denda</h5>
                            <h3>Rp {{ number_format($totalFines ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>