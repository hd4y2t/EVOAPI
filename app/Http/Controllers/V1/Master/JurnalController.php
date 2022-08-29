<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Jurnal;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\JurnalTemp;
use App\Models\V1\Master\DetailJurnal;
use Illuminate\Database\Query\Expression;
use App\Http\Controllers\V1\Master\JurnalTempEditController;
use App\Models\V1\Master\CoaBankKas;
use App\Models\V1\Master\DetailJurnalTempEdit;
use App\Models\V1\Master\JurnalTempEdit;

class JurnalController extends Controller
{
    public function show_all()
    {
        $jurnal = Jurnal::all();
        return ResponseFormatter::success([
            'jurnal' => $jurnal,
         ], __('messages.jurnal_controller.berhasil_diambil'));
    }

    
    public function show_by_id($id)
    {
        try {
            //code...
            $jurnal = Jurnal::where('id_jurnal',$id)->first();
            return ResponseFormatter::success([
                'jurnal' => $jurnal,
            ], __('messages.jurnal_controller.berhasil_diambil'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function update_by_jurnal($id)
    {
       try {
                  
            $coba = DB::select('exec pindah_jurnal_ke_temp ?,?,?',array($id,null,null));
            // dd($coba);
            // $jurnal = JurnalTempEdit::where('id_jurnal',$id)->first();
            // $bank_kas = CoaBankKas::with('coa')->where('coa_id',$jurnal['id_coa_atas'])->first();
            // $detail = DetailJurnalTempEdit::with('coa')->where('jurnal_id',$id)->get();
            // $debit = $detail->sum('debit');
            // $kredit = $detail->sum('kredit');
            if ($coba) {
                return ResponseFormatter::success([
                    'status'=>$coba,
                ],'Data berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data tidak ada',
                    404
                );
            }
        } catch (Exception $error) {

            return ResponseFormatter::error([
                'error'=> $error
            ],__('messages.detail_jurnal_controller.gagal_ditambah'),500);
            
        }
    }

    public function delete_by_id($id)
    {
        try {
            //code...
            Jurnal::where('id_jurnal',$id)->delete();
            DetailJurnal::where('jurnal_id',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.jurnal_controller.berhasil_dihapus'),
            ], __('messages.jurnal_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }
}