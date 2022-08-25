<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Jurnal;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\DetailJurnal;
use Illuminate\Support\Facades\Session;

class DetailJurnalController extends Controller
{
      public function show_all()
    {
        $djurnal = DetailJurnal::all();
        return ResponseFormatter::success([
            'detail_jurnal' => $djurnal,
         ], __('messages.detail_jurnal_controller.berhasil_diambil'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'jurnal_id' => 'required',
                'coa_id'      => 'required',
                'user_id'      => 'required',
                'jenis'        => 'required',
                'note'         => 'required',
            ]);
            $jam = date('H:i:s');
            $user= Session::get('user.id');
            DetailJurnal::create([
                'jurnal_id' => $request->jurnal_id,
                'coa_id'      => $request->coa_id,
                'jam'          => $jam,
                'user_id'      => $user,
                'jenis'        => $request->jenis,
                'note'         => $request->note,
            ]);
            
            return ResponseFormatter::success([
                'jurnal'=>$request->all()
            ],__('messages.detail_jurnal_controller.berhasil_ditambah'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function show_by_id($id)
    {
        try {
            //code...
            $jurnal = DetailJurnal::where('id_jurnal',$id)->first();
            return ResponseFormatter::success([
                'jurnal' => $jurnal,
            ], __('messages.detail_jurnal_controller.berhasil_diambil'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function show_by_jurnal($jurnal)
    {
        try {
            //code...
            $jurnal = Jurnal::where('id_jurnal',$jurnal)->first();
            
            $detail = DetailJurnal::with('coa')->where('jurnal_id',$jurnal->id_jurnal)->where('flag_dari_atas','T')->get();

            $debit = $detail->sum('debit');
            $kredit = $detail->sum('kredit');
                
            return ResponseFormatter::success([
                'jurnal' => $jurnal,
                'detail' => $detail,
                'debit' => $debit,
                'kredit' => $kredit,
            ], __('messages.detail_jurnal_controller.berhasil_diambil'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function update_by_id(Request $request, $id)
    {
        try {
            //code...
            $request->validate([
                'kode_voucher' => 'required|max:20',
                'tanggal'     => 'required|max:150',
                'jam'         => 'required',
                'user_id'     => 'required',
                'jenis'       => 'required',
                'note'        => 'required',
            ]);

            DetailJurnal::where('id_jurnal',$id)->update($request->all());
            $a = DetailJurnal::where('id_jurnal', $id)->first();

            return ResponseFormatter::success([
                'jurnal'=> $a
            ],__('messages.detail_jurnal_controller.berhasil_diubah'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }

    public function delete_by_id($id)
    {
        try {
            //code...
            DetailJurnal::where('id_jurnal',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.detail_jurnal_controller.berhasil_dihapus'),
            ], __('messages.detail_jurnal_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }
}
