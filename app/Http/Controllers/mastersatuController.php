<?php

namespace App\Http\Controllers;

use App\Models\jenis_pemeriksaan_lab_detail;
use App\Models\jenis_pemeriksaan_lab_hdr;
use App\Models\mstr_dokter;
use App\Models\mstr_jaminan;
use App\Models\mstr_tindakan;
use Illuminate\Http\Request;
use App\Models\mstr_layanan;
use App\Models\mstr_nilai_tindakan;
use App\Models\satuan_pemeriksaan_lab;
use App\Models\t_template_order_detail;
use App\Models\t_template_order_hdr;
use App\Models\tarif_lab_detail;
use App\Models\tarif_lab_hdr;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Facades\DataTables;

class mastersatuController extends Controller
{
    public function layanan()
    {
        $num = str_pad(001, 3, 0, STR_PAD_LEFT);

        $cekid = mstr_layanan::count();
        if ($cekid == 0) {
            $kd_layanan = 'LA' . $num;
        } else {
            $continue = mstr_layanan::all()->last();
            $de = substr($continue->fm_kd_layanan, -3);
            $kd_layanan = 'LA' . str_pad($de + 1, 3, '0', STR_PAD_LEFT);
            // dd($kd_layanan);
        }

        $isview = mstr_layanan::all();

        return view('pages.mstr1.mstr-layanan', ['kd_layanan' => $kd_layanan], ['isview' => $isview]);
    }

    public function layananCreate(Request $request)
    {
        $request->validate([
            'fm_kd_layanan' => 'required',
            'fm_nm_layanan' => 'required',
        ]);

        $data = mstr_layanan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }

    public function viewLayanan()
    {
        $isview = mstr_layanan::all();

        // return view('pages.mstr1.mstr-layanan', ['isview' => $isview]);
        // return DataTables::of($isview)->Make(true);
    }

    public function medis()
    {
        $isview = mstr_dokter::all();
        $isviewlayanan = mstr_layanan::all();

        return view('pages.mstr1.mstr-medis', ['isview' => $isview], ['islayanan' => $isviewlayanan]);
    }

    public function DokterCreate(Request $request)
    {
        $request->validate([
            'fm_kd_medis' => 'required',
            'fm_nm_medis' => 'required',
            'fm_sip_medis' => 'required',
            'fm_kadaluarsa_sip' => 'required',
            'fm_layanan' => 'required',
            'fm_nik' => 'fm_nik',
        ]);

        $data = mstr_dokter::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function jaminan()
    {
        $isjaminan = mstr_jaminan::all();

        return view('pages.mstr1.mstr-jaminan', ['isjaminan' => $isjaminan]);
    }

    public function jaminanCreate(Request $request)
    {
        $request->validate([
            'fm_kd_jaminan' => 'required',
            'fm_nm_jaminan' => 'required',
        ]);

        $data = mstr_jaminan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function tindakan()
    {
        $istindakan = mstr_tindakan::all();

        return view('pages.mstr1.mstr-tindakan', ['istindakan' => $istindakan]);
    }

    public function tindakanCreate(Request $request)
    {
        $request->validate([
            'nm_tindakan' => 'required',
            // 'tarif_tindakan' => 'required',
        ]);

        $data = mstr_tindakan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function nilaiTindakan()
    {
        $isnilaitindakan = DB::table('mstr_nilai_tindakan')->leftJoin('mstr_tindakan', 'mstr_nilai_tindakan.id_tindakan', 'mstr_tindakan.id')->select('mstr_nilai_tindakan.*', 'mstr_tindakan.*')->get();
        // dd($isnilaitindakan);
        $istindakan = mstr_tindakan::all();

        return view('pages.mstr1.mstr-nilai-tindakan', ['isnilaitindakan' => $isnilaitindakan, 'istindakan' => $istindakan]);
    }

    public function nilaiTindakanCreate(Request $request)
    {
        $request->validate([
            'id_tindakan' => 'required',
            // 'nm_tindakan' => 'required',
            'nilai_tarif' => 'required',
        ]);

        $data = mstr_nilai_tindakan::create($request->all());

        if ($data->save()) {
            toastr()->success('Data Tersimpan!');
            return back();
        } else {
            toast('Gagal Tersimpan!', 'error')->autoClose(5000);
            return back();
        }
    }

    public function templateResep()
    {
        $num = str_pad(001, 3, 0, STR_PAD_LEFT);

        $cekid = t_template_order_hdr::count();
        if ($cekid == 0) {
            $kdTo = 'TO' . $num;
        } else {
            $continue = t_template_order_hdr::all()->last();
            $de = substr($continue->kd_to, -3);
            $kdTo = 'TO' . str_pad($de + 1, 3, '0', STR_PAD_LEFT);
        }
        $getAllTemplate = DB::table('t_template_order_hdr')->get();
        return view('pages.mstr1.template-resep', [
            'kdTo' => $kdTo,
            'getAllTemplate' => $getAllTemplate,
        ]);
    }

    public function addTemplateResep(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kd_to' => 'required',
            'nm_to' => 'required',
            'kd_obat_to' => 'required',
            'nm_obat_to' => 'required',
            'hrg_obat_to' => 'required',
            'qty_to' => 'required',
        ]);

        DB::beginTransaction();
        // try {

        $toHdr = new t_template_order_hdr();
        $toHdr->kd_to = $request->kd_to;
        $toHdr->nm_to = $request->nm_to;
        $toHdr->to_user = Auth::user()->name;
        $toHdr->save();

        foreach ($request->kd_obat_to as $key => $xf) {
            $todetail = [
                'kd_to' => $request->kd_to,
                'kd_obat_to' => $request->kd_obat_to[$key],
                'nm_obat_to' => $request->nm_obat_to[$key],
                'hrg_obat_to' => $request->hrg_obat_to[$key],
                'qty_to' => $request->qty_to[$key],
                'satuan_to' => $request->satuan_to[$key],
                'signa_to' => $request->signa_to[$key],
                'cara_pakai_to' => $request->cara_pakai_to[$key],
            ];
            t_template_order_detail::create($todetail);
        }

        DB::commit();

        toastr()->success('Data Tersimpan!');
        return back();
        // return redirect()->route('/tindakan-medis');
        // } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Gagal Tersimpan!');
        return back();
        // }
    }

    public function getDetailTemplate(request $Request)
    {
        $getDetailTemp = DB::table('t_template_order_hdr')
            ->leftJoin('t_template_order_detail', 't_template_order_detail.kd_to', 't_template_order_hdr.kd_to')
            ->where('t_template_order_hdr.kd_to', $Request->kdto)
            ->get();
        return response()->json($getDetailTemp);
    }

    public function editTemplateResep(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kd_to' => 'required',
            'nm_to' => 'required',
            'kd_obat_to' => 'required',
            'nm_obat_to' => 'required',
            'hrg_obat_to' => 'required',
            'qty_to' => 'required',
        ]);

        DB::beginTransaction();
        try {
            DB::table('t_template_order_hdr')
                ->where('kd_to', $request->kd_to)
                ->update([
                    'nm_to' => $request->nm_to,
                    'to_user' => Auth::user()->name,
                ]);

            DB::table('t_template_order_detail')
                ->where('kd_to', $request->kd_to)
                ->delete();

            foreach ($request->kd_obat_to as $key => $xf) {
                $todetail = [
                    'kd_to' => $request->kd_to,
                    'kd_obat_to' => $request->kd_obat_to[$key],
                    'nm_obat_to' => $request->nm_obat_to[$key],
                    'hrg_obat_to' => $request->hrg_obat_to[$key],
                    'qty_to' => $request->qty_to[$key],
                    'satuan_to' => $request->satuan_to[$key],
                    'signa_to' => $request->signa_to[$key],
                    'cara_pakai_to' => $request->cara_pakai_to[$key],
                ];
                t_template_order_detail::create($todetail);
            }
            // foreach ($request->kd_obat_to as $key => $xf) {
            //     DB::table('t_template_order_detail')->where('kd_to', $request->kd_to)->update([
            //         'kd_to'         => $request->kd_to,
            //         'kd_obat_to'    => $request->kd_obat_to[$key],
            //         'nm_obat_to'    => $request->nm_obat_to[$key],
            //         'hrg_obat_to'   => $request->hrg_obat_to[$key],
            //         'qty_to'        => $request->qty_to[$key],
            //         'satuan_to'     => $request->satuan_to[$key],
            //         'signa_to'      => $request->signa_to[$key],
            //         'cara_pakai_to' => $request->cara_pakai_to[$key],
            //     ]);
            // }

            DB::commit();

            toastr()->success('Data Tersimpan!');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function deleteTemplateResep(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kd_to' => 'required',
        ]);

        DB::beginTransaction();
        try {
            DB::table('t_template_order_hdr')
                ->where('kd_to', $request->kd_to)
                ->delete();
            DB::table('t_template_order_detail')
                ->where('kd_to', $request->kd_to)
                ->delete();

            DB::commit();

            toastr()->success('Deleted!');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Some Error Occured!');
            return back();
        }
    }

    public function satuanPemeriksaanLab()
    {
        // $num = str_pad(001, 3, 0, STR_PAD_LEFT);

        // $cekid = mstr_layanan::count();
        // if ($cekid == 0) {
        //     $kd_layanan =  'ST'  . $num;
        // } else {
        //     $continue = mstr_layanan::all()->last();
        //     $de = substr($continue->fm_kd_layanan, -3);
        //     $kd_layanan = 'LA' . str_pad(($de + 1), 3, '0', STR_PAD_LEFT);
        // }

        $isview = satuan_pemeriksaan_lab::all();

        return view('pages.mstr1.satuan-pemeriksaan-lab', ['isview' => $isview]);
    }

    public function addSatuanPemeriksaan(Request $request)
    {
        $request->validate([
            'nm_satuan' => 'required',
        ]);

        satuan_pemeriksaan_lab::create($request->all());
    }

    public function jenisPemeriksaanLab()
    {
        $num = str_pad(001, 3, 0, STR_PAD_LEFT);

        $cekid = jenis_pemeriksaan_lab_hdr::count();
        if ($cekid == 0) {
            $kd_jenis = 'JL' . $num;
        } else {
            $continue = jenis_pemeriksaan_lab_hdr::all()->last();
            $de = substr($continue->kd_jenis_pemeriksaan_lab, -3);
            $kd_jenis = 'JL' . str_pad($de + 1, 3, '0', STR_PAD_LEFT);
        }

        $isview = jenis_pemeriksaan_lab_hdr::all();
        $satuan = satuan_pemeriksaan_lab::all();

        return view('pages.mstr1.jenis-pemeriksaan-lab', ['kd_jenis' => $kd_jenis, 'satuan' => $satuan, 'isData' => $isview]);
    }

    public function addJenisPemeriksaan(Request $request)
    {
        $request->validate([
            'kd_jenis_pemeriksaan' => 'required',
            'nm_jenis_pemeriksaan' => 'required',
            'satuan_hasil' => 'required',
            'ket_normal' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $newData = [
                'kd_jenis_pemeriksaan_lab' => $request->kd_jenis_pemeriksaan,
                'nm_jenis_pemeriksaan_lab' => $request->nm_jenis_pemeriksaan,
                'satuan_hasil' => $request->satuan_hasil,
                'grup_periksa_sub' => $request->grup_periksa_sub,
                'metode_uji' => $request->metode_uji,
                'user' => Auth::user()->name,
            ];
            jenis_pemeriksaan_lab_hdr::create($newData);

            foreach ($request->jenis_kelamin as $key => $xf) {
                $tpdetail = [
                    'kd_jenis_pemeriksaan_lab' => $request->kd_jenis_pemeriksaan,
                    'jenis_kelamin' => $request->jenis_kelamin[$key],
                    'batas_atas' => $request->batas_atas[$key],
                    'batas_bawah' => $request->batas_bawah[$key],
                    'ket_normal' => $request->ket_normal[$key],
                ];
                jenis_pemeriksaan_lab_detail::create($tpdetail);
            }
            DB::commit();
            toastr()->success('Data Tersimpan!');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }

    public function tarifLaboratorium()
    {
        $num = str_pad(0001, 4, 0, STR_PAD_LEFT);

        $cekid = tarif_lab_hdr::count();
        if ($cekid == 0) {
            $kd_tarif = 'LAB' . $num;
        } else {
            $continue = tarif_lab_hdr::all()->last();
            $de = substr($continue->kd_tarif, -4);
            $kd_tarif = 'LAB' . str_pad($de + 1, 4, '0', STR_PAD_LEFT);
        }

        $isview = tarif_lab_hdr::all();

        return view('pages.mstr1.tarif-laboratorium', ['kd_tarif' => $kd_tarif, 'isData' => $isview]);
    }

    public function getListJenisPemeriksaan()
    {
        if (request()->ajax()) {
            $isKomponenLab = DB::table('jenis_pemeriksaan_lab_hdr')
                // ->leftJoin('jenis_pemeriksaan_lab_detail', 'jenis_pemeriksaan_lab_hdr.kd_jenis_pemeriksaan_lab', 'jenis_pemeriksaan_lab_detail.kd_jenis_pemeriksaan_lab')
                // ->select('jenis_pemeriksaan_lab_hdr.*', 'jenis_pemeriksaan_lab_detail.*')
                ->get();
            return DataTables::of($isKomponenLab)
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        '<a href="javascript:void(0)" id="' .
                        $row->kd_jenis_pemeriksaan_lab .
                        '" onClick="SelectItem(this)"
                    data-kdpemeriksaan="' .
                        $row->kd_jenis_pemeriksaan_lab .
                        '"
                    class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    return $actionBtn;
                    // $actionBtn = '<a href="javascript:void(0)" id="' . $row->kd_jenis_pemeriksaan_lab . '" onClick="SelectItem(this)"
                    // data-kdpemeriksaan="' . $row->kd_jenis_pemeriksaan_lab . '"
                    // data-nm_jenis_pemeriksaan="' . $row->nm_jenis_pemeriksaan_lab . '"
                    // data-satuan_hasil="' . $row->satuan_hasil . '"
                    // data-jenis_kelamin="' . $row->jenis_kelamin . '"
                    // data-batas_atas="' . $row->batas_atas . '"
                    // data-batas_bawah="' . $row->batas_bawah . '"
                    // data-ket_normal="' . $row->ket_normal . '"
                    // class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
                    // return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return response()->json($isKomponenLab);
        }
    }

    public function getSelectedItem(Request $request)
    {
        if (request()->ajax()) {
            $isSelectedItem = DB::table('jenis_pemeriksaan_lab_hdr')
                ->where('jenis_pemeriksaan_lab_hdr.kd_jenis_pemeriksaan_lab', $request->kd_jenis_pemeriksaan_lab)
                ->leftJoin('jenis_pemeriksaan_lab_detail', 'jenis_pemeriksaan_lab_hdr.kd_jenis_pemeriksaan_lab', 'jenis_pemeriksaan_lab_detail.kd_jenis_pemeriksaan_lab')
                ->select('jenis_pemeriksaan_lab_hdr.*', 'jenis_pemeriksaan_lab_detail.*')
                ->get();
            // return DataTables::of($isKomponenLab)
            //     ->addColumn('action', function ($row) {
            //         $actionBtn =
            //             '<a href="javascript:void(0)" id="' .
            //             $row->kd_jenis_pemeriksaan_lab .
            //             '" onClick="SelectItem(this)"
            //         data-kdpemeriksaan="' .
            //             $row->kd_jenis_pemeriksaan_lab .
            //             '"
            //         class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
            //         return $actionBtn;
            //         // $actionBtn = '<a href="javascript:void(0)" id="' . $row->kd_jenis_pemeriksaan_lab . '" onClick="SelectItem(this)"
            //         // data-kdpemeriksaan="' . $row->kd_jenis_pemeriksaan_lab . '"
            //         // data-nm_jenis_pemeriksaan="' . $row->nm_jenis_pemeriksaan_lab . '"
            //         // data-satuan_hasil="' . $row->satuan_hasil . '"
            //         // data-jenis_kelamin="' . $row->jenis_kelamin . '"
            //         // data-batas_atas="' . $row->batas_atas . '"
            //         // data-batas_bawah="' . $row->batas_bawah . '"
            //         // data-ket_normal="' . $row->ket_normal . '"
            //         // class="edit btn btn-xs btn-sm" style="background-color:#10F3A4; color:#ffffff;">Select</a>';
            //         // return $actionBtn;
            //     })
            //     ->rawColumns(['action'])
            //     ->make(true);
            return response()->json($isSelectedItem);
        }
    }

    public function addTarifLab(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kd_tarif' => 'required',
            'nm_tarif' => 'required',
            'nilai_tarif' => 'required',
            'ket_normal' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $newDataHdr = [
                'kd_tarif' => $request->kd_tarif,
                'nm_tarif' => $request->nm_tarif,
                'rekap_cetak' => $request->rekap_cetak,
                'nilai_tarif' => $request->nilai_tarif,
                'keterangan_tarif' => $request->keterangan_tarif,
                'tgl_expired' => '3000-01-01',
                'isActive' => $request->isActive,
                'user' => Auth::user()->name,
            ];
            tarif_lab_hdr::create($newDataHdr);

            foreach ($request->kd_jenis_pemeriksaan_lab as $key => $xf) {
                $tpdetail = [
                    'kd_tarif' => $request->kd_tarif,
                    'nm_tarif' => $request->nm_tarif,
                    'kd_jenis_pemeriksaan_lab' => $request->kd_jenis_pemeriksaan_lab[$key],
                    'jenis_kelamin' => $request->jenis_kelamin[$key],
                    'batas_atas' => $request->batas_atas[$key],
                    'batas_bawah' => $request->batas_bawah[$key],
                    'ket_normal' => $request->ket_normal[$key],
                    'satuan_hasil' => $request->satuan_hasil[$key],
                    'tgl_expired' => '3000-01-01',
                ];
                tarif_lab_detail::create($tpdetail);
            }
            DB::commit();
            toastr()->success('Data Tersimpan!');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Gagal Tersimpan!');
            return back();
        }
    }
}
