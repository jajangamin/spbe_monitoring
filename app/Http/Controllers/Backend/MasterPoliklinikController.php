<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Poliklinik\PoliklinikRepositoryInterface;
use App\Traits\FlashMessageTraits;
use App\Models\Poliklinik;
use DB;
use Carbon\Carbon;
use Auth;

class MasterPoliklinikController extends Controller {

    use FlashMessageTraits;

    protected
            $PAGE_LIMIT,
            $PASS_REGEX

    ;

    function __construct(
            PoliklinikRepositoryInterface $poliklinikRepo
    ) {
        $this->poliklinikRepo = $poliklinikRepo;
        $this->PASS_REGEX = config('setting.pass.regex');
    }

    function index(Request $request) {
        $data['cari'] = $request->get('cari');
        $data['poliklinik'] = $this->poliklinikRepo->list()
                ->select(
                        'poliklinik.id as poli_id',
                        'poliklinik.kodepoli as poli_code',
                        'poliklinik.namapoliklinik as poli_name',
                        'poliklinik.interval_antrian as interval_antrian',
                        'poliklinik.keterangan as poli_description'
                )
                ->where('status', 1)
                ->where(function ($query) use ($data) {
                    $query->Where('poliklinik.kodepoli', 'LIKE', '%' . $data['cari'] . '%')
                    ->orWhere('poliklinik.namapoliklinik', 'LIKE', '%' . $data['cari'] . '%');
                })
                ->orderBy('poliklinik.created_at', 'desc')
                ->paginate(10);
        return view('backend.master.poliklinik', $data);
    }

    public function createView() {
        return view('backend.master.modal.poliklinik.create');
    }

    public function create(Request $request) {
        $request->validate([
            'poli_code' => 'required|min:3|alpha_dash|unique:poliklinik,kodepoli',
            'poli_name' => 'required|min:3',
            'interval_antrian' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'kodepoli' => strtoupper($request->poli_code),
                'namapoliklinik' => $request->poli_name,
                'interval_antrian' => $request->interval_antrian,
                'keterangan' => $request->poli_description,
                'created_by' => Auth::id(),
            ];
            $poliklinik = Poliklinik::create($data);
            DB::commit();

            $this->message('success', 'Poliklinik berhasil ditambahkan.');
            return redirect()->route('backend.master.polilist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.polilist');
        }
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['poliklinik'] = Poliklinik::find($request->pid);

        if (!$data) {
            return "Tidak ada data poliklinik.";
        }

        return view('backend.master.modal.poliklinik.edit', $data);
    }

    public function edit(Request $request) {
        $rules = [
            'poli_id' => 'required|numeric',
            'poli_code' => 'required|min:3|alpha_dash|unique:poliklinik,kodepoli,' . $request->poli_id,
            'poli_name' => 'required|min:3',
            'interval_antrian' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        DB::beginTransaction();
        try {
            $data = [
                'kodepoli' => strtoupper($request->poli_code),
                'namapoliklinik' => $request->poli_name,
                'interval_antrian' => $request->interval_antrian,
                'keterangan' => $request->poli_description,
            ];

            $poliklinik = Poliklinik::where('id', $request->poli_id)->update($data);

            DB::commit();

            $this->message('success', 'Poliklinik berhasil dirubah.');
            return redirect()->route('backend.master.polilist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.polilist');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        Poliklinik::where('id', $request->uid)
                ->update(['status' => 0]);

        $this->message('success', 'Poliklinik telah dihapus.');
        return redirect()->route('backend.master.polilist');
    }

}
