<div>
    <h1>Peminjaman</h1>
    <table class="table">
        <thead>
            <tr><th>Anggota ID</th><th>Buku ID</th><th>Tanggal Pinjam</th><th>Kembali</th></tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $item)
                <tr>
                    <td>{{ $item->anggota_id }}</td>
                    <td>{{ $item->buku_id }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form wire:submit.prevent="store">
        <input type="number" wire:model="anggota_id" placeholder="Anggota ID">
        <input type="number" wire:model="buku_id" placeholder="Buku ID">
        <input type="date" wire:model="tanggal_pinjam">
        <input type="date" wire:model="tanggal_kembali">
        <button type="submit">Pinjam</button>
    </form>
</div>
