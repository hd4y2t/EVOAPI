<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\CoaBankKas;

class CoaBankKasController extends Controller
{
  public function show_all()
    {
        //
        $coabank = CoaBankKas::with('coa')->get();  
        return ResponseFormatter::success([
            'coa_bank' => $coabank,
         ], __('messages.coa_bank_kas_controller.berhasil_diambil'));
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
                'coa_id' => 'required',
                'inisial' => 'required',
            ]);

            if(CoaBankKas::where('coa_id', $request->coa_id)){
                return ResponseFormatter::error(400, __('messages.coa_bank_kas_controller.coa_sudah_ada'));
            }else{
            CoaBankKas::create([
                'coa_id' => $request->coa_id,
                'inisial' => $request->inisial,
            ]);
            
            return ResponseFormatter::success([
                'coa_bank'=>$request->all()
            ],__('messages.coa_bank_kas_controller.berhasil_ditambah'));
            }
           
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' =>__('messages.error_json_umum.error_catch_data'),
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
            $coabank = CoaBankKas::where('id_coa_bank',$id)->first();
            return ResponseFormatter::success([
                'coa_bank' => $coabank,
            ],__('messages.coa_bank_kas_controller.berhasil_diambil'));
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' =>  __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ],__('messages.error_json_umum.error_catch_meta'),500);
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
                'coa_id' => 'required',
                'inisial' => 'required',
            ]);

            CoaBankKas::where('id_coa_bank_kas',$id)->update($request->all());
            $a = CoaBankKas::where('id_coa_bank_kas', $id)->first();

            return ResponseFormatter::success([
                'coaBank'=> $a
            ],__('messages.coa_bank_kas_controller.berhasil_diubah'));
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
            CoaBankKas::where('id_coa_bank_kas',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.coa_bank_kas_controller.berhasil_dihapus'),
            ], __('messages.coa_bank_kas_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }
}
