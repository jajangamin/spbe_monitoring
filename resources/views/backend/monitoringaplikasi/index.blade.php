@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <h5>Data Monitoring Layanan SPBE</h5>

                </div>

                <div class="ibox-content">

                    <div class="row m-b-sm m-t-sm">
                        <div class="col-md-4">
                            <form action="{{ route('backend.monitoringaplikasi.index') }}" method="GET">
                                <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari"
                                 placeholder="Pencarian berdasarkan nama aplikasi aplikasi" class="input-sm form-control"
                                  value="{{ $cari }}"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> Cari!</button> </span></div>
                            </form>
                        </div>
                        @if (Session::get('data')->role->name=='Superadmin' )
                        <div class="col-md-2 pull-right">
                            <button class="btn btn-primary " type="button" onclick="createModal()"><i class="fa fa-plus"></i>&nbsp;Tambah Monitoring</button>
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
                                <th>Status</th>
                                <th>Tanggal Error</th>
                                <th>Tanggal Fix</th>
                                <th>Keterangan</th>
                                @if (Session::get('data')->role->name=='Superadmin' )
                                <th>Aksi</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($maplikasi as $data => $value)
                                <tr>
                                    <td>{{ $maplikasi->firstItem() + $data }}</td>
                                    <td>{{ $value->nama_aplikasi }}</td>
                                    <td>{{ $value->link }}</td>
                                    <td>{{ $value->nama_unit }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->tgl_error }}</td>
                                    <td>{{ $value->tgl_fix }}</td>
                                    <td>{{ $value->keterangan }}</td>
                                    @if (Session::get('data')->role->name=='Superadmin' )
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm"
                                           data-idaplikasi="{{ $value->maplikasi_id }}"
                                           data-nama_unit="{{ $value->nama_unit }}"
                                           data-link="{{ $value->link }}"
                                           data-status="{{ $value->status }}"
                                           data-nama_aplikasi="{{ $value->nama_aplikasi }}"

                                           onclick="showForm(this)"><i class="fa fa-folder"></i> Ubah Status </a>

                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $maplikasi->links() }}
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
            var aplikasi_id = $(data).data("idaplikasi");


            $('#tambahModal').removeData('bs.modal');
            $('#tambahModal  .modal-header .modal-title').html('Ubah Status');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.monitoringaplikasi.ubahstatus') }}?aplikasi_id=' +
                aplikasi_id );
            $("#tambahModal").modal('show');
        }

        function createModal() {
            $('#tambahModal  .modal-header .modal-title').html('Tambah Monitoring');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.monitoringaplikasi.aplikasicreateview') }}');
            $("#tambahModal").modal('show');
        }





        // $('#cari').datepicker({
        //     format: "yyyy-mm-dd",
        //     todayBtn: "linked",
        //     keyboardNavigation: false,
        //     forceParse: false,
        //     calendarWeeks: true,
        //     autoclose: true
        // });

    </script>

@endsection
