<form action="{{ route('backend.jaringan.jaringanedit') }}" method="post" >
    @csrf
    <input type="hidden" id="idjaringan" name="idjaringan" value="{{ $jaringan->idjaringan }}">


    <div class="form-group">
        <label>Nama OPD*</label>
        <input type="text" id="opd" name="opd" placeholder="minimal 3 karakter huruf"
               value="{{ $jaringan->opd }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>SSID*</label>
        <input type="text" id="ssid" name="ssid"  value="{{ $jaringan->ssid }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Password*</label>
        <input type="text" id="password" name="password"  value="{{ $jaringan->password }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>IP</label>
        <input type="text" id="ip" name="ip"  value="{{ $jaringan->ip }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Bandwidth*</label>
        <input type="text" id="bandwitch" name="bandwitch"  value="{{ $jaringan->bandwitch }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status" id="status" required>
            <option value={{ $jaringan->status }} selected >{{ $jaringan->status }}</option>
            <option value="UP">UP </option>
            <option value="DOWN">DOWN</option>
        </select>
    </div>
    <div class="form-group">
        <label>Link*</label>
        <input type="text" id="link" name="link"  value="{{ $jaringan->link }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>SN</label>
        <input type="text" id="sn" name="sn"  value="{{ $jaringan->sn }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Router</label>
        <input type="text" id="router" name="router"  value="{{ $jaringan->router }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Longitude</label>
        <input type="text" id="long" name="long"  value="{{ $jaringan->long }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Latitude</label>
        <input type="text" id="lat" name="lat"  value="{{ $jaringan->lat }}" class="form-control" >
    </div>







    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Ubah</strong></button>
</form>
