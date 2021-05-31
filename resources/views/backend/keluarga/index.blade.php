@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>List of Keluarga <span class="text-info">{{ $detail->name }}</span></h5>
                <div class="ibox-tools">
                    <a class="btn btn-default btn-xs" type="button" href="{{ route('backend.keluarga.create', $detail->id) }}">
                        <i class="fa fa-plus"></i>
                        <strong>New</strong>
                    </a>
                </div>

            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Status Keluarga</th>
                                <th>Tanggal Lahir</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keluarga as $kl)
                                <tr>
                                    <td>{{ $kl->id }}</td>
                                    <td>
                                        <b>{{ $kl->namalengkap }}</b>
                                    </td>
                                    <td>{{ $kl->status_dalam_keluarga }}</td>
                                    <td>{{ $kl->tanggal_lahir }}</td>
                                    <td>{{ $kl->notelpon }}</td>
                                    <td>{{ $kl->email }}</td>
                                    <td>{{ $kl->alamat }}</td>
                                    <td>{{ $kl->created_at }}</td>
                                    <td>
                                        <a class="" href="#" onclick="event.preventDefault(); document.getElementById('form-toggle-{{ $kl->id }}').submit();" >
                                        </a>                                            
                                        <form id="form-toggle-{{ $kl->id }}" action="{{ route('backend.keluarga.toggle') }}" method="POST" style="display: none;" >
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{ $kl->id }}">
                                            <input type="hidden" name="status" id="status" value="{{ ($kl->status == config('setting.status.active')) ? 0 : 1  }}" >
                                        </form>
                                    </td>
                                    <td>
                                       <a class="btn btn-success" type="button" href=" {{ route('backend.keluarga.edit', $kl->id) }}">
                                            <i class="fa fa-pencil"></i>
                                            <strong>Ubah</strong>
                                        </a>
                                         <button class="btn btn-danger " type="button" onclick="deleteWarning({{ $kl->id }})"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($keluarga as $value)
<form id="deleteform" action="{{ route('backend.keluarga.deletekeluarga') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" id="parent_id" name="parent_id" value="{{ $value->parent_id }}" />
    <input type="hidden" id="uid" name="uid" value="" />
</form>
@endforeach
@endsection

@section('onpage-js')

    @include('backend.layouts.message')
    
    <script>
        $(document).ready(function () {
            
        });

        function deleteWarning(uid){
            swal({
            title: "Hapus Keluarga",
                    text: "Anda yakin akan menghapus Keluarga ini?",
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
