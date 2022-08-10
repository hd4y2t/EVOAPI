<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Jurnal;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Expression;

class JurnalController extends Controller
{
    public function show_all()
    {
        $jurnal = Jurnal::all();
        return ResponseFormatter::success([
            'jurnal' => $jurnal,
         ], __('messages.jurnal_controller.berhasil_diambil'));
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
            ]);

            Jurnal::create([
                'kode_voucher' => $request->kode_voucher,
                'tanggal'      => $request->tanggal,
                'jam'          => $request->jam,
                'user_id'      => $request->user_id,
                'jenis'        => $request->jenis,
                'note'         => $request->note,
            ]);
            
            return ResponseFormatter::success([
                'jurnal'=>$request->all()
            ],__('messages.jurnal_controller.berhasil_ditambah'));
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

    public function get_last_id()
    {
            //code...
            $jurnal = Jurnal::latest()->first();
            $jurnal_id = $jurnal->id_jurnal +1;
     
            return $jurnal_id;
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

            Jurnal::where('id_jurnal',$id)->update($request->all());
            $a = Jurnal::where('id_jurnal', $id)->first();

            return ResponseFormatter::success([
                'jurnal'=> $a
            ],__('messages.jurnal_controller.berhasil_diubah'));
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
            Jurnal::where('id_jurnal',$id)->delete();
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