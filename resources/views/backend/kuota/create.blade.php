<form action="{{ route('backend.kuota.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Tanggal Praktek*</label>
        <input autocomplete="off" type="text" id="tanggalpraktek" name="tanggalpraktek" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Pilih Dokter*</label>
        <select class="form-control m-b" id="dokter" name="dokter" onchange="cekJadwal(this);" required>
            <option value="" selected disabled> -- Harap pilih salah satu dokter --</option>
            @foreach ($dokter as $data => $value)
                <option value="{{ $value->id }}">{{ $value->kodedokter .' - '. $value->namalengkap }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Pilih Jam Praktek*</label>
        <select class="form-control m-b" id="idpraktek" name="idpraktek" required>
            <option value="" selected disabled> -- Harap pilih jam praktek --</option>
        </select>
    </div>
    <div class="form-group"><label>Kuota*</label> <input type="text" id="kuota" name="kuota" class="form-control" value="1" required></div>
    <input type="hidden" name="status" id="status" value="" />

    <div class="row">
    <div class="col-md-12">
        <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="submit" onClick="changeStatus(1)"><strong>Set Penuh</strong></button>
    </div>
    <br>
    <br>
    <div class="col-md-12">
        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" onClick="changeStatus(0)"><strong>Tambah</strong></button>
    </div>
    </div>

</form>

<script>

    $('#tanggalpraktek').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changeStatus(id){
        $("#status").val(id);
    }

    function cekJadwal(dokter) {

        var post_data = {
            'iddokter': dokter.value
        };

        $.ajax({
            type: "POST",
            url: "{{ route('backend.kuota.jadwal') }}",
            data: post_data,
            cache: false,
            success: function (response) {
                $('#idpraktek').html('');
                $('#idpraktek').append('<option value="" selected disabled> -- Harap pilih jam praktek --</option>');

                if (response.success == true) {
                    $.each(response.data, function (index, value) {
                        $("#idpraktek").append('<option value="' + value.id + '">' + value.detailpoli.namapoliklinik + ' | ' + value.hari + ' | ' + value.waktupraktek + ' | ' + value.jampraktek_awal + ' - ' + value.jampraktek_akhir + '</option>');
                    });
                } else {
                    $("#idpraktek").append('<option value="" disabled>-- Tidak ada data --</option>');
                }
            }
        });
    }
</script>
