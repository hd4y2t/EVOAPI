<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Mockery\Expectation;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\KategoriCOA;

class KategoriCOAController extends Controller
{
   
    public function show_all()
    {
        $kategori_coa = KategoriCOA::all();
        return ResponseFormatter::success([
            'kategori_coa' => $kategori_coa,
         ], __('messages.kategori_coa_controller.berhasil_diambil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

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
         $request->validate([
             'nama' => 'required|min:3|max:100',
         ]);
         KategoriCOA::create([
                    'nama' => $request->nama,
                ]);
            return ResponseFormatter::success([
                'message' => __('messages.kategori_coa_controller.berhasil_ditambah'),
                'kategori_coa' => $request->all(),
            ], __('messages.kategori_coa_controller.berhasil_ditambah'));

        } catch (Exception $error) {
            //throw $th;
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
            $kategori_coa = KategoriCOA::where('id_kategori_coa',$id)->first();
            return ResponseFormatter::success([
                'kategori_coa' => $kategori_coa,
             ], __('messages.kategori_coa_controller.berhasil_diambil'));
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
                'nama',
            ]);
            
            $a = KategoriCOA::where('id_kategori_coa',$id)->update($request->all());
            return ResponseFormatter::success([
                'kategori_coa' => $a,
            ], __('messages.kategori_coa_controller.berhasil_diubah'));
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
            $kategori_coa = KategoriCOA::where('id_kategori_coa',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.kategori_coa_controller.berhasil_dihapus'),
            ], __('messages.kategori_coa_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }
}