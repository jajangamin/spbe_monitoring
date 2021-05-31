<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jaringan;
use Carbon\Carbon;
use File;
use App\Traits\FlashMessageTraits;
use DB;
use Auth;




class JaringanController extends Controller
{
    use FlashMessageTraits;

    protected $SESSION_DATAUSER;

    function __construct(

    ) {


        //No session access from constructor work arround
        $this->middleware(function ($request, $next)
        {
            $this->SESSION_DATAUSER = session('data');
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['cari'] = $request->get('cari');
        $data['jaringan'] = Jaringan::where(function ($query) use ($data) {
            $query->Where('jaringan.id', 'LIKE', '%' . $data['cari'] . '%')
                ->orWhere('jaringan.opd', 'LIKE', '%' . $data['cari'] . '%');
        })
            ->orderBy('jaringan.opd', 'desc')
            ->paginate(10);

        $data['maping'] = $this->jaringanList();

//        dd($data['maping'] );

        return view('backend.jaringan.index',$data);

    }

    public function jaringanList()
    {
//        $maping = Jaringan::get();
        $maping=Jaringan::get()->where('lat','<>', 'null');

        return $maping;
    }

    public function createView() {

        return view('backend.jaringan.create');
    }

    public function create(Request $request) {
        $request->validate([
            'opd' => 'required|min:3',
            'ssid' => 'required',
            'password' => 'required',
            'bandwitch' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $data = [
                'opd' => $request->opd,
                'ssid' => $request->ssid,
                'password' => $request->password,
                'ip' => $request->ip,
                'bandwitch' => $request->bandwitch,
                'status' => $request->status,
                'link' => $request->link,
                'sn' => $request->sn,
                'router' => $request->router,
                'long' => $request->long,
                'lat' => $request->lat,
                'created_by' => Auth::id(),
            ];
            unset($data['_token']);
            Jaringan::create($data);
            DB::commit();

            $this->message('success', 'Jaringan berhasil ditambahkan.');
            return redirect()->route('backend.jaringan.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('bbackend.jaringan.index');
        }
    }

    public function detail(Request $request)
    {
        $id_jaringan = $request->id_jaringan;
        $data['jaringan']=Jaringan::get()->where('id', $id_jaringan)->first();
        return view('backend.jaringan.detail', $data);
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['jaringan'] = Jaringan::find($request->pid);


        if (!$data['jaringan']) {
            return "Tidak ada jaringan.";
        }

        return view('backend.jaringan.edit', $data);
    }

    public function edit(Request $request) {

        $request->validate([
            'opd' => 'required|min:3',
            'ssid' => 'required',
            'password' => 'required',
            'bandwitch' => 'required',

        ]);

        DB::beginTransaction();
        try {

            $jaringanId = $request->idjaringan;
            $input = array(
                'opd' => $request->opd,
                'ssid' => $request->ssid,
                'password' => $request->password,
                'ip' => $request->ip,
                'bandwitch' => $request->bandwitch,
                'status' => $request->status,
                'link' => $request->link,
                'sn' => $request->sn,
                'router' => $request->router,
                'long' => $request->long,
                'lat' => $request->lat,

            );

            Jaringan::where('id', $jaringanId)->update($input);

            DB::commit();

            $this->message('success', 'Jaringan berhasil dirubah.');
            return redirect()->route('backend.jaringan.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.jaringan.index');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        $jaringan = Jaringan::find($request->uid);
        $jaringan->delete();

        $this->message('success', 'Jaringan telah dihapus.');
        return redirect()->route('backend.jaringan.index');
    }


}
