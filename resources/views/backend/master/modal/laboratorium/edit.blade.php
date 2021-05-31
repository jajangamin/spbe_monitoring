<form action="{{ route('backend.master.labedit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="idlab" name="idlab" value="{{ $lab->id }}">
    <input type="hidden" id="fotolama" name="fotolama" value="{{ $lab->foto }}">
    <div class="form-group">
        <label>Foto lama</label>
        <img alt="image" class="img-rounded img-md form-control" src="{{ env('API_PATH').'/uploads/lab/'.$lab->foto }}">
    </div>
    <div class="form-group">
        <label>Foto baru</label>
        <input type="file" id="foto" name="foto" accept="image/x-png,image/jpg,image/jpeg">
    </div>
    <div class="form-group">
        <label>Kode Lab*</label>
        <input type="text" id="kodelab" name="kodelab" placeholder="minimal 3 karakter huruf, angka, dash dan underscore, tidak menerima spasi."
               value="{{ $lab->kodelab }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nama Lab*</label>
        <input type="text" id="nama" name="nama" placeholder="minimal 3 karakter" value="{{ $lab->nama }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Keterangan*</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $lab->keterangan }}</textarea>
    </div>
    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
</form>
