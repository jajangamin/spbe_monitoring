@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>Data Aplikasi SPBE</h5>

                </div>

                <div class="ibox-content">

                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-4">
                            <form action="{{ route('backend.monitoringaplikasi.index') }}" method="GET">
                                <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari" placeholder="Pencarian berdasarkan nama aplikasi aplikasi" class="input-sm form-control" value="{{ $cari }}"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> Cari!</button> </span></div>
                            </form>
                        </div>
                        @if (Session::get('data')->role->name=='Superadmin' )
                        <div class="col-md-2 pull-right">
                            <button class="btn btn-primary " type="button" onclick="createModal()"><i class="fa fa-plus"></i>&nbsp;Tambah Aplikasi</button>
                        </div>
                        @endif

                    </div>

                    <div class="project-list">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Aplikasi</th>
                                <th>Link</th>
                                <th>Unit Kerja</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Server</th>
                                <th>Status</th>
                                @if (Session::get('data')->role->name=='Superadmin' )
                                <th>Aksi</th>
                                    @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($aplikasi as $data => $value)
                                <tr>
                                    <td>{{ $aplikasi->firstItem() + $data }}</td>
                                    <td>{{ $value->nama_aplikasi }}</td>
                                    <td>{{ $value->link }}</td>
                                    <td>{{ $value->nama_unit }}</td>
                                    <td>{{ $value->nama_kategori }}</td>
                                    <td>{{ $value->nama_jenis }}</td>
                                    <td>{{ $value->server }}</td>
                                    <td>{{ $value->status }}</td>
                                    @if (Session::get('data')->role->name=='Superadmin' )
                                    <td>
                                        <button class="btn btn-success " type="button" onclick="editModal({{ $value->id }})"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                                        <button class="btn btn-danger " type="button" onclick="deleteWarning({{ $value->id }})"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                    </td>
                                        @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $aplikasi->links() }}
                    </div>

                </div>


            </div>
        </div>

    </div>

    <form id="deleteform" action="{{ route('backend.master.aplikasidelete') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" id="uid" name="uid" value="" />
    </form>

    <div class="modal inmodal" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-user-md modal-icon"></i>
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
            $('#tambahModal  .modal-header .modal-title').html('Tambah Aplikasi');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.master.aplikasicreateview') }}');
            $("#tambahModal").modal('show');
        }

        function editModal(pid) {
            $('#tambahModal  .modal-header .modal-title').html('Ubah Aplikasi');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.master.aplikasieditview') }}?pid=' + pid);
            $("#tambahModal").modal('show');
        }

        function deleteWarning(uid) {
            swal({
                title: "Hapus Aplikasi",
                text: "Anda yakin akan menghapus Aplikasi ini?",
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
