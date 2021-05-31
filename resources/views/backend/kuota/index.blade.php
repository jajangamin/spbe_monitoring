@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Setting Kuota Individual</h5>

            </div>

            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-4">
                        <form action="{{ route('backend.kuota.index') }}" method="GET">
                            <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari" placeholder="Search" class="input-sm form-control" value="{{ $cari }}"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary"> Cari!</button> </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-primary " type="button" onclick="createModal()"><i class="fa fa-plus"></i>&nbsp;Tambah Data</button>
                    </div>
                </div>

                <div class="project-list">

                    <table class="table table-hover">
                        <tbody>
                            @foreach ($listkuota as $data)
                            <tr>
                                <td class="project-title">
                                    {{ $data->detailjadwal->detaildokter->namalengkap }}
                                    <br>
                                    <small>Tanggal praktek {{ $data->tanggalpraktek.', '.date('H:i',strtotime($data->detailjadwal->jampraktek_awal)).' - '.date('H:i',strtotime($data->detailjadwal->jampraktek_akhir)) }}</small>
                                </td>
                                <td class="project-completion">
                                    <small>Kuota pasien: {{ $data->kuota }} </small>
                                </td>
                                <td class="project-completion">
                                    <small>Kuota terisi: {{ $data->sequence }} </small>
                                </td>
                                <td class="project-actions">
                                    <a href="#" class="btn btn-primary btn-sm" data-counterid="{{ $data->id }}" onclick="editData(this)"><i class="fa fa-calendar"></i> Edit </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $listkuota->links() }}
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
                <i class="fa fa-calendar modal-icon"></i>
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

    function createModal() {
        $('#tambahModal  .modal-header .modal-title').html('Tambah Data');
        $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
        $('#tambahModal  .modal-body').load('{{ route('backend.kuota.create') }}');
        $("#tambahModal").modal('show');
    }

    function editData(data) {
        var counterid = $(data).data("counterid");
        $('#tambahModal').removeData('bs.modal');
        $('#tambahModal  .modal-header .modal-title').html('Edit Kuota');
        $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
        $('#tambahModal  .modal-body').load('{{ route('backend.kuota.edit') }}?counterid=' + counterid);
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
