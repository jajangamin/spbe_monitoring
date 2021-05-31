<?php

namespace App\Http\Controllers\Backend;

//use App\Models\Jenis;
use App\Models\Mjaringan;
use App\Models\Jaringan;

use Cassandra\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MonitoringjaringanController
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
        $data['mjaringan'] = Mjaringan::
        select(
            'mjaringan.id as mjaringan_id',
            'tgl_error',
            'tgl_fix',
            'mjaringan.status as status',
            'mjaringan.keterangan as keterangan',
            'jaringan.opd as opd',
            'jaringan.ip as ip'
        )
            ->leftjoin('jaringan', 'idjaringan', 'jaringan.id')

            ->where(function ($query) use ($data) {
                $query->Where('jaringan.opd', 'LIKE', '%' . $data['cari'] . '%');
//                    ->orWhere('jenis.nama_jenis', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->orderBy('mjaringan_id', 'desc')
            ->paginate(10);



        return view('backend.monitoringjaringan.index', $data);
    }




    public function ubahstatus(Request $request){
        $jaringan_id = $request->jaringan_id;
//        $data['monitoring'] = Mjaringan::get();
        $data['mjaringan'] = Mjaringan::
        select(
            'mjaringan.id as mjaringan_id',
            'tgl_error',
            'tgl_fix',
            'mjaringan.status as status',
            'mjaringan.keterangan as keterangan',
            'jaringan.opd as opd',
            'jaringan.ip as ip',
            'jaringan.id as jaringan_id',
            'jaringan.bandwitch as bandwitch',
            'jaringan.id as id_jaringan'
        )
            ->leftjoin('jaringan', 'idjaringan', 'jaringan.id')
            ->where('mjaringan.id', $jaringan_id)
            ->first();


        return view('backend.monitoringjaringan.ubahstatus', $data);
    }

    public function kirimstatus(Request $request) {

        $request->validate([
            'keterangan' => 'required',
            'tgl_fix' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $id = $request->idjaringan;
            $jaringan_id = $request->jaringan_id;
            $input = array(
                'keterangan'=> $request->keterangan,
                'status'=> $request->status,
                'tgl_fix'=> $request->tgl_fix,
            );

            $input2 = array(
                'status'=> $request->status,
            );

            Mjaringan::where('id', $id)->update($input);
            Jaringan::where('id', $jaringan_id)->update($input2);

            DB::commit();

            $this->message('success', 'Status berhasil dirubah.');
            return redirect()->route('backend.monitoringjaringan.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.monitoringjaringan.index');
        }
    }


    public function createView() {

        $data['jaringan'] = $this->jaringanlist();
//        $data['time'] = Carbon\Carbon::now();
//        $ldate = date('Y-m-d H:i:s');

        return view('backend.monitoringjaringan.create',$data);
    }



    public function jaringanlist()
    {
        $jaringan = Jaringan::get();
        return $jaringan;
    }



    public function create(Request $request) {
        $request->validate([
            'idjaringan' => 'required',
            'status' => 'required',
            'tgl_error' => 'required',

        ]);

        DB::beginTransaction();
        try {

            $id = $request->idjaringan;
            $data = [
                'idjaringan' => $request->idjaringan,
                'status' => $request->status,
                'tgl_error' => $request->tgl_error,
            ];

            $input = array(
                'status'=> $request->status,
            );
            unset($data['_token']);
            Mjaringan::create($data);
            Jaringan::where('id', $id)->update($input);

            DB::commit();

            $this->message('success', 'Jaringan berhasil ditambahkan.');
            return redirect()->route('backend.monitoringjaringan.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.monitoringjaringan.index');
        }
    }



}
