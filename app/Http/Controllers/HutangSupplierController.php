<?php

namespace App\Http\Controllers;

use App\Models\HutangSupplier;
use App\Models\pelunasanHutangSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HutangSupplierController extends Controller
{
    public function pelunasanHutang()
    {
        // KD HUTANG
        $numb = str_pad(000001, 6, 0, STR_PAD_LEFT);
        $Yr = date("Y");
        $Mh = date("m");
        $cekids = pelunasanHutangSupplier::count();
        if ($cekids == 0) {
            $noRefTL =  'TL'  . '-' . substr($Yr, -2) . $Mh . '-' . $numb;
        } else {
            $continues = pelunasanHutangSupplier::all()->last();
            $getKd = substr($continues->pl_kd_pelunasan, -6);
            $noRefTL = 'TL' . '-' . substr($Yr, -2) . $Mh  . '-' . str_pad(($getKd + 1), 6, '0', STR_PAD_LEFT);
        };

        $listHutangSupplier = DB::table('hutang_supplier')->where('isLunas', '=', '0')->get();

        $dateNow = Carbon::now()->format("Y-m-d");

        return view(
            'Pages.keu.pelunasan-hutang',
            [
                'noRefTL' => $noRefTL,
                'dateNow' => $dateNow,
                'listHutangSupplier' => $listHutangSupplier
            ]
        );
    }

    public function getListHutang()
    {

        if (request()->ajax()) {
            $listHutangSuppliers = DB::table('hutang_supplier')->where('isLunas', '=', '0')->get();
            // dd($listHutangSupplier);
            return DataTables::of($listHutangSuppliers)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" id="' . $row->hs_kd_hutang . '" onClick="SelectItemHutang(this)" data-kdtrs="' . $row->hs_kd_hutang_buat . '"
                    data-no_faktur="' . $row->hs_no_faktur . '" data-tgl_hutang="' . $row->hs_tanggal_hutang . '" data-hutang_awal="' . $row->hs_nilai_hutang . '" data-supplier="' . $row->hs_supplier . '"
                    data-kd_hutang="' . $row->hs_kd_hutang . '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($listHutangSuppliers);
        }
    }

    public function pelunasanCreate(Request $request)
    {
        // $k = $request->all();
        // dd($k);

        // $request->validate([
        //     // 'tgl_trs' => 'required',
        //     // 'kd_obat' => 'required',
        //     // 'nm_obat' => 'required',
        //     // 'hrg_obat' => 'required',
        //     // 'qty' => 'required',
        // ]);

        DB::beginTransaction();
        // try {
        // foreach ($request->pl_kd_hutang as $key => $xf) {
        //     $tpdetail = [
        //         'pl_kd_pelunasan' => $request->pl_kd_pelunasan,
        //         'pl_tanggal_trs' => $request->pl_tanggal_trs,
        //         'pl_no_kuitansi' => $request->pl_no_kuitansi,
        //         'pl_kd_hutang' => $request->pl_kd_hutang[$key],
        //         'pl_kd_hutang_buat' => $request->pl_kd_hutang_buat[$key],
        //         'pl_no_faktur' => $request->pl_no_faktur[$key],
        //         'pl_supplier' => $request->pl_supplier[$key],
        //         'pl_kd_rekening' => '',
        //         'pl_nilai_hutang' => $request->pl_hutang_awal[$key],
        //         'pl_pembayaran' => $request->pl_pembayaran[$key],
        //         'pl_potongan' => $request->pl_potongan[$key],
        //         'pl_hutang_akhir' => $request->pl_hutang_akhir[$key],
        //         'pl_tanggal_hutang' => $request->pl_tanggal_hutang[$key],
        //         'pl_tanggal_pelunasan' => $request->pl_tanggal_trs,
        //         'pl_tanggal_tempo' => '',
        //         'pl_cara_bayar' => '',
        //         'tgl_trs' => $request->pl_tanggal_trs,
        //         'user' => Auth::user()->name,
        //     ];
        //     pelunasanHutangSupplier::create($tpdetail);
        // }

        $tpdetail = [
            'pl_kd_pelunasan' => $request->pl_kd_pelunasan,
            'pl_tanggal_trs' => $request->pl_tanggal_trs,
            'pl_no_kuitansi' => $request->pl_no_kuitansi,
            'pl_kd_hutang' => $request->pl_kd_hutang,
            'pl_kd_hutang_buat' => $request->pl_kd_hutang_buat,
            'pl_no_faktur' => $request->pl_no_faktur,
            'pl_supplier' => $request->pl_supplier,
            'pl_kd_rekening' => '',
            'pl_nilai_hutang' => $request->pl_hutang_awal,
            'pl_pembayaran' => $request->pl_pembayaran,
            'pl_potongan' => $request->pl_potongan,
            'pl_hutang_akhir' => $request->pl_hutang_akhir,
            'pl_tanggal_hutang' => $request->pl_tanggal_hutang,
            'pl_tanggal_pelunasan' => $request->pl_tanggal_trs,
            'pl_tanggal_tempo' => '',
            'pl_cara_bayar' => '',
            'tgl_trs' => $request->pl_tanggal_trs,
            'user' => Auth::user()->name,
        ];
        pelunasanHutangSupplier::create($tpdetail);

        DB::table('hutang_supplier')
            ->where('hs_kd_hutang', $request->pl_kd_hutang)
            ->update([
                'isLunas' => "1",
                'hs_pembayaran' => $request->pl_pembayaran,
                'hs_potongan' => $request->pl_potongan,
                'hs_hutang_akhir' => $request->pl_hutang_akhir,
            ]);


        DB::commit();

        $sessionFlash = [
            'message' => 'Saved!',
            'alert-type' => 'success'
        ];

        return Redirect::to('/pelunasan-hutang')->with($sessionFlash);
        // } catch (\Exception $e) {
        DB::rollback();

        $sessionFlashErr = [
            'message' => 'Some Error Occured!',
            'alert-type' => 'error'
        ];
        return Redirect::to('/pelunasan-hutang')->with($sessionFlashErr);
        // }
    }

    public function getMonthPelunasan(Request $request)
    {
        $selectMonth = $request->dataBulan;
        // dd($selectMonth);
        if (!$selectMonth) {
            $monthNow = Carbon::now()->format("m");
            $yearNow = Carbon::now()->format("Y");
            $isListPelunasan = pelunasanHutangSupplier::whereyear('pl_tanggal_trs', '=', $yearNow)->whereMonth('pl_tanggal_trs', '=', $monthNow)->latest('pl_tanggal_trs')->get();
        } else {
            $isListPelunasan = pelunasanHutangSupplier::where('pl_tanggal_trs', 'LIKE', '%' . $selectMonth . '%')->latest('pl_tanggal_trs')->get();
        }

        return DataTables::of($isListPelunasan)
            ->addColumn('action', function ($row) {
                $actionBtn =
                    //  '
                    // <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#EditObat"
                    // onclick="getDetailPen(this)" data-kd_trs="' . $row->kd_trs . '">&nbsp;&nbsp;<i class="fa fa-info">&nbsp;&nbsp;</i></button>
                    // <button class="btn btn-xs btn-primary" data-toggle="modal" data-target=""
                    // onclick="EditTrs(this);validasiTrs(this);" data-kd_trsu="' . $row->kd_trs . '"><i class="fa fa-edit"></i></button>
                    // <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#EditObat"
                    // onclick="cetakNota(this)" data-kd_trsc="' . $row->kd_trs . '" target="_blank"> <i class="fa fa-print"></i> </button>
                    //  <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=""
                    // onclick="DeleteTrs(this);" data-kd_trsu="' . $row->kd_trs . '"><i class="fa fa-trash"></i></button>
                    // ';
                    '';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    function infoHutang()
    {
        $isSupplier = DB::table('hutang_supplier')->select('hs_supplier')->distinct()->get();
        return view('Pages.keu.info-hutang', ['isSupplier' => $isSupplier]);
    }

    function getInfoHutang(Request $request)
    {
        $start = $request->date1;
        $end = $request->date2;
        $supplier = $request->supplier;
        if ($request->ajax()) {
            if ($supplier) {
                $isDataHutang = DB::table('hutang_supplier')
                    // ->leftJoin('pelunasan_hutang_supplier', 'hutang_supplier.hs_kd_hutang', 'pelunasan_hutang_supplier.pl_kd_hutang')
                    ->whereBetween('hs_tanggal_trs', [$start, $end])
                    ->where([
                        ['hs_supplier', '=', $supplier],
                        // ['trs_chart.deleted_at', '=', null],
                    ])
                    ->get();
            } else {
                $isDataHutang = DB::table('hutang_supplier')
                    // ->leftJoin('pelunasan_hutang_supplier', 'hutang_supplier.hs_kd_hutang', 'pelunasan_hutang_supplier.pl_kd_hutang')
                    ->whereBetween('hs_tanggal_trs', [$start, $end])
                    ->get();
            }
        }
        return response()->json($isDataHutang);
    }
}
