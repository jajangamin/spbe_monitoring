<form action="{{ route('backend.master.rawatedit') }}" method="post">
    @csrf
    <input type="hidden" id="kamar_id" name="kamar_id" value="{{ $rawat->id }}">
    <div class="form-group"><label>Kode Kamar*</label> <input type="text" id="kodekamar" name="kodekamar" placeholder="minimal 3 karakter huruf, angka, dash dan underscore, tidak menerima spasi." class="form-control" required value="{{$rawat->kodekamar}}"></div>
    <div class="form-group"><label>Type Kamar*</label> <input type="text" id="typekamar" name="typekamar" placeholder="minimal 3 karakter" class="form-control" required value="{{$rawat->typekamar}}"></div>
    <div class="form-group"><label>Nama Kamar*</label> <input type="text" id="namakamar" name="namakamar" placeholder="minimal 3 karakter" class="form-control" required value="{{$rawat->namakamar}}"></div>
    <div class="form-group"><label>Fasilitas*</label> <textarea id="fasilitas" name="fasilitas" class="form-control">{{ $rawat->fasilitas }}</textarea></div>
    <div class="form-group"><label>Jumlah Kamar*</label> <input type="text" id="jumlahkamar" name="jumlahkamar" class="form-control" placeholder="masukan dalam bentuk angka" value="{{$rawat->jumlahkamar}}"></div>
    <div class="form-group"><label>Biaya*</label> <input type="text" id="biaya" name="biaya" class="form-control" placeholder="masukan dalam bentuk angka" value="{{$rawat->biaya}}"></div>
    <div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
    </div>
</form>
