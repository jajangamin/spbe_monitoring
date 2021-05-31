<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
    <div class="project-list">

        <table class="table table-hover">
            <tbody>
                @foreach ($transaksi as $data)
                <tr>
                    <td class="project-title">
                        <a href="#" data-code="{{ $data->kode_booking }}" onclick="showDetail(this)">{{ $data->nama_keluarga }} </a>
                        <br>
                        <small>Kode booking: {{ $data->kode_booking }}</small>
                    </td>
                    <td class="project-completion">
                        <small>Jam kedatangan: {{ isset($data->jam_antrian) ? date('H:i',strtotime($data->jam_antrian)) : '-' }} </small>
                    </td>
                    <td class="project-status">
                        <small>Pemegang akun: {{ isset($data->pemegang_akun) ? $data->pemegang_akun : '-' }}</small>
                        <br>
                        <small>Status: {{ isset($data->status) ? $data->status : '-' }}</small>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<p></p>

