<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
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
         ], 'Data Coa Bank berhasil diambil');
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
                'jenis' => 'required',
                'inisial' => 'required',
            ]);

            CoaBankKas::create([
                'coa_id' => $request->coa_id,
                'jenis' => $request->jenis,
                'inisial' => $request->inisial,
            ]);
            
            return ResponseFormatter::success([
                'coa_bank'=>$request->all()
            ],'Data Coa Bank berhasil ditambahkan');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Coa Bank gagal ditambah');
            
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
            ], 'Data Coa Bank berhasil diambil');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Coa Bank gagal diambil');
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
                'jenis' => 'required',
                'inisial' => 'required',
            ]);

            CoaBankKas::where('id_coa_bank_kas',$id)->update($request->all());
            $a = CoaBankKas::where('id_coa_bank_kas', $id)->first();

            return ResponseFormatter::success([
                'coa_bank'=> $a
            ],'Data Coa Bank berhasil diubah');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Coa Bank gagal diubah');
            
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
                'message' => 'Data Coa Bank berhasil dihapus'
            ],'Data Coa Bank berhasil dihapus');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Coa Bank gagal dihapus');
            
        }
    }
}
