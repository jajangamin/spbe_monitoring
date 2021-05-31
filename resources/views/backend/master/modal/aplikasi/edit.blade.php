<form action="{{ route('backend.master.aplikasiedit') }}" method="post" >
    @csrf
    <input type="hidden" id="idaplikasi" name="idaplikasi" value="{{ $aplikasi->id }}">


    <div class="form-group">
        <label>Nama Aplikasi*</label>
        <input type="text" id="nama_aplikasi" name="nama_aplikasi" placeholder="minimal 3 karakter huruf"
               value="{{ $aplikasi->nama_aplikasi }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Link</label>
        <input type="text" id="link" name="link"  value="{{ $aplikasi->link }}" class="form-control" >
    </div>



    <div class="form-group">
        <label>Unit Kerja*</label>
        <select class="form-control m-b" id="idunit" name="idunit" required>
            @foreach ($unit as $data => $value)
                <option value="{{ $value->id }}" {{ $value->id == $aplikasi->idunit ? 'selected' : '' }}>{{  $value->nama_unit }}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Jenis Aplikasi*</label>
        <select class="form-control m-b" id="idjenis" name="idjenis" required>
            @foreach ($jenis as $data => $value)
                <option value="{{ $value->id }}" {{ $value->id == $aplikasi->idjenis ? 'selected' : '' }}>{{  $value->nama_jenis }}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Lokasi Server*</label>
        <select class="form-control m-b" id="namaserver" name="namaserver" required>
            @foreach ($server as $data => $value)
                <option value="{{ $value->server }}" {{ $value->server == $aplikasi->server ? 'selected' : '' }}>{{  $value->server }}</option>

            @endforeach
        </select>
    </div>


    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
</form>
