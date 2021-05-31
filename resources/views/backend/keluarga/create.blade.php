@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h3>Create Keluarga <span class="text-info">{{ $detail->name }}</span></h3>
                <div class="ibox-tools">

                </div>

            </div>
            <div class="ibox-content">
                <form role="form" action="{{ route('backend.keluarga.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="hidden" name="parent_id" class="form-control" value="{{ $detail->id }}">
                        <input type="text" name="namalengkap" placeholder="Enter Name" class="form-control" required value="">
                    </div>
                    <div class="form-group" id="data_1">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="tanggal_lahir" value="">
                        </div>
                    </div>

                     <div class="form-group">
                        <label>Telephone</label>
                        <input type="notelpon" name="notelpon" placeholder="Enter Telephone" class="form-control" required value="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter Email" class="form-control" required value="">
                    </div>
                    <div class="form-group">
                        <label>Status Keluarga</label>
                        <select class="form-control" name="status_dalam_keluarga" required>
                            <option value="" disabled selected>Choose Status Keluarga</option>
                            <option value="SINGLE">SINGLE</option>
                            <option value="SUAMI">SUAMI</option>
                            <option value="ISTRI">ISTRI</option>
                            <option value="ANAK">ANAK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" type="text" name="alamat" id="alamat" placeholder="Enter Alamat" required=""></textarea>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-success pull-right m-t-n-xs" type="submit">
                            <strong>UPDATE</strong>
                        </button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('onpage-js')

    @include('backend.layouts.message')
    
    <script>
        $(document).ready(function () {
              $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
@endsection
