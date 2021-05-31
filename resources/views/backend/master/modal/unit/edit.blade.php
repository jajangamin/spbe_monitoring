<form action="{{ route('backend.master.unitedit') }}" method="post" >
    @csrf
    <input type="hidden" id="idunit" name="idunit" value="{{ $unit->id }}">


    <div class="form-group">
        <label>Nama Kategori*</label>
        <input type="text" id="nama_unit" name="nama_unit" placeholder="minimal 3 karakter huruf"
               value="{{ $unit->nama_unit }}" class="form-control" required>
    </div>

    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
</form>
