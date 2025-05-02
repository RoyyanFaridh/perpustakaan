<div class="container mt-4">
    <h1 class="mb-4">Daftar Buku</h1>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <input type="text" wire:model="search" placeholder="Cari Buku..." class="form-control w-25">
        <button wire:click="resetForm" class="btn btn-primary">+ Tambah Buku</button>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>ISBN</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>{{ $item->isbn }}</td>
                    <td>
                        <button wire:click="edit({{ $item->id }})" class="btn btn-warning btn-sm">Edit</button>
                        <button wire:click="delete({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Form Tambah/Edit --}}
    <div class="mt-4">
        <h4>{{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}</h4>
        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" wire:model="judul" class="form-control">
                @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" wire:model="kategori" class="form-control">
            </div>
            <div class="form-group">
                <label>Penulis</label>
                <input type="text" wire:model="penulis" class="form-control">
            </div>
            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" wire:model="penerbit" class="form-control">
            </div>
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" wire:model="tahun_terbit" class="form-control">
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" wire:model="isbn" class="form-control">
            </div>
            <button class="btn btn-success mt-2">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
        </form>
    </div>
</div>
