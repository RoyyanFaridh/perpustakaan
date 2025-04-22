<div>
    <h1>Broadcast</h1>
    <table class="table">
        <thead><tr><th>Judul</th><th>Isi</th></tr></thead>
        <tbody>
            @foreach($broadcast as $item)
                <tr><td>{{ $item->judul }}</td><td>{{ $item->isi }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <form wire:submit.prevent="store">
        <input type="text" wire:model="judul" placeholder="Judul">
        <textarea wire:model="isi" placeholder="Isi Pesan"></textarea>
        <button type="submit">Kirim</button>
    </form>
</div>
