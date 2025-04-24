<div>
    <h1>Daftar Buku</h1>

    <!-- Menampilkan pesan sukses/gagal -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Tampilkan daftar buku -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>
                        <button wire:click="edit({{ $item->id }})" class="btn btn-warning">Edit</button>
                        <button wire:click="delete({{ $item->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Form untuk menambah buku -->
    <div class="mt-4">
        <h2>Tambah Buku</h2>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <label for="judul">Judul Buku</label>
                <input type="text" id="judul" wire:model="judul" class="form-control">
                @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" id="pengarang" wire:model="pengarang" class="form-control">
                @error('pengarang') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="number" id="tahun_terbit" wire:model="tahun_terbit" class="form-control">
                @error('tahun_terbit') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
