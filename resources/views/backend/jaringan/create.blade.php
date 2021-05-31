<form action="{{ route('backend.jaringan.jaringancreate') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Nama OPD*</label>
        <input type="text" id="opd" name="opd" placeholder="minimal 3 karakter huruf"
                class="form-control" required>
    </div>

    <div class="form-group">
        <label>SSID*</label>
        <input type="text" id="ssid" name="ssid"   class="form-control" >
    </div>
    <div class="form-group">
        <label>Password*</label>
        <input type="text" id="password" name="password"   class="form-control" >
    </div>
    <div class="form-group">
        <label>IP</label>
        <input type="text" id="ip" name="ip"  class="form-control" >
    </div>
    <div class="form-group">
        <label>Bandwidth*</label>
        <input type="text" id="bandwitch" name="bandwitch"   class="form-control" >
    </div>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status" id="status" required>
            <option  selected disabled >--Pilih Status--</option>
            <option value="UP">UP </option>
            <option value="DOWN">DOWN</option>
        </select>
    </div>
    <div class="form-group">
        <label>Link*</label>
        <input type="text" id="link" name="link"   class="form-control" >
    </div>
    <div class="form-group">
        <label>SN</label>
        <input type="text" id="sn" name="sn"   class="form-control" >
    </div>
    <div class="form-group">
        <label>Router</label>
        <input type="text" id="router" name="router"   class="form-control" >
    </div>
    <div class="form-group">
        <label>Longitude</label>
        <input type="text" id="long" name="long"   class="form-control" >
    </div>
    <div class="form-group">
        <label>Latitude</label>
        <input type="text" id="lat" name="lat"  class="form-control" >
    </div>


    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Tambah</strong></button>

</form>
