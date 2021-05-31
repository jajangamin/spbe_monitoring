<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lab;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MasterKategoriController
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
        $data['kategori'] = Kategori::where(function ($query) use ($data) {
                $query->Where('kategori.id', 'LIKE', '%' . $data['cari'] . '%')
                    ->orWhere('kategori.nama_kategori', 'LIKE', '%' . $data['cari'] . '%');
            })
            ->orderBy('kategori.id', 'DESC')
            ->paginate(10);
        return view('backend.master.kategori', $data);
    }

    public function createView() {
        return view('backend.master.modal.kategori.create');
    }

    public function create(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|min:3',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'nama_kategori' => $request->nama_kategori,
                'created_by' => Auth::id(),
            ];
            $kategori = Kategori::create($data);
            DB::commit();

            $this->message('success', 'Kategori berhasil ditambahkan.');
            return redirect()->route('backend.master.kategorilist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.kategorilist');
        }
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['kategori'] = Kategori::find($request->pid);

        if (!$data['kategori']) {
            return "Tidak ada kategori.";
        }

        return view('backend.master.modal.kategori.edit', $data);
    }

    public function edit(Request $request) {

        $request->validate([
            'idkategori' => 'required|numeric',
            'nama_kategori' => 'required|min:3',

        ]);

        DB::beginTransaction();
        try {

            $kategoriId = $request->idkategori;
            $input = array(
                'nama_kategori'=> $request->nama_kategori,

            );

            Kategori::where('id', $kategoriId)->update($input);

            DB::commit();

            $this->message('success', 'Kategori berhasil dirubah.');
            return redirect()->route('backend.master.kategorilist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.kategorilist');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        $kategori = Kategori::find($request->uid);
        $kategori->delete();

        $this->message('success', 'Kategori telah dihapus.');
        return redirect()->route('backend.master.kategorilist');
    }


}
