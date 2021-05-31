<form action="{{ route('backend.master.doktercreate') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Foto</label>
        <input type="file" id="foto" name="foto" accept="image/x-png,image/jpg,image/jpeg">
    </div>
    <div class="form-group">
        <label>Kode Dokter*</label>
        <input type="text" id="kodedokter" name="kodedokter" placeholder="minimal 3 karakter huruf, angka, dash dan underscore, tidak menerima spasi." class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nama Dokter*</label>
        <input type="text" id="namalengkap" name="namalengkap" placeholder="minimal 3 karakter" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Profesi*</label>
        <select class="form-control" id="idprofesi" name="idprofesi" required>
            <option value="" selected disabled>-- Pilih profesi dokter --</option>
            @foreach ($profesi as $data)
                <option value="{{ $data->id }}">{{ $data->profesiDokter }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Pendidikan*</label>
        <input type="text" id="pendidikan" name="pendidikan" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Pendidikan Non Formal</label>
        <input type="text" id="pendidikan_nonformal" name="pendidikan_nonformal" class="form-control">
    </div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
    </div>
</form>
