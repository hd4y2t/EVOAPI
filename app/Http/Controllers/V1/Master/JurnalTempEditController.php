<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\CoaBankKas;
use App\Models\V1\Master\JurnalTempEdit;
use Illuminate\Database\Query\Expression;
use App\Models\V1\Master\DetailJurnalTempEdit;

class JurnalTempEditController extends Controller
{
    public function show_all()
    {
        $jurnal_temp = JurnalTempEdit::all();
        return ResponseFormatter::success([
            'jurnal_temp' => $jurnal_temp,
         ], __('messages.jurnal_temp_controller.berhasil_diambil'));
    }

    public function getJurnal($id)
    {
        try {

        $jurnal_temp = JurnalTempEdit::where('id_jurnal',$id)->first();
        $detail_temp = DetailJurnalTempEdit::with('coa')->where('jurnal_id',$id)->get();
        $debit = DetailJurnalTempEdit::where('jurnal_id',$id)->sum('debit');
        $kredit = DetailJurnalTempEdit::where('jurnal_id',$id)->sum('kredit');
        $bank_kas = CoaBankKas::with('coa')->where('coa_id',$jurnal_temp['id_coa_atas'])->first();
        return ResponseFormatter::success([
            'jurnal_temp' => $jurnal_temp,
            'detail_temp' => $detail_temp,
            'debit' => $debit,
            'kredit' => $kredit,
            'bank_kas' => $bank_kas,
         ], __('messages.jurnal_temp_controller.berhasil_diambil'));

        } catch (Exception $error) {
             return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function do_update(Request $request)
    {
          try {

                // dd($coa_id->coa_id);
                    $jurnal =[ 
                        'id_jurnal'         => $request->id_jurnal,
                        'tanggal'       => $request->tanggal,
                        'note'          => $request->note,
                    ];
                    // dd($jurnal);
                    $coba = DB::select('exec update_jurnal ?,?,?,?,?',array($jurnal['id_jurnal'],$jurnal['tanggal'] ,$jurnal['note'],null,null));
            // dd($coba);
                if ($coba) {
                    return ResponseFormatter::success([
                       'jurnal'=>$coba
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
                //throw $th;

                return ResponseFormatter::error([
                    'error'=> $error
                ],__('messages.detail_jurnal_controller.gagal_ditambah'),500);
                
            }
    }

    public function show_by_id($id)
    {
        try {
            //code...
            $jurnal_temp = JurnalTempEdit::where('id_jurnal_temp',$id)->first();
            return ResponseFormatter::success([
                'jurnal_temp' => $jurnal_temp,
            ], __('messages.jurnal_temp_controller.berhasil_diambil'));
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
            JurnalTempEdit::where('id_jurnal_temp',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.jurnal_temp_controller.berhasil_dihapus'),
            ], __('messages.jurnal_temp_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }
}