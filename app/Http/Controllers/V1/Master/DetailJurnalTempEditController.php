<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\DetailJurnalTemp;
use App\Models\V1\Master\DetailJurnalTempEdit;

class DetailJurnalTempEditController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'jurnal_id'    => 'required',
                'coa_id'       => 'required',
                'posisi'       => 'required',
                'keterangan'   => 'required',
                'jumlah'       => 'required',
            ]);
            
            if ($request->posisi == 'debit') {
                    $detail=  DetailJurnalTempEdit::create([
                    'jurnal_id'    => $request->jurnal_id,
                    'coa_id'       => $request->coa_id,
                    'keterangan'   => $request->keterangan,
                    'debit'        => $request->jumlah,
                    'kredit'       => 0,
                ]);
                // dd($detail);
                return ResponseFormatter::success([
                    'detail_jurnal'=> $detail
                ],__('messages.detail_jurnal_controller.berhasil_ditambah'));

            } else if($request->posisi == 'kredit') {
                    $detail=  DetailJurnalTempEdit::create([
                    'jurnal_id'     => $request->jurnal_id,
                    'keterangan'    => $request->keterangan,
                    'debit'         => 0,
                    'kredit'        => $request->jumlah,
                ]);
                return ResponseFormatter::success([
                    'detail_jurnal'=> $detail
                ],__('messages.detail_jurnal_controller.berhasil_ditambah'));
            }
           
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
            DetailJurnalTempEdit::where('id_detail_jurnal',$id)->delete();
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
