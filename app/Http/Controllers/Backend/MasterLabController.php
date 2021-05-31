<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MasterLabController extends Controller
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
        $data['lab'] = Lab::where('lab.status', 1)
            ->where(function ($query) use ($data) {
                $query->Where('lab.kodelab', 'LIKE', '%' . $data['cari'] . '%')
                    ->orWhere('lab.nama', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->orderBy('lab.updated_at', 'desc')
            ->paginate(10);
        return view('backend.master.lab', $data);
    }

    public function createView() {
        return view('backend.master.modal.laboratorium.create');
    }

    public function create(Request $request) {

        $request->validate([
            'kodelab' => 'required|min:3|alpha_dash|unique:lab,kodelab',
            'nama' => 'required|min:3',
            'keterangan' => 'required',
            'foto' => 'mimes:jpg,jpeg,png',
        ]);

        DB::beginTransaction();
        try {

            $date = Carbon::now()->format('YmdHis');
            $path = env('UPLOAD_PATH') . '/lab/';
//            $path = env('UPLOAD_PATH') . 'lab/';

            $data = $request->all();

            $data['foto'] = 'default.png';
            $data['created_by'] = Auth::id();
            if ($request->hasFile('foto')) {
                $ext = $request->file('foto')->getClientOriginalExtension();
                $filename = 'lab' . Auth::id() .'_'. $date .'.'. $ext;
                $request->file('foto')->move($path, $filename);
                $data['foto'] = $filename;
            }

            unset($data['_token']);

            Lab::create($data);
            DB::commit();

            $this->message('success', 'Lab berhasil ditambahkan.');
            return redirect()->route('backend.master.lablist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.lablist');
        }
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['lab'] = Lab::find($request->pid);

        if (!$data['lab']) {
            return "Tidak ada lab.";
        }

        return view('backend.master.modal.laboratorium.edit', $data);
    }

    public function edit(Request $request) {

        $request->validate([
            'idlab' => 'required|numeric',
            'fotolama' => 'required',
            'kodelab' => 'required|min:3|alpha_dash|unique:lab,kodelab,' . $request->idlab,
            'nama' => 'required|min:3',
            'keterangan' => 'required',
            'foto' => 'mimes:jpg,jpeg,png',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            $labId = $request->idlab;

            $date = Carbon::now()->format('YmdHis');
            $path = env('UPLOAD_PATH') . 'lab/';

            $data['foto'] = $request->fotolama;
            if ($request->hasFile('foto')) {
                $ext = $request->file('foto')->getClientOriginalExtension();
                $filename = 'lab' . Auth::id() .'_'. $date .'.'. $ext;
                $request->file('foto')->move($path, $filename);
                $data['foto'] = $filename;
            }

            unset($data['_token']);
            unset($data['idlab']);
            unset($data['fotolama']);

            Lab::where('id', $labId)->update($data);

            DB::commit();

            $this->message('success', 'Lab berhasil dirubah.');
            return redirect()->route('backend.master.lablist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.lablist');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        $lab = Lab::find($request->uid);
        $lab->delete();

        $this->message('success', 'Lab telah dihapus.');
        return redirect()->route('backend.master.lablist');
    }

}