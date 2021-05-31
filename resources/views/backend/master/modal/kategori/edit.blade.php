<form action="{{ route('backend.master.kategoriedit') }}" method="post" >
    @csrf
    <input type="hidden" id="idkategori" name="idkategori" value="{{ $kategori->id }}">


    <div class="form-group">
        <label>Nama Kategori*</label>
        <input type="text" id="nama_kategori" name="nama_kategori" placeholder="minimal 3 karakter huruf"
               value="{{ $kategori->nama_kategori }}" class="form-control" required>
    </div>

    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
</form>
