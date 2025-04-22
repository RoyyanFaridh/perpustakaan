<div>
    <h1>Daftar Anggota</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggota as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->kelas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <h2>Tambah Anggota</h2>
        <form wire:submit.prevent="store">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" wire:model="nama" class="form-control">
                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" wire:model="alamat" class="form-control">
                @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" wire:model="kelas" class="form-control">
                @error('kelas') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
