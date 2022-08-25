<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\JurnalTempEdit;
use Illuminate\Database\Query\Expression;

class JurnalTempEditEditController extends Controller
{
    public function show_all()
    {
        $jurnal_temp = JurnalTempEdit::all();
        return ResponseFormatter::success([
            'jurnal_temp' => $jurnal_temp,
         ], __('messages.jurnal_temp_controller.berhasil_diambil'));
    }

    public function store(Request $request)
    {
        
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

    public function update_by_id(Request $request, $id)
    {
        try {
            //code...
            $request->validate([
                'kode_voucher'  => 'required|max:20',
                'tanggal'       => 'required|max:150',
                'jam'           => 'required',
                'user_id'       => 'required',
                'jenis'         => 'required',
                'note'          => 'required',
                'tanggal_input' => 'required',
            ]);

            JurnalTempEdit::where('id_jurnal_temp',$id)->update($request->all());
            $a = JurnalTempEdit::where('id_jurnal_temp', $id)->first();

            return ResponseFormatter::success([
                'jurnal_temp'=> $a
            ],__('messages.jurnal_temp_controller.berhasil_diubah'));
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