<?php

namespace App\Http\Controllers;

use App\Models\mstr_dokter;
use App\Models\mstr_jaminan;
use App\Models\mstr_tindakan;
use Illuminate\Http\Request;
use App\Models\mstr_layanan;
use App\Models\mstr_nilai_tindakan;
use App\Models\t_template_order_detail;
use App\Models\t_template_order_hdr;
use Yoeunes\Toastr\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class mastersatuController extends Controller
{

    public function layanan()
    {
        $num = str_pad(001, 3, 0, STR_PAD_LEFT);

        $cekid = mstr_layanan::count();
        if ($cekid == 0) {
            $kd_layanan =  'LA'  . $num;
        } else {
            $continue = mstr_layanan::all()->last();
            $de = substr($continue->fm_kd_layanan, -3);
            $kd_layanan = 'LA' . str_pad(($de + 1), 3, '0', STR_PAD_LEFT);
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
        $isnilaitindakan = DB::table('mstr_nilai_tindakan')
            ->leftJoin('mstr_tindakan', 'mstr_nilai_tindakan.id_tindakan', 'mstr_tindakan.id')
            ->select('mstr_nilai_tindakan.*', 'mstr_tindakan.*')
            ->get();
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
            $kdTo =  'TO'  . $num;
        } else {
            $continue = t_template_order_hdr::all()->last();
            $de = substr($continue->kd_to, -3);
            $kdTo = 'TO' . str_pad(($de + 1), 3, '0', STR_PAD_LEFT);
        }
        $getAllTemplate = DB::table('t_template_order_hdr')->get();
        return view('pages.mstr1.template-resep', [
            'kdTo' => $kdTo,
            'getAllTemplate' => $getAllTemplate
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
        $toHdr->to_user   = Auth::user()->name;
        $toHdr->save();

        foreach ($request->kd_obat_to as $key => $xf) {
            $todetail = [
                'kd_to'         => $request->kd_to,
                'kd_obat_to'    => $request->kd_obat_to[$key],
                'nm_obat_to'    => $request->nm_obat_to[$key],
                'hrg_obat_to'   => $request->hrg_obat_to[$key],
                'qty_to'        => $request->qty_to[$key],
                'satuan_to'     => $request->satuan_to[$key],
                'signa_to'      => $request->signa_to[$key],
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
        $getDetailTemp = DB::table('t_template_order_hdr')->leftJoin('t_template_order_detail', 't_template_order_detail.kd_to', 't_template_order_hdr.kd_to')
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
            DB::table('t_template_order_hdr')->where('kd_to', $request->kd_to)->update([
                'nm_to'        => $request->nm_to,
                'to_user'      => Auth::user()->name
            ]);

            DB::table('t_template_order_detail')->where('kd_to', $request->kd_to)->delete();

            foreach ($request->kd_obat_to as $key => $xf) {
                $todetail = [
                    'kd_to'         => $request->kd_to,
                    'kd_obat_to'    => $request->kd_obat_to[$key],
                    'nm_obat_to'    => $request->nm_obat_to[$key],
                    'hrg_obat_to'   => $request->hrg_obat_to[$key],
                    'qty_to'        => $request->qty_to[$key],
                    'satuan_to'     => $request->satuan_to[$key],
                    'signa_to'      => $request->signa_to[$key],
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

            DB::table('t_template_order_hdr')->where('kd_to', $request->kd_to)->delete();
            DB::table('t_template_order_detail')->where('kd_to', $request->kd_to)->delete();

            DB::commit();

            toastr()->success('Deleted!');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Some Error Occured!');
            return back();
        }
    }
}
