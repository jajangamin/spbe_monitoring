<form action="{{ route('backend.master.rawatcreate') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Kode Kamar*</label>
        <input type="text" id="kodekamar" name="kodekamar" placeholder="minimal 3 karakter huruf, angka, dash dan underscore, tidak menerima spasi." class="form-control" required>
    </div>
    <div class="form-group">
        <label>Type Kamar*</label>
        <input type="text" id="typekamar" name="typekamar" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nama Kamar*</label>
        <input type="text" id="namakamar" name="namakamar" placeholder="minimal 3 karakter" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Fasilitas*</label>
        <input type="text" id="fasilitas" name="fasilitas" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Jumlah Kamar*</label>
        <input type="text" id="jumlahkamar" name="jumlahkamar" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Biaya</label>
        <input type="text" id="biaya" name="biaya" class="form-control">
    </div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>
    </div>
</form>
