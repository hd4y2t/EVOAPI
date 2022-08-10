<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\COA;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\KategoriCOA;

class COAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //    public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }

    public function show_all()
    {
        
        $coa = COA::with('kategori_coa')->get();
        return ResponseFormatter::success([
            'coa'=>$coa,
        ], __('messages.coa_controller.berhasil_didapat'));
        
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
        
        try {
            $request->validate([
                'kode_account'          => 'required|string|unique:coa',
                'nama'                  => 'required|string|max:100',
                'posisi'                => 'required',
                'letak'                 => 'required',
                'jns'                   => 'required',
                'lokasi_id'             => 'required',
                'aktif'                 => 'required',
                'pakai_budget'          => 'required',
                'lama_budget_harian'    => 'required',
                'lama_budget_bulanan'   => 'required',
                'budget_harian'         => 'required',
                'budget_bulanan'        => 'required',
                'flag_khusus'           => 'required',
                'kategori_id'           => 'required',
            ]);

            COA::create([
                'kode_account'          => $request->kode_account,
                'nama'                  => $request->nama,
                'posisi'                => $request->posisi,
                'letak'                 => $request->letak,
                'jns'                   => $request->jns,
                'lokasi_id'             => $request->lokasi_id,
                'aktif'                 => $request->aktif,
                'pakai_budget'          => $request->pakai_budget,
                'lama_budget_harian'    => $request->lama_budget_harian,
                'lama_budget_bulanan'   => $request->lama_budget_bulanan,
                'budget_harian'         => $request->budget_harian,
                'budget_bulanan'        => $request->budget_bulanan,
                'flag_khusus'           => $request->flag_khusus,
                'kategori_id'           => $request->kategori_id,
            ]);
            return ResponseFormatter::success([
                'message' => __('messages.coa_controller.berhasil_ditambah'),
                'coa' => $request->all(),
            ], __('messages.coa_controller.berhasil_ditambah'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ],__('messages.error_json_umum.error_catch_meta'),500);
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
            $coa = COA::where('id_coa', $id)->first();
            return ResponseFormatter::success([
                'coa' => $coa
            ],__('messages.coa_controller.berhasil_ditemukan'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // public function edit($id)
    // {
    //     //
      
    // }

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
            $request->validate([
                 'kode_account'          => 'string|unique:coa',
                'nama'                  => 'string|max:100',
                'posisi'                => '',
                'letak'                 => '',
                'jns'                   => '',
                'lokasi_id'             => '',
                'aktif'                 => '',
                'pakai_budget'          => '',
                'lama_budget_harian'    => '',
                'lama_budget_bulanan'   => '',
                'budget_harian'         => '',
                'budget_bulanan'        => '',
                'flag_khusus'           => '',
                'kategori_id'           => '',
            ]);

            COA::where('id_coa',$id)->update($request->all());
            $a = COA::where('id_coa', $id)->first();

            return ResponseFormatter::success([
                'coa' => $a
            ],__('messages.coa_controller.berhasil_diedit'));
        } catch (Exception $error) {
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
            COA::where('id_coa', $id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.coa_controller.berhasil_dihapus')
            ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ]);
        }
    }
}
