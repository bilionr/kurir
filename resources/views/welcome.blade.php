<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Plat Kendaraan</th>
            <th>Level</th>
            <th>Waktu Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kurirs as $kurir)
        <tr>
            <td>{{ $kurir->id }}</td>
            <td>{{ $kurir->nama }}</td>
            <td>{{ $kurir->no_telp }}</td>
            <td>{{ $kurir->plat_kendaraan }}</td>
            <td>{{ $kurir->level }}</td>
            <td>{{ $kurir->created_at }}</td>
            <td>
                <!-- Tombol Edit -->
                <a href="{{ url('/kurirs/'.$kurir->id.'/edit') }}">Edit</a>

                <!-- Tombol Delete (menggunakan Form karena method DELETE) -->
                <form action="{{ url('/kurirs/'.$kurir->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>