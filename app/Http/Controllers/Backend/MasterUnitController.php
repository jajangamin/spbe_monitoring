<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lab;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FlashMessageTraits;
use DB;
use Carbon\Carbon;
use Auth;

class MasterUnitController
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
        $data['unit'] = Unit::where(function ($query) use ($data) {
            $query->Where('unit.id', 'LIKE', '%' . $data['cari'] . '%')
                ->orWhere('unit.nama_unit', 'LIKE', '%' . $data['cari'] . '%');
        })
            ->orderBy('unit.id', 'desc')
            ->paginate(10);

//        dd($data);
        return view('backend.master.unit', $data);
    }

    public function createView() {
        return view('backend.master.modal.unit.create');
    }

    public function create(Request $request) {
        $request->validate([
            'nama_unit' => 'required|min:3',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'nama_unit' => $request->nama_unit,
                'created_by' => Auth::id(),
            ];
            $unit = Unit::create($data);
            DB::commit();

            $this->message('success', 'Unit berhasil ditambahkan.');
            return redirect()->route('backend.master.unitlist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat menambahkan.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.unitlist');
        }
    }

    public function editView(Request $request) {
        $request->validate([
            'pid' => 'required|numeric',
        ]);

        $data['unit'] = Unit::find($request->pid);

        if (!$data['unit']) {
            return "Tidak ada unit.";
        }

        return view('backend.master.modal.unit.edit', $data);
    }

    public function edit(Request $request) {

        $request->validate([
            'idunit' => 'required|numeric',
            'nama_unit' => 'required|min:3',

        ]);

        DB::beginTransaction();
        try {

            $unitId = $request->idunit;
            $input = array(
                'nama_unit'=> $request->nama_unit,

            );

            Unit::where('id', $unitId)->update($input);

            DB::commit();

            $this->message('success', 'Unit berhasil dirubah.');
            return redirect()->route('backend.master.unitlist');
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            $debug = env('APP_DEBUG');
            if ($debug) {
                $message = $ex->getMessage();
            } else {
                $message = 'Ada yang salah saat memperbarui.';
            }
            $this->message('error', $message);
            return redirect()->route('backend.master.unitlist');
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'uid' => 'required|numeric',
        ]);

        $unit = Unit::find($request->uid);
        $unit->delete();

        $this->message('success', 'Unit telah dihapus.');
        return redirect()->route('backend.master.unitlist');
    }


}
