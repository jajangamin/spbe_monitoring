<?php

namespace App\Http\Controllers\Backend;


use App\Models\jenis;
use App\Models\kategori;
use App\Models\Lab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MasterJenisController
{
    use FlashMessageTraits;

    protected
        $PAGE_LIMIT,
        $PASS_REGEX
    ;

    function __construct() {
        $this->PASS_REGEX = config('setting.pass.regex');
    }

//    function index(Request $request) {
//        $data['cari'] = $request->get('cari');
//        $data['jenis'] = jenis::where(function ($query) use ($data) {
//            $query->Where('jenis.id', 'LIKE', '%' . $data['cari'] . '%')
//                ->orWhere('jenis.nama_jenis', 'LIKE', '%' . $data['cari'] . '%');
//        })
//            ->orderBy('jenis.updated_at', 'desc')
//            ->paginate(10);
//        return view('backend.master.jenis', $data);
//    }

    function index(Request $request) {
        $data['cari'] = $request->get('cari');
        $data['jenis'] = Jenis::
            select(
                'kategori.id',
                'kategori.nama_kategori as nama_kategori',
                'jenis.id',
                'jenis.nama_jenis as nama_jenis'
            )
            ->where(function ($query) use ($data) {
                $query->Where('kategori.nama_kategori', 'LIKE', '%' . $data['cari'] . '%')
                    ->orWhere('jenis.nama_jenis', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->join('kategori', 'kategori.id', 'jenis.idkategori')
            ->orderBy('jenis.id', 'DESC')
            ->orderBy('kategori.nama_kategori', 'ASC')
            ->orderBy('jenis.nama_jenis', 'ASC')
            ->paginate(10);
        return view('backend.master.jenis', $data);
    }






    public function createView() {
        $data['kategori'] = $this->kategoriList();

        return view('backend.master.modal.jenis.create',$data);
    }

    public function kategoriList()
    {
        $kategori = Kategori::get();

        return $kategori;
    }




    public function create(Request $request) {
        $request->validate([
            'nama_jenis' => 'required|min:3',
            'idkategori' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'nama_jenis' => $request->nama_jenis,
                'idkategori' => $request->idkategori,
                'created_by' => Auth::id(),
            ];
            $jenis = jenis::create($data);
            DB::commit();

            $this->message('success', 'jenis berhasil ditambahkan.');
            return redirect()->route('backend.master.jenislist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.jenislist');
        }
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['jenis'] = jenis::find($request->pid);
        $data['kategori'] = $this->kategoriList();

        if (!$data['jenis']) {
            return "Tidak ada jenis.";
        }

        return view('backend.master.modal.jenis.edit', $data);
    }

    public function edit(Request $request) {

        $request->validate([
            'nama_jenis' => 'required|min:3',
            'idkategori' => 'required|numeric',

        ]);

        DB::beginTransaction();
        try {

            $jenisId = $request->idjenis;
            $input = array(
                'nama_jenis'=> $request->nama_jenis,
                'idkategori'=> $request->idkategori,

            );

            Jenis::where('id', $jenisId)->update($input);

            DB::commit();

            $this->message('success', 'jenis berhasil dirubah.');
            return redirect()->route('backend.master.jenislist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.jenislist');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        $jenis = jenis::find($request->uid);
        $jenis->delete();

        $this->message('success', 'jenis telah dihapus.');
        return redirect()->route('backend.master.jenislist');
    }


}
