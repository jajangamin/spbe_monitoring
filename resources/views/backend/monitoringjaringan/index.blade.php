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
                            <form action="{{ route('backend.monitoringjaringan.index') }}" method="GET">
                                <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari"
                                 placeholder="Pencarian berdasarkan nama OPD" class="input-sm form-control"
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
                                <th>OPD</th>
                                <th>IP</th>
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
                            @foreach ($mjaringan as $data => $value)
                                <tr>
                                    <td>{{ $mjaringan->firstItem() + $data }}</td>
                                    <td>{{ $value->opd }}</td>
                                    <td>{{ $value->ip }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->tgl_error }}</td>
                                    <td>{{ $value->tgl_fix }}</td>
                                    <td>{{ $value->keterangan }}</td>

                                    @if (Session::get('data')->role->name=='Superadmin' )
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm"
                                           data-idjaringan="{{ $value->mjaringan_id }}"
                                           data-nama_unit="{{ $value->nama_unit }}"
                                           data-link="{{ $value->link }}"
                                           data-status="{{ $value->status }}"
                                           data-nama_jaringan="{{ $value->nama_jaringan }}"

                                           onclick="showForm(this)"><i class="fa fa-folder"></i> Ubah Status </a>

                                    </td>
                                        @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $mjaringan->links() }}
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
            var jaringan_id = $(data).data("idjaringan");


            $('#tambahModal').removeData('bs.modal');
            $('#tambahModal  .modal-header .modal-title').html('Ubah Status Jaringan');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.monitoringjaringan.ubahstatus') }}?jaringan_id=' +
                jaringan_id );
            $("#tambahModal").modal('show');
        }

        function createModal() {
            $('#tambahModal  .modal-header .modal-title').html('Tambah Monitoring Jaringan');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.monitoringjaringan.jaringancreateview') }}');
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
