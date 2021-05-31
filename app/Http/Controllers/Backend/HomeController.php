<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Jaringan;
use App\Models\Mserver;
use App\Models\Mjaringan;
use App\Models\Maplikasi;



use Cassandra\Map;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $data['pilyear2'] =date("Y-m");
        $pilyear= $request->get('pilyear');
        $tahunini =   date("Y");

//        print $data['cari'];
//        die;

        if($pilyear==''){

            $grafharian = (date("d"));
            $graftahun = (date("Y"));
            $grafmonth = (date("m"));
            $data['bulan_ini']=$grafmonth;
            $data['tahun_ini']=$graftahun;

        }else{

            $data['pilyear2']=$pilyear;
            $grafharian = (date("d"));

            $graftahun =   substr($pilyear,0,4);
            $grafmonth = substr($pilyear,5,2);
            $grafharian = cal_days_in_month(CAL_GREGORIAN, $grafmonth, $graftahun);
            $data['bulan_ini']=$grafmonth;
            $data['tahun_ini']=$graftahun;
//
        }

//        print $pilyear2;
//            die;




        $data['totaplikasi_kominfo'] = Aplikasi::where('server','Diskominfo')->distinct('link')->count('link');
        $data['totaplikasi_non'] = Aplikasi::where('server', '<>','Diskominfo')->count('id');

//        $data['totjaringan'] = Jaringan::sum('id');
        $data['totjaringan'] = Jaringan::count('id');


        $databulanan = Maplikasi::
        select(DB::raw(
            'MONTH(tgl_error) AS bulan'),
            DB::raw('COUNT(*) AS jumlah_bulanan')
        )

            ->groupBy('bulan')
            ->limit(2)

        ->orderBy('bulan', 'DESC')
        ->get();
//

//data monitaplikasi
        $data['maplikasimonth'] = [];
        $data['listaplikasimonth'] = [];
//        $data['totalaplikasi'] = [];
//        $data['totalaplikasi'] = 0;
        $totmonaplikasi=0;
        for ($x = 2; $x >= 0; $x--) {
            $mbulanan = (date("m")) - $x;
            $aplikasi2 = Maplikasi:: select(DB::raw(
                'COUNT(*) AS jumlah_bulanan')
            )
                ->whereMonth('tgl_error','=',$mbulanan)
                ->whereYear('tgl_error','=',$tahunini)
                ->first();
            if ($aplikasi2) {
                $hasilaplikasi = $aplikasi2['jumlah_bulanan'];
                $totmonaplikasi=$hasilaplikasi+$totmonaplikasi;
            } else {
                $hasilaplikasi = 0;
            }

            array_push($data['maplikasimonth'], $hasilaplikasi);
            array_push($data['listaplikasimonth'], $hasilaplikasi);
        }
//dataharian
        $mbulanan = (date('Y-m-d')) ;
         $data['maplikasinow']  = Maplikasi:: select(DB::raw(
            'COUNT(*) AS jumlah_harian')
        )
            ->whereDate('tgl_error','=',$mbulanan)
            ->first();

        $data['totmonaplikasi'] =$totmonaplikasi;
        $data['maplikasimonth'] = json_encode($data['maplikasimonth']);

//data jaringan
        $data['mjaringanmonth'] = [];
        $data['listjaringanmonth'] = [];
        $totmonjaringan=0;
        for ($x = 2; $x >= 0; $x--) {
            $mbulanan = (date("m")) - $x;
            $jaringan2 = Mjaringan:: select(DB::raw(
                'COUNT(*) AS jumlah_bulanan')
            )
                ->whereMonth('tgl_error','=',$mbulanan)
                ->whereYear('tgl_error','=',$tahunini)
                ->first();
            if ($jaringan2) {
                $hasiljaringan = $jaringan2['jumlah_bulanan'];
                $totmonjaringan=$hasiljaringan+$totmonjaringan;
            } else {
                $hasiljaringan = 0;
            }

            array_push($data['mjaringanmonth'], $hasiljaringan);
            array_push($data['listjaringanmonth'], $hasiljaringan);
        }

        $mbulanan = (date('Y-m-d')) ;
        $data['mjaringannow']  = Mjaringan:: select(DB::raw(
            'COUNT(*) AS jumlah_harian')
        )
            ->whereDate('tgl_error','=',$mbulanan)
            ->first();

        $data['totmonjaringan'] =$totmonjaringan;
        $data['mjaringanmonth'] = json_encode($data['mjaringanmonth']);

//print $data['mjaringanmonth'] ;

        //data server
        $data['mservermonth'] = [];
        $data['listservermonth'] = [];
        $totmonserver=0;
        for ($x = 2; $x >= 0; $x--) {
            $mbulanan = (date("m")) - $x;
            $server2 = Mserver:: select(DB::raw(
                'COUNT(*) AS jumlah_bulanan')
            )
                ->whereMonth('tgl_error','=',$mbulanan)
                ->whereYear('tgl_error','=',$tahunini)
                ->first();
            if ($server2) {
                $hasilserver = $server2['jumlah_bulanan'];
                $totmonserver=$hasilserver+$totmonserver;
            } else {
                $hasilserver = 0;
            }

            array_push($data['mservermonth'], $hasilserver);
            array_push($data['listservermonth'], $hasilserver);
        }

        $mbulanan = (date('Y-m-d')) ;
        $data['mservernow']  = Mserver:: select(DB::raw(
            'COUNT(*) AS jumlah_harian')
        )
            ->whereDate('tgl_error','=',$mbulanan)
            ->first();

        $data['totmonserver'] =$totmonserver;
        $data['mservermonth'] = json_encode($data['mservermonth']);


//        /data harian aplikasi
        $data['apharian'] = [];
        $data['hari'] = [];
        for ($x=1; $x<= $grafharian; $x++) {
            $dataharian = Maplikasi:: select(DB::raw(
                'COUNT(*) AS jumlah_harian')
            )
                ->whereYear('tgl_error','=',$graftahun)
                ->whereMonth('tgl_error','=',$grafmonth)
                ->whereDay('tgl_error','=',$x)
                ->first();

//            print $dataharian;
            if ($dataharian) {
                $hasilharian = $dataharian['jumlah_harian'];

            } else {
                $hasilharian = 0;
            }

           array_push($data['apharian'], $hasilharian);
            array_push($data['hari'], [$x]);

        }
        $data['apharian'] = json_encode($data['apharian']);
        $data['hari'] = json_encode($data['hari']);


//        /data harian Jaringan
        $data['jaharian'] = [];
        for ($x=1; $x<= $grafharian; $x++) {
            $dataharianja = Mjaringan:: select(DB::raw(
                'COUNT(*) AS jumlah_harian')
            )
                ->whereYear('tgl_error','=',$graftahun)
                ->whereMonth('tgl_error','=',$grafmonth)
                ->whereDay('tgl_error','=',$x)
                ->first();
//            print $dataharian;
            if ($dataharianja) {
                $hasilharianja = $dataharianja['jumlah_harian'];

            } else {
                $hasilharianja = 0;
            }
            array_push($data['jaharian'], $hasilharianja);
        }
        $data['jaharian'] = json_encode($data['jaharian']);

//        /data harian Server
        $data['serharian'] = [];
        for ($x=1; $x<= $grafharian; $x++) {
            $dataharianser = Mserver:: select(DB::raw(
                'COUNT(*) AS jumlah_harian')
            )
                ->whereYear('tgl_error','=',$graftahun)
                ->whereMonth('tgl_error','=',$grafmonth)
                ->whereDay('tgl_error','=',$x)
                ->first();
//            print $dataharian;
            if ($dataharianser) {
                $hasilharianser = $dataharianser['jumlah_harian'];

            } else {
                $hasilharianja = 0;
            }
            array_push($data['serharian'], $hasilharianser);
        }
        $data['serharian'] = json_encode($data['serharian']);




//die;

//end

        return view('backend.home', $data);
    }
}
