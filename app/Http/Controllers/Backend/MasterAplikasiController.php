<?php

namespace App\Http\Controllers\Backend;

use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Aplikasi;
use App\Models\Unit;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MasterAplikasiController
{
    use FlashMessageTraits;

    protected
        $PAGE_LIMIT,
        $PASS_REGEX
    ;

    function __construct() {
        $this->PASS_REGEX = config('setting.pass.regex');
    }

    function index(Request $request) {
        $data['cari'] = $request->get('cari');
        $data['aplikasi'] = Aplikasi::
        select(
            'aplikasi.id as id',
            'nama_aplikasi',
            'link',
            'server',
            'status',
            'keterangan',
            'unit.nama_unit as nama_unit',
            'idjenis as jenis_id',
            'jenis.nama_jenis as nama_jenis',
            'kategori.nama_kategori as nama_kategori'
        )
            ->leftjoin('jenis', 'idjenis', 'jenis.id')
            ->leftjoin('kategori', 'jenis.idkategori', 'kategori.id')
            ->leftjoin('unit', 'aplikasi.idunit', 'unit.id')
            ->where(function ($query) use ($data) {
                $query->Where('aplikasi.nama_aplikasi', 'LIKE', '%' . $data['cari'] . '%')
                    ->orWhere('jenis.nama_jenis', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->orderBy('jenis.id', 'DESC')
            ->orderBy('kategori.nama_kategori', 'ASC')
            ->orderBy('nama_aplikasi', 'ASC')
            ->paginate(10);
        return view('backend.master.aplikasi', $data);
    }

    public function createView() {
        $data['kategori'] = $this->kategoriList();
        $data['jenis'] = $this->jenisList();
        $data['unit'] = $this->unitList();
        $data['server'] = $this->serverList();
        return view('backend.master.modal.aplikasi.create',$data);
    }

    public function kategoriList()
    {
        $kategori = Kategori::get();
        return $kategori;
    }

    public function serverList()
    {
        $server = Server::get();
        return $server;
    }

    public function jenisList()
    {
        $jenis = Jenis::get();
        return $jenis;
    }

    public function unitList()
    {
        $unit = Unit::get();
        return $unit;
    }

    public function create(Request $request) {
        $request->validate([
            'nama_aplikasi' => 'required|min:3',
            'idunit' => 'required',
            'idjenis' => 'required',
            'namaserver' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $data = [
                'nama_aplikasi' => $request->nama_aplikasi,
                'idunit' => $request->idunit,
                'link' => $request->link,
                'server' => $request->namaserver,
                'idjenis' => $request->idjenis,
                'created_by' => Auth::id(),
            ];
            unset($data['_token']);
            Aplikasi::create($data);
            DB::commit();

            $this->message('success', 'Aplikasi berhasil ditambahkan.');
            return redirect()->route('backend.master.aplikasilist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.aplikasilist');
        }
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['aplikasi'] = Aplikasi::find($request->pid);
//        $data['kategori'] = $this->kategoriList();
        $data['jenis'] = $this->jenisList();
        $data['unit'] = $this->unitList();
        $data['server'] = $this->serverList();

        if (!$data['aplikasi']) {
            return "Tidak ada aplikasi.";
        }

        return view('backend.master.modal.aplikasi.edit', $data);
    }

    public function edit(Request $request) {

        $request->validate([
            'nama_aplikasi' => 'required|min:3',
            'idunit' => 'required',
            'idjenis' => 'required',
            'namaserver' => 'required',

        ]);

        DB::beginTransaction();
        try {

            $aplikasiId = $request->idaplikasi;
            $input = array(
                'nama_aplikasi' => $request->nama_aplikasi,
                'idunit' => $request->idunit,
                'link' => $request->link,
                'server' => $request->namaserver,
                'idjenis' => $request->idjenis,

            );

            Aplikasi::where('id', $aplikasiId)->update($input);

            DB::commit();

            $this->message('success', 'Aplikasi berhasil dirubah.');
            return redirect()->route('backend.master.aplikasilist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.aplikasilist');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        $aplikasi = Aplikasi::find($request->uid);
        $aplikasi->delete();

        $this->message('success', 'Aplikasi telah dihapus.');
        return redirect()->route('backend.master.aplikasilist');
    }


}
