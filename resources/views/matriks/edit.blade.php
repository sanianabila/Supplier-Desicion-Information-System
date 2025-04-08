<form action="{{ route('matriks.update', $decisionMatrix->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="alternative_id">Edit Alternatif:</label>
        <select name="alternative_id" required>
            @foreach ($availableAlternatives as $availableAlternative)
                <option value="{{ $availableAlternative->id }}" 
                    {{ $decisionMatrix->alternative_id === $availableAlternative->id ? 'selected' : '' }}>
                    {{ $availableAlternative->supplier->nama_supplier }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Update</button>
</form>
