<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Lokasi;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Expression;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_all()
    {
        //       
        $lokasi = Lokasi::all();
        return ResponseFormatter::success([
            'lokasi' => $lokasi,
         ], __('messages.lokasi_controller.berhasil_diambil'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        try {
            //code...
            $request->validate([
                'nama' => 'required|max:50',
                'alamat' => 'required|max:150',
                'hp' => 'required|numeric',
                'inisial_faktur' => 'required',
            ]);

            Lokasi::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'inisial_faktur' => $request->inisial_faktur,
            ]);
            
            return ResponseFormatter::success([
                'lokasi'=>$request->all()
            ],__('messages.lokasi_controller.berhasil_ditambah'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_by_id($id)
    {
        //
        try {
            //code...
            $lokasi = Lokasi::where('id_lokasi',$id)->first();
            return ResponseFormatter::success([
                'lokasi' => $lokasi,
            ], __('messages.lokasi_controller.berhasil_diambil'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_by_id(Request $request, $id)
    {
        //
        try {
            //code...
            $request->validate([
                'nama' => 'max:50',
                'alamat' => 'max:150',
                'hp' => 'numeric',
                'inisial_faktur' => 'string',
            ]);

            $a = Lokasi::where('id_lokasi',$id)->update($request->all());
            // $a = Lokasi::where('id_lokasi', $id)->first();

            return ResponseFormatter::success([
                'lokasi'=> $a
            ], __('messages.lokasi_controller.berhasil_diubah'));
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_by_id($id)
    {
        //
         try {
            //code...
            Lokasi::where('id_lokasi',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.lokasi_controller.berhasil_dihapus'),
            ], __('messages.lokasi_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }
}
