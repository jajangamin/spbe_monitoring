@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Master Poliklinik</h5>

            </div>

            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-4">
                        <form action="{{ route('backend.master.polilist') }}" method="GET">
                            <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari" placeholder="Pencarian berdasarkan kode dan nama poliklinik" class="input-sm form-control" value="{{ $cari }}"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> Cari!</button> </span></div>
                        </form>
                    </div>
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-primary " type="button" onclick="createModal()"><i class="fa fa-plus"></i>&nbsp;Tambah Poliklinik</button>
                    </div>
                </div>

                <div class="project-list">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Poliklinik</th>
                                <th>Nama Poliklinik</th>
                                <th>Interval Antrian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($poliklinik as $data => $value)
                            <tr>
                                <td>{{ $poliklinik->firstItem() + $data }}</td>
                                <td>{{ $value->poli_code }}</td>
                                <td>{{ $value->poli_name }}</td>
                                <td>{{ $value->interval_antrian }} menit</td>
                                <td>{{ $value->poli_description }}</td>
                                <td>
                                    <button class="btn btn-success " type="button" onclick="editModal({{ $value->poli_id }})"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                                    <button class="btn btn-danger " type="button" onclick="deleteWarning({{ $value->poli_id }})"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $poliklinik->links() }}
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

<form id="deleteform" action="{{ route('backend.master.polidelete') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" id="uid" name="uid" value="" />
</form>

@endsection

@section('onpage-js')

@include('backend.layouts.message')

<script>
    $(document).ready(function () {

    });
    function createModal() {
    $('#tambahModal  .modal-header .modal-title').html('Tambah Poliklinik');
    $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
    $('#tambahModal  .modal-body').load('{{ route('backend.master.policreateview') }}');
    $("#tambahModal").modal('show');
    }

    function editModal(pid) {
    $('#tambahModal  .modal-header .modal-title').html('Ubah Poliklinik');
    $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
    $('#tambahModal  .modal-body').load('{{ route('backend.master.polieditview') }}?pid=' + pid);
    $("#tambahModal").modal('show');
    }

    function deleteWarning(uid) {
    swal({
    title: "Hapus poliklinik",
            text: "Anda yakin akan menghapus poliklinik ini?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
    }, function () {
    $("#uid").val(uid);
    document.getElementById('deleteform').submit();
    });
    }

</script>

@endsection
