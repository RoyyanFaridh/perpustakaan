<div>
    <h1>Data Terlambat</h1>
    <table class="table">
        <thead><tr><th>Anggota</th><th>Hari</th><th>Denda</th></tr></thead>
        <tbody>
            @foreach($terlambat as $item)
                <tr>
                    <td>{{ $item->anggota_id }}</td>
                    <td>{{ $item->jumlah_hari }}</td>
                    <td>{{ $item->denda }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form wire:submit.prevent="store">
        <input type="number" wire:model="anggota_id" placeholder="Anggota ID">
        <input type="number" wire:model="jumlah_hari" placeholder="Hari Terlambat">
        <input type="number" step="0.01" wire:model="denda" placeholder="Denda">
        <button type="submit">Simpan</button>
    </form>
</div>
