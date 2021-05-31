<form action="{{ route('backend.master.unitcreate') }}" method="post">
    @csrf

    <div class="form-group">
        <label>Unit Kerja*</label>
        <input type="text" id="nama_unit" name="nama_unit" placeholder="minimal 3 karakter huruf" class="form-control" required>
    </div>

    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
</form>
