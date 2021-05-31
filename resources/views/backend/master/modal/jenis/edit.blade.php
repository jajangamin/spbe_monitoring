<form action="{{ route('backend.master.jenisedit') }}" method="post" >
    @csrf
    <input type="hidden" id="idjenis" name="idjenis" value="{{ $jenis->id }}">


    <div class="form-group">
        <label>Nama Kategori*</label>
        <input type="text" id="nama_jenis" name="nama_jenis" placeholder="minimal 3 karakter huruf"
               value="{{ $jenis->nama_jenis }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pilih Kategori*</label>
        <select class="form-control m-b" id="idkategori" name="idkategori">
            @foreach ($kategori as $data => $value)
                <option value="{{ $value->id }}" {{ $value->id == $jenis->idkategori ? 'selected' : '' }}>{{  $value->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
</form>
