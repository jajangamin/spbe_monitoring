@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Riwayat Pemesanan</h5>

            </div>

            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-4">
                        <form action="{{ route('backend.jadwal.transaksisemua') }}" method="GET">
                            <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari"
                                                            placeholder="Search" class="input-sm form-control"
                                                            value="{{ $cari }}"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary"> Cari!</button> </span></div>
                        </form>
                    </div>
                </div>

                <div class="project-list">

                    <table class="table table-hover">
                        <tbody>
                            @foreach ($transaksi as $data)
                            <tr>
                                <td class="project-title">
                                    {{ $data->dokter->namalengkap }}
                                    <br>
                                    <small>Tanggal praktek {{ $data->tanggalbooking->format('d-m-Y').', '.$data->jampraktek_awal.' - '.$data->jampraktek_akhir }}</small>
                                </td>
                                <td class="project-completion">
                                    <small>Jumlah pasien: {{ $data->jumlah }} </small>
                                </td>
                                <td class="project-actions">
                                    <a href="#" class="btn btn-info btn-sm" data-namadokter="{{ $data->dokter->namalengkap }}"
                                       data-iddokter="{{ $data->iddokter }}" data-tanggal="{{ $data->tanggalbooking->format('Y-m-d') }}"
                                       data-jamawal="{{ $data->jampraktek_awal }}" data-jamakhir="{{ $data->jampraktek_akhir }}"
                                       onclick="showForm(this)"><i class="fa fa-folder"></i> Kirim notifikasi </a>
                                    <a href="#" class="btn btn-primary btn-sm" data-namadokter="{{ $data->dokter->namalengkap }}"
                                       data-iddokter="{{ $data->iddokter }}" data-tanggal="{{ $data->tanggalbooking->format('Y-m-d') }}"
                                       data-jamawal="{{ $data->jampraktek_awal }}" data-jamakhir="{{ $data->jampraktek_akhir }}"
                                       onclick="showData(this)"><i class="fa fa-folder"></i> Detail </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transaksi->links() }}
                </div>
            </div>


        </div>
    </div>

</div>

<div class="modal inmodal" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user modal-icon"></i>
                <h4 class="modal-title"></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

@endsection

@section('onpage-js')

@include('backend.layouts.message')

<script>
    $(document).ready(function () {

    });

    function showForm(data) {
        var iddokter = $(data).data("iddokter");
        var tanggalbooking = $(data).data("tanggal");
        var jampraktek_awal = $(data).data("jamawal");
        var jampraktek_akhir = $(data).data("jamakhir");
        $('#tambahModal').removeData('bs.modal');
        $('#tambahModal  .modal-header .modal-title').html('Kirim Notifikasi');
        $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
        $('#tambahModal  .modal-body').load('{{ route('backend.jadwal.formnotifikasi') }}?iddokter=' + iddokter + '&tanggalbooking=' + tanggalbooking + '&jampraktek_awal=' + jampraktek_awal + '&jampraktek_akhir=' + jampraktek_akhir);
        $("#tambahModal").modal('show');
    }

    function showData(data) {
        var iddokter = $(data).data("iddokter");
        var tanggalbooking = $(data).data("tanggal");
        var jampraktek_awal = $(data).data("jamawal");
        var jampraktek_akhir = $(data).data("jamakhir");
        $('#tambahModal').removeData('bs.modal');
        $('#tambahModal  .modal-header .modal-title').html('Daftar Pasien');
        $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
        $('#tambahModal  .modal-body').load('{{ route('backend.jadwal.listpasiensemua') }}?iddokter=' + iddokter + '&tanggalbooking=' + tanggalbooking + '&jampraktek_awal=' + jampraktek_awal + '&jampraktek_akhir=' + jampraktek_akhir);
        $("#tambahModal").modal('show');
    }

    function showDetail(data) {
        var code = $(data).data("code");
        $('#tambahModal').removeData('bs.modal');
        $('#tambahModal  .modal-header .modal-title').html('Detail Pasien');
        $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
        $('#tambahModal  .modal-body').load('{{ route('backend.jadwal.showpasien') }}?code=' + code);
        $("#tambahModal").modal('show');
    }

    $('#cari').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

</script>

@endsection
