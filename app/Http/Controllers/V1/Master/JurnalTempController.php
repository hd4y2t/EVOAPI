<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\JurnalTemp;
use Illuminate\Database\Query\Expression;

class JurnalTempController extends Controller
{
    public function show_all()
    {
        $jurnal_temp = JurnalTemp::all();
        return ResponseFormatter::success([
            'jurnal_temp' => $jurnal_temp,
         ], __('messages.jurnal_temp_controller.berhasil_diambil'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kode_voucher' => 'required|max:20',
                'tanggal'      => 'required|max:150',
                'jam'          => 'required',
                'user_id'      => 'required',
                'jenis'        => 'required',
                'note'         => 'required',
                'tanggal_input'=> 'required',
            ]);

            JurnalTemp::create([
                'kode_voucher'  => $request->kode_voucher,
                'tanggal'       => $request->tanggal,
                'jam'           => $request->jam,
                'user_id'       => $request->user_id,
                'jenis'         => $request->jenis,
                'note'          => $request->note,
                'tanggal_input' => $request->tanggal_input,
            ]);
            
            return ResponseFormatter::success([
                'jurnal_temp'=>$request->all()
            ],__('messages.jurnal_temp_controller.berhasil_ditambah'));
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
            $jurnal_temp = JurnalTemp::where('id_jurnal_temp',$id)->first();
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

            JurnalTemp::where('id_jurnal_temp',$id)->update($request->all());
            $a = JurnalTemp::where('id_jurnal_temp', $id)->first();

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
            JurnalTemp::where('id_jurnal_temp',$id)->delete();
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