<style>
    .inmodal .modal-body {
        background: #fff;
    }
    .modal-footer {
        border-top: 0px;
    }
</style>

<div class="col-sm-12" style="padding-bottom: 25px;">
{{--    <form action="{{ route('backend.monitoringaplikasi.kirimstatus') }}" method="post">--}}
        @csrf


            <p>SSID : <strong>{{ $jaringan->ssid }}</strong></p>
            <p>Password : <strong>{{ $jaringan->password}}</strong></p>
    <p>Link : <strong>{{ $jaringan->link }}</strong></p>
    <p>SN : <strong>{{ $jaringan->sn }}</strong></p>
    <p>Router : <strong>{{ $jaringan->router }}</strong></p>
            <p>Longitude : <strong>{{ $jaringan->long }}</strong></p>
            <p>Latitude : <strong>{{ $jaringan->lat }}</strong></p>


</div>

<script>

</script>
<p></p>

