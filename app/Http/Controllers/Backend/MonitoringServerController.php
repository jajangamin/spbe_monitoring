<?php

namespace App\Http\Controllers\Backend;


use App\Models\Mserver;

use Cassandra\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MonitoringServerController
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
        $data['mserver'] = Mserver::
        select(
            'nama_server',
            'id as mserver_id',
            'nama_server',
            'tgl_error',
            'tgl_fix',
            'keterangan'
        )


            ->where(function ($query) use ($data) {
                $query->Where('mserver.nama_server', 'LIKE', '%' . $data['cari'] . '%');
//                    ->orWhere('jenis.nama_jenis', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->orderBy('tgl_error', 'DESC')
            ->paginate(10);



        return view('backend.monitoringserver.index', $data);
    }




    public function ubahstatus(Request $request){
        $serverid = $request->server_id;
//        $data['monitoring'] = Mjaringan::get();
        $data['mserver'] = Mserver::
        select(
            'nama_server',
            'id as mserver_id',
            'nama_server',
            'tgl_error',
            'tgl_fix',
            'keterangan'
        )
            ->where('mserver.id', $serverid)
            ->first();


        return view('backend.monitoringserver.ubahstatus', $data);
    }

    public function kirimstatus(Request $request) {

        $request->validate([
            'keterangan' => 'required',
            'tgl_fix' => 'required',
            'tgl_error' => 'required',


        ]);

        DB::beginTransaction();
        try {


            $id = $request->idserver;
            $input = array(
                'keterangan'=> $request->keterangan,
                'tgl_fix'=> $request->tgl_fix,
                'tgl_error'=> $request->tgl_error,


            );

            Mserver::where('id', $id)->update($input);

            DB::commit();

            $this->message('success', 'Status berhasil dirubah.');
            return redirect()->route('backend.monitoringserver.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.monitoringserver.index');
        }
    }


    public function createView() {

        $data['mserver'] = $this->mserverlist();
//        $data['time'] = Carbon\Carbon::now();
//        $ldate = date('Y-m-d H:i:s');

        return view('backend.monitoringserver.create',$data);
    }





    public function mserverlist()
    {
        $mserver = Mserver::get();
        return $mserver;
    }





    public function create(Request $request) {
        $request->validate([
            'nama_server' => 'required',
            'tgl_error' => 'required',
            'tgl_fix' => 'required',
            'keterangan' => 'required',


        ]);

        DB::beginTransaction();
        try {
            $data = [
                'nama_server' => $request->nama_server,
                'tgl_error' => $request->tgl_error,
                'tgl_fix' => $request->tgl_fix,
                'keterangan' => $request->keterangan,
            ];
            unset($data['_token']);
            Mserver::create($data);
            DB::commit();

            $this->message('success', 'Server berhasil ditambahkan.');
            return redirect()->route('backend.monitoringserver.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.monitoringserver.index');
        }
    }


}
