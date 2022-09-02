<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Jurnal;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\DetailJurnal;

class JPController extends Controller
{
    //
     public function show_all()
    {
        try {
            
        $jurnal = Jurnal::where('jenis','JP')->orderBy('tanggal','DESC')->get();
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


     public function move_data(Request $request)
    {
        try{
                $user =auth()->user()->id;
                $jurnal =[ 
                        'tanggal'       => $request->tanggal,
                        'user_id'       => (int)$user,
                    ];
                    // dd($jurnal);
                    $coba = DB::select('exec simpan_jurnal_penyesuaian ?,?,?,?',array($jurnal['tanggal'],$jurnal['user_id'] ,null,null));
                
                    // dd($coba);
                
                if ($coba) {
                    return ResponseFormatter::success([
                      'jurnal'=>$coba,
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
