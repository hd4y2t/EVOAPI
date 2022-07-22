<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\COA;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class COAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coa = COA::all();
        return ResponseFormatter::success(
            $coa,'Data COA berhasil diambil'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
            'kode'                  => ['required','string','unique:coa'],
            'nama'                  => ['required','string', 'max:100'],
            'posisi'                => ['required'],
            'jns'                   => ['required'],
            'pakai_budget'          => ['required'],
            'lama_budget_harian'    => ['required'],
            'lama_budget_bulanan'   => ['required'],
            'budget_harian'         => ['required'],
            'budget_bulanan'        => ['required'],
            'flag_khusus'           => ['required'],
            'id_kategori_Coa'       => ['required'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $coa = COA::where('id_coa', $id)->first();
            return ResponseFormatter::success([
                'coa' => $coa,
                'Data COA berhasil ditemukan'
            ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data COA gagal tidak ditemukan');
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

    public function edit(Request $request,$id)
    {
        //
        try {
            $coa = COA::where('id_coa', $id)->first();
        //   COA::update()
        //     return ResponseFormatter::success([
        //         'coa' => $coa,
        //         'Data COA berhasil ditemukan'
        //     ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data COA gagal tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            COA::destroy($id);
        return ResponseFormatter::success([
            'message' => 'Data COA berhasil dihapus'
        ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Data COA tidak ditemukan',
                'error' => $error
            ]);
        }
       
    }
}
