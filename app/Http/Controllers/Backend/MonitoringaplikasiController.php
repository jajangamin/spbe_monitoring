<?php

namespace App\Http\Controllers\Backend;

use App\Models\Jenis;
use App\Models\Maplikasi;
use App\Models\Aplikasi;
use App\Models\Unit;
use App\Models\Server;
use Cassandra\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MonitoringaplikasiController
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
        $data['maplikasi'] = Maplikasi::
        select(
            'maplikasi.id as maplikasi_id',
            'tgl_error',
            'tgl_fix',
            'maplikasi.status as status',
            'maplikasi.keterangan as keterangan',
            'aplikasi.nama_aplikasi as nama_aplikasi',
            'aplikasi.idunit as unit_id',
            'aplikasi.link as link',
            'unit.nama_unit as nama_unit'
        )
            ->leftjoin('aplikasi', 'idaplikasi', 'aplikasi.id')
            ->leftjoin('unit', 'aplikasi.idunit', 'unit.id')
            ->where(function ($query) use ($data) {
                $query->Where('aplikasi.nama_aplikasi', 'LIKE', '%' . $data['cari'] . '%');
//                    ->orWhere('jenis.nama_jenis', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->orderBy('maplikasi_id', 'desc')
            ->orderBy('unit_id', 'desc')
            ->paginate(10);


        return view('backend.monitoringaplikasi.index', $data);
    }




    public function ubahstatus(Request $request){
        $aplikasi_id = $request->aplikasi_id;
//        $data['monitoring'] = Maplikasi::get();
        $data['maplikasi'] = Maplikasi::
        select(
            'maplikasi.id as maplikasi_id',
            'tgl_error',
            'tgl_fix',
            'maplikasi.status as status',
            'maplikasi.keterangan as keterangan',
            'aplikasi.nama_aplikasi as nama_aplikasi',
            'aplikasi.idunit as unit_id',
            'aplikasi.link as link',
            'aplikasi.id as id_aplikasi',
            'unit.nama_unit as nama_unit'
        )
            ->leftjoin('aplikasi', 'idaplikasi', 'aplikasi.id')
            ->leftjoin('unit', 'aplikasi.idunit', 'unit.id')
            ->where('maplikasi.id', $aplikasi_id)
            ->first();


        return view('backend.monitoringaplikasi.ubahstatus', $data);
    }

    public function kirimstatus(Request $request) {

        $request->validate([
            'keterangan' => 'required',

        ]);

        DB::beginTransaction();
        try {


            $id = $request->idaplikasi;
            $id_induk= $request->id_induk;
            $input = array(
                'keterangan'=> $request->keterangan,
                'status'=> $request->status,
                'tgl_fix'=> $request->tgl_fix,


            );

            $input2 = array(
                'status'=> $request->status,
            );

            Maplikasi::where('id', $id)->update($input);
            Aplikasi::where('id', $id_induk)->update($input2);



            DB::commit();

            $this->message('success', 'Status berhasil dirubah.');
            return redirect()->route('backend.monitoringaplikasi.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.monitoringaplikasi.index');
        }
    }


    public function createView() {

        $data['aplikasi'] = $this->aplikasilist();

        return view('backend.monitoringaplikasi.create',$data);
    }








    public function aplikasilist()
    {
        $aplikasi = Aplikasi::get();
        return $aplikasi;
    }



    public function create(Request $request) {
        $request->validate([
            'idaplikasi' => 'required',
            'status' => 'required',
            'tgl_error' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $id = $request->idaplikasi;
            $status = $request->status;
            $data = [
                'idaplikasi' => $request->idaplikasi,
                'status' => $request->status,
                'tgl_error' => $request->tgl_error,
            ];

            $input = array(
                'status'=> $request->status,
            );
            unset($data['_token']);
            Maplikasi::create($data);
            Aplikasi::where('id', $id)->update($input);
            DB::commit();

            $this->message('success', 'Aplikasi berhasil ditambahkan.');
            return redirect()->route('backend.monitoringaplikasi.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.monitoringaplikasi.index');
        }
    }




}
