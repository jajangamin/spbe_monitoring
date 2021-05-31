<form action="{{ route('backend.master.kategoricreate') }}" method="post">
    @csrf

    <div class="form-group">
        <label>Kategori Aplikasi*</label>
        <input type="text" id="nama_kategori" name="nama_kategori" placeholder="minimal 3 karakter huruf" class="form-control" required>
    </div>

    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
</form>
