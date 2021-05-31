@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Pembatalan Pemesanan</h5>

            </div>

            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-4">
                        <form action="{{ route('backend.jadwal.transaksi') }}" method="GET">
                            <div class="input-group">
                                <input autocomplete="off" type="text" id="cari" name="cari"
                                                            placeholder="Search"
                                       class="input-sm form-control"> <span class="input-group-btn">
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
                                    <a href="#" class="btn btn-primary btn-sm" data-namadokter="{{ $data->dokter->namalengkap }}"
                                       data-iddokter="{{ $data->iddokter }}"
                                       data-tanggal="{{ $data->tanggalbooking->format('Y-m-d') }}"
                                       data-jamawal="{{ $data->jampraktek_awal }}"
                                       data-jamakhir="{{ $data->jampraktek_akhir }}" onclick="showData(this)">
                                        <i class="fa fa-folder"></i> Detail </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal"
                                       data-namadokter="{{ $data->dokter->namalengkap }}"
                                       data-iddokter="{{ $data->iddokter }}" data-tanggal="{{ $data->tanggalbooking->format('Y-m-d') }}"
                                       data-jamawal="{{ $data->jampraktek_awal }}" data-jamakhir="{{ $data->jampraktek_akhir }}" onclick="setData(this)">
                                        <i class="fa fa-trash"></i> Cancel </a>
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

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-user-circle modal-icon"></i>
                <h4 class="modal-title">Pembatalan Jadwal</h4>
            </div>
            <form action="{{ route('backend.jadwal.transaksibatal') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p><strong>Peringatan*</strong>, pasien dari <span id="namadokter"></span> akan dibatalkan.</p>
                    <input type="hidden" id="iddokter" name="iddokter" value=""/>
                    <input type="hidden" id="tanggalbooking" name="tanggalbooking" value=""/>
                    <input type="hidden" id="jampraktek_awal" name="jampraktek_awal" value=""/>
                    <input type="hidden" id="jampraktek_akhir" name="jampraktek_akhir" value=""/>
                    <div class="form-group"><label>Keterangan</label> <textarea id="note" name="note" placeholder="Alasan pembatalan" class="form-control" required></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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

    function showData(data) {
        var iddokter = $(data).data("iddokter");
        var tanggalbooking = $(data).data("tanggal");
        var jampraktek_awal = $(data).data("jamawal");
        var jampraktek_akhir = $(data).data("jamakhir");
        $('#tambahModal').removeData('bs.modal');
        $('#tambahModal  .modal-header .modal-title').html('Daftar Pasien');
        $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
        $('#tambahModal  .modal-body').load('{{ route('backend.jadwal.listpasien') }}?iddokter=' + iddokter + '&tanggalbooking=' + tanggalbooking + '&jampraktek_awal=' + jampraktek_awal + '&jampraktek_akhir=' + jampraktek_akhir);
        $("#tambahModal").modal('show');
    }

    function setData(data) {
        $('#namadokter').html($(data).data("namadokter"));
        $('#iddokter').val($(data).data("iddokter"));
        $('#tanggalbooking').val($(data).data("tanggal"));
        $('#jampraktek_awal').val($(data).data("jamawal"));
        $('#jampraktek_akhir').val($(data).data("jamakhir"));
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
