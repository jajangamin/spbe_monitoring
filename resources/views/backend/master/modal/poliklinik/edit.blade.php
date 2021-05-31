<form action="{{ route('backend.master.poliedit') }}" method="post">
    @csrf
    <input type="hidden" id="poli_id" name="poli_id" value="{{ $poliklinik->id }}">
    <div class="form-group"><label>Kode Poliklinik*</label>
        <input type="text" id="poli_code" name="poli_code"
               placeholder="minimal 3 karakter huruf, angka, dash dan underscore, tidak menerima spasi."
               class="form-control" required value="{{$poliklinik->kodepoli}}"></div>
    <div class="form-group"><label>Nama Poliklinik*</label> <input type="text" id="poli_name" name="poli_name" placeholder="minimal 3 karakter" class="form-control" required value="{{$poliklinik->namapoliklinik}}"></div>
    <div class="form-group"><label>Interval Antrian dalam satuan menit*</label> <input type="text" id="interval_antrian" name="interval_antrian" placeholder="interval antrian dalam jam praktek" class="form-control" required value="{{$poliklinik->interval_antrian}}"></div>
    <div class="form-group"><label>Keterangan</label> <textarea id="poli_description" name="poli_description" class="form-control">{{$poliklinik->keterangan}}</textarea></div>
    <div>
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
    </div>
</form>
