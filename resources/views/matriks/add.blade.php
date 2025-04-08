<form action="{{ route('matriks.store') }}" method="POST" style="margin-bottom: 20px;">
    @csrf

    <div>
        <label for="alternative_id">Pilih Alternatif:</label>
        <select name="alternative_id" required>
            <option value="" disabled selected>Pilih Alternatif</option>
            @foreach ($availableAlternatives as $alternative)
                <option value="{{ $alternative->id }}">
                    A{{ $loop->iteration }} - {{ $alternative->supplier->nama_supplier }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Tambah</button>
</form>
