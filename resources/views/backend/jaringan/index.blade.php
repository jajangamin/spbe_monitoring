@extends('backend.layouts.app')

@section('content')
<style>

    #mapid { height: 400px; }


</style>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

            <div class="ibox-content">
                <div id="mapid"></div>
            </div>




        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>List of Jaringan Diskominfo </h5>
                <div class="ibox-tools">
                    <a class="btn btn-default btn-xs" type="button" href="{{ route('backend.berita.create') }}">
                        <i class="fa fa-plus"></i>
                        <strong>New</strong>
                    </a>
                </div>

            </div>
            <div class="ibox-content">

                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-4">
                        <form action="{{ route('backend.jaringan.index') }}" method="GET">
                            <div class="input-group"><input autocomplete="off" type="text" id="cari" name="cari"
                                                            placeholder="Pencarian berdasarkan nama opd" class="input-sm form-control"
                                                            value="{{ $cari }}"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary"> Cari!</button> </span></div>
                        </form>
                    </div>
                    @if (Session::get('data')->role->name=='Superadmin' )
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-primary " type="button" onclick="createModal()"><i class="fa fa-plus"></i>&nbsp;Tambah Jaringan</button>
                    </div>
                        @endif
                </div>

                <div class="project-list">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>OPD</th>
                            <th>SSID</th>
                            <th>IP</th>
                            <th>Bandwidth</th>
                            <th>Status</th>
{{--                            <th>Link</th>--}}
{{--                            <th>SN</th>--}}
{{--                            <th>Router</th>--}}
                            <th>Detail</th>
                            @if (Session::get('data')->role->name=='Superadmin' )
                            <th>Aksi</th>
                                @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($jaringan as $data => $value)
                            <tr>
                                <td>{{ $jaringan->firstItem() + $data }}</td>
                                <td>{{ $value->opd }}</td>
                                <td>{{ $value->ssid }}</td>
{{--                                <td>{{ $value->password }}</td>--}}
                                <td>{{ $value->ip }}</td>
                                <td>{{ $value->bandwitch }}</td>
                                <td>{{ $value->status }}</td>
{{--                                <td>{{ $value->link }}</td>--}}
{{--                                <td>{{ $value->sn }}</td>--}}
{{--                                <td>{{ $value->router }}</td>--}}
                                <td>
                                    <a href="#" class="btn btn-info btn-sm"
                                       data-id_jaringan="{{ $value->id }}"
                                       onclick="showForm(this)"><i class="fa fa-folder"></i> Detail </a>

                                </td>

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
                    {{ $jaringan->links() }}
                </div>
            </div>



        </div>
    </div>
</div>
<form id="deleteform" action="{{ route('backend.jaringan.jaringandelete') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" id="uid" name="uid" value="" />
</form>
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


    <script>

        // var map = L.map('mapid').setView([-7.3277955,108.351878079558], 20);
        // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        //     maxZoom: 13,
        //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
        //         'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        //     id: 'mapbox/streets-v11',
        //     tileSize: 512,
        //     zoomOffset: -1
        // }).addTo(map);

        var cities = L.layerGroup();

            // L.marker([-7.348108746999969,108.511827174000075]).bindPopup('Cisaga').addTo(cities),
            // L.marker([-7.358505229999935,108.522656530000063]).bindPopup("Mekar Mukti.<br> BANDWIDTH 30 Mbps").addTo(cities),
            // L.marker([-7.315706666999972,108.43729834700008]).bindPopup('Karanganyar').addTo(cities),
            // L.marker([-7.190830616999961,108.45476300100006 ]).bindPopup('Rajadesa').addTo(cities);
            //

                @foreach ($maping as $data => $value)
                {{--L.marker([{{ $value->long }},{{ $value->lat }}]).bindPopup("{{ $value->opd }}"<br>"BANDWIDTH {{ $value->bandwitch }} Mbps").addTo(cities)--}}
                L.marker([{{ $value->long }},{{ $value->lat }} ]).bindPopup('{{ $value->opd }}.<br> BANDWIDTH {{ $value->bandwitch }} Mbps').addTo(cities);
            @endforeach

        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
            streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

        var map = L.map('mapid', {
            center: [-7.3277955,108.351878079558],
            zoom: 13,
            layers: [grayscale, cities]
        });

        var baseLayers = {
            "Grayscale": grayscale,
            "Streets": streets
        };

        var overlays = {
            "Cities": cities
        };

        L.control.layers(baseLayers, overlays).addTo(map);

        $(document).ready(function () {

        });

        function showForm(data) {
            var id_jaringan = $(data).data("id_jaringan");


            $('#tambahModal').removeData('bs.modal');
            $('#tambahModal  .modal-header .modal-title').html('Detail Jaringan');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.jaringan.detail') }}?id_jaringan=' +
                id_jaringan );
            $("#tambahModal").modal('show');
        }

        function createModal() {
            $('#tambahModal  .modal-header .modal-title').html('Tambah Jaringan');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.jaringan.jaringancreateview') }}');
            $("#tambahModal").modal('show');
        }

        function editModal(pid) {
            $('#tambahModal  .modal-header .modal-title').html('Ubah Jaringan');
            $('#tambahModal  .modal-body').html('<i class="fa fa-cog fa-spin fa-2x fa-fw"></i> Loading...');
            $('#tambahModal  .modal-body').load('{{ route('backend.jaringan.jaringaneditview') }}?pid=' + pid);
            $("#tambahModal").modal('show');
        }

        function deleteWarning(uid) {
            swal({
                title: "Hapus Aplikasi",
                text: "Anda yakin akan menghapus Jaringan ini?",
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
