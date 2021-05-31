<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <form action="{{ route('backend.jadwal.kirimnotifikasi') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <select class="form-control" name="subject" id="subject" required>
                <option value="" selected disabled>-- Pilih judul --</option>
                @foreach ($subject as $data)
                <option value="{{ $data->id }}">{{ $data->subject }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Pesan</label>
            <textarea class="form-control" name="message" id="message" required></textarea>
        </div>
        <input type="hidden" id="iddokter" name="iddokter" value="{{ $iddokter }}">
        <input type="hidden" id="tanggalbooking" name="tanggalbooking" value="{{ $tanggalbooking }}">
        <input type="hidden" id="jampraktek_awal" name="jampraktek_awal" value="{{ $jampraktek_awal }}">
        <input type="hidden" id="jampraktek_akhir" name="jampraktek_akhir" value="{{ $jampraktek_akhir }}">
        <div>
            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Kirim</strong></button>
        </div>
    </form>
</div>

<script>

</script>
<p></p>

