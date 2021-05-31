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
                        {{ $data->keluarga->namalengkap }}
                        <br>
                        <small>Kode booking: {{ $data->kodebooking }}</small>
                    </td>
                    <td class="project-completion">
                        <small>Pemegang akun: {{ $data->user->name }} </small>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
<p></p>
