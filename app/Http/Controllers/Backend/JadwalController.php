<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subject_notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TransaksiBooking\TransaksiBookingRepositoryInterface;
use App\Traits\FlashMessageTraits;
use App\Models\Transaksibooking;
use App\Models\Queuing;
use DB;
use Carbon\Carbon;
use Auth;

class JadwalController extends Controller {

    use FlashMessageTraits;

    protected
            $PAGE_LIMIT,
            $PASS_REGEX

    ;

    function __construct(
            TransaksiBookingRepositoryInterface $transaksiRepo
    ) {
        $this->transaksiRepo = $transaksiRepo;
        $this->PASS_REGEX = config('setting.pass.regex');
    }

    public function detailBooking($data) {
        $detail = $this->transaksiRepo->search('kodebooking', $data['cari'])
            ->with('user')
            ->with('keluarga')
            ->with('dokter')
            ->with('poliklinik')
            ->with('statusTransaksi')
            ->first();

        return $detail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function konfirmasi(Request $request) {
        //
        $data['cari'] = $request->get('cari');
        $data['transaksi'] = null;
        if ($data['cari']) {
            $data['transaksi'] = $this->detailBooking($data);
        }
        return view('backend.jadwal.konfirmasi', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function konfirmasiUlang(Request $request) {
        //
        $request->validate([
            'transaksi_id' => 'required|numeric',
            'status' => 'required|in:3,-1',
        ]);

        $data['cari'] = $request->search;

        Transaksibooking::where('id', $request->transaksi_id)
            ->update([
                'status' => $request->status,
                'updated_by' => Auth::id()
            ]);

        $this->message('success', 'Berhasil dikonfirmasi ulang.');
        return redirect()->route('backend.jadwal.konfirmasi', $data);
    }

    public function transaksi(Request $request) {
        //
        $data['cari'] = $request->get('cari');
        $data['transaksi'] = $this->transaksiRepo->list()
                ->select('iddokter', 'tanggalbooking', 'jampraktek_awal', 'jampraktek_akhir', DB::raw('COUNT(*) as jumlah'))
                ->with('dokter')
                ->with('poliklinik')
                ->where('status', 1)
                ->where(function ($query) use ($data) {
                    $query->Where('tanggalbooking', 'LIKE', '%' . $data['cari'] . '%');
//                    $query->Where('tanggalbooking', $data['cari']);
                })
                ->groupBy('iddokter', 'tanggalbooking', 'jampraktek_awal', 'jampraktek_akhir')
                ->paginate(10);

        return view('backend.jadwal.transaksi', $data);
    }

    public function transaksiSemua(Request $request) {
        //
        $data['cari'] = $request->get('cari');

        $data['transaksi'] = $this->transaksiRepo->list()
                ->select('iddokter', 'tanggalbooking', 'jampraktek_awal', 'jampraktek_akhir', DB::raw('COUNT(*) as jumlah'))
                ->with('dokter')
                ->with('poliklinik')
                ->where(function ($query) use ($data) {
                    $query->Where('tanggalbooking', 'LIKE', '%' . $data['cari'] . '%');
//                    $query->Where('tanggalbooking', $data['cari']);
                })
                ->groupBy('iddokter', 'tanggalbooking', 'jampraktek_awal', 'jampraktek_akhir')
                ->orderBy('tanggalbooking', 'desc')
                ->orderBy('jampraktek_awal', 'desc')
                ->paginate(10);
        return view('backend.jadwal.transaksi-semua', $data);
    }

    public function transaksiBatal(Request $request) {

        $request->validate([
            'iddokter' => 'required|numeric',
            'tanggalbooking' => 'required|date_format:Y-m-d',
            'jampraktek_awal' => 'required',
            'jampraktek_akhir' => 'required',
            'note' => 'required',
        ]);

        $iddokter = $request->iddokter;
        $tanggalbooking = $request->tanggalbooking;
        $jampraktek_awal = $request->jampraktek_awal;
        $jampraktek_akhir = $request->jampraktek_akhir;
        $note = $request->note;

        $transaksi = $this->transaksiRepo->list()
                ->where('iddokter', $iddokter)
                ->where('tanggalbooking', $tanggalbooking)
                ->where('jampraktek_awal', $jampraktek_awal)
                ->where('jampraktek_akhir', $jampraktek_akhir)
                ->where('status', 1)
                ->with('user')
                ->with('keluarga')
                ->with('dokter')
                ->get();

        foreach ($transaksi as $data) {
            $param = [
                'type' => [1, 2],
                'user_device_token' => $data->user->device_token,
                'telepon' => $data->user->telephone,
                'email' => $data->user->email,
                'subject' => 'Pembatalan booking klinik mutiara',
                'message' => "Booking anda dengan kode " . $data->kodebooking . " pada tanggal " . Carbon::parse($data->tanggalbooking)->format('d-m-Y') . " di jam " . $data->jampraktek_awal . " telah dibatalkan, dengan keterangan " . $note,
                'data' => '',
            ];

            $insertAntrian = Queuing::create(['data' => json_encode($param)]);

            $user = Transaksibooking::where('id', $data->id)->update([
                'status' => -1,
                'note' => $note
            ]);
        }

        $this->message('success', 'Jadwal berhasil dibatalkan.');
        return redirect()->route('backend.jadwal.transaksi');
    }

    public function transaksiPasien(Request $request) {
        $iddokter = $request->iddokter;
        $tanggalbooking = $request->tanggalbooking;
        $jampraktek_awal = $request->jampraktek_awal;
        $jampraktek_akhir = $request->jampraktek_akhir;

        $data['transaksi'] = $this->transaksiRepo->list()
                ->where('iddokter', $iddokter)
                ->where('tanggalbooking', $tanggalbooking)
                ->where('jampraktek_awal', $jampraktek_awal)
                ->where('jampraktek_akhir', $jampraktek_akhir)
                ->with('user')
                ->with('keluarga')
                ->where('status', 1)
                ->get();
        return view('backend.jadwal.listpasien', $data);
    }

    public function transaksiPasienSemua(Request $request) {
        $iddokter = $request->iddokter;
        $tanggalbooking = $request->tanggalbooking;
        $jampraktek_awal = $request->jampraktek_awal;
        $jampraktek_akhir = $request->jampraktek_akhir;

        $data['transaksi'] = $this->transaksiRepo->list()
                ->select('transaksibookings.kodebooking as kode_booking','keluarga.namalengkap as nama_keluarga','antrian.jam_kedatangan as jam_antrian','users.name as pemegang_akun','params.xs1 as status')
                ->where('iddokter', $iddokter)
                ->where('tanggalbooking', $tanggalbooking)
                ->where('jampraktek_awal', $jampraktek_awal)
                ->where('jampraktek_akhir', $jampraktek_akhir)
                ->leftJoin('users','users.id','transaksibookings.created_by')
                ->leftJoin('keluarga','keluarga.kode_keluarga','transaksibookings.kode_keluarga')
                ->leftJoin('antrian','antrian.kodebooking','transaksibookings.kodebooking')
                ->leftJoin('params', function ($join) {
                    $join->on('params.xn1', 'transaksibookings.status');
                    $join->whereRaw('params.keterangan = "statusBooking"');
                })
//                ->with('user')
//                ->with('keluarga')
//                ->with('statusTransaksi')
//                ->with('antrian')
                ->orderBy('antrian.jam_kedatangan', 'asc')
                ->get();

        return view('backend.jadwal.listpasien-semua', $data);
    }

    public function formNotifikasi(Request $request){
        $data = $request->all();
        $data['subject'] = Subject_notifikasi::where('status',1)->get();
        return view('backend.jadwal.formnotifikasi', $data);
    }

    public function kirimNotifikasi(Request $request){
        $request->validate([
            'iddokter' => 'required|numeric',
            'tanggalbooking' => 'required',
            'jampraktek_awal' => 'required',
            'jampraktek_akhir' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $iddokter = $request->iddokter;
        $tanggalbooking = $request->tanggalbooking;
        $jampraktek_awal = $request->jampraktek_awal;
        $jampraktek_akhir = $request->jampraktek_akhir;
        $subject = $request->subject;
        $message = $request->message;

        $judul = Subject_notifikasi::where('id', $subject)->first();

        $transaksi = $this->transaksiRepo->list()
            ->with('user')
            ->where('iddokter', $iddokter)
            ->where('tanggalbooking', $tanggalbooking)
            ->where('jampraktek_awal', $jampraktek_awal)
            ->where('jampraktek_akhir', $jampraktek_akhir)
            ->get();

        foreach ($transaksi as $data) {
            $param = [
                'type' => [1, 2],
                'user_device_token' => $data->user->device_token,
                'telepon' => $data->user->telephone,
                'email' => $data->user->email,
                'subject' => $judul->subject,
                'message' => $judul->subject.' - '.$message,
                'data' => '',
            ];

            Queuing::create(['data' => json_encode($param), 'idsubject_notifikasi' => $subject]);

        }

        $this->message('success', 'Notifikasi berhasil dikirim.');
        return redirect()->route('backend.jadwal.transaksisemua');
    }

    public function showPasien(Request $request) {
        $data['cari'] = $request->code;
        $data['transaksi'] = $this->detailBooking($data);

        if (!$data['transaksi']) {
            return "Tidak ada detail pasien.";
        }

        return view('backend.jadwal.show-pasien', $data);
    }

}
