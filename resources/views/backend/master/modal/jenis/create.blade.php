<form action="{{ route('backend.master.jeniscreate') }}" method="post">
    @csrf

    <div class="form-group">
        <label>Jenis Aplikasi*</label>
        <input type="text" id="nama_jenis" name="nama_jenis" placeholder="minimal 3 karakter huruf" class="form-control" required>
    </div>

    <div class="form-group">


    <div class="form-group">
        <label>Pilih Kategori*</label>
        <select class="form-control m-b" id="idkategori" name="idkategori" required>
            @foreach ($kategori as $data => $value)
                <option value="{{ $value->id }}">{{ $value->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
    </div>
</form>
