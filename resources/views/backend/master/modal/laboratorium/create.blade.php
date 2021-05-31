<form action="{{ route('backend.master.labcreate') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Foto</label>
        <input type="file" id="foto" name="foto" accept="image/x-png,image/jpg,image/jpeg">
    </div>
    <div class="form-group">
        <label>Kode Lab*</label>
        <input type="text" id="kodelab" name="kodelab" placeholder="minimal 3 karakter huruf, angka, dash dan underscore, tidak menerima spasi." class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nama Lab*</label>
        <input type="text" id="nama" name="nama" placeholder="minimal 3 karakter" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Keterangan*</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
    </div>
    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
</form>
