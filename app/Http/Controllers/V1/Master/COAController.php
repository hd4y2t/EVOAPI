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
            $coa,
            'Data COA berhasil '
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
        try {
            //code...
            $request->validate([
                'kode_account'          => ['required', 'string', 'unique:coa'],
                'nama'                  => ['required', 'string', 'max:100'],
                'posisi'                => ['required',],
                'letak'                 => ['required'],
                'jns'                   => ['required'],
                'id_lokasi'             => ['required'],
                'aktif'                 => ['required'],
                'pakai_budget'          => ['required'],
                'lama_budget_harian'    => ['required'],
                'lama_budget_bulanan'   => ['required'],
                'budget_harian'         => ['required'],
                'budget_bulanan'        => ['required'],
                'flag_khusus'           => ['required'],
                'id_kategori_coa'       => ['required'],
            ]);

            COA::create([
                'kode_account'          => $request->kode_account,
                'nama'                  => $request->nama,
                'posisi'                => $request->posisi,
                'letak'                 => $request->letak,
                'jns'                   => $request->jns,
                'id_lokasi'             => $request->id_lokasi,
                'aktif'                 => $request->aktif,
                'pakai_budget'          => $request->pakai_budget,
                'lama_budget_harian'    => $request->lama_budget_harian,
                'lama_budget_bulanan'   => $request->lama_budget_bulanan,
                'budget_harian'         => $request->budget_harian,
                'budget_bulanan'        => $request->budget_bulanan,
                'flag_khusus'           => $request->flag_khusus,
                'id_kategori_coa'       => $request->id_kategori_coa,
            ]);
            return ResponseFormatter::success([
                'message' => 'Data COA berhasil ditambahkan',
                'coa' => $request->all(),
            ], 'Data COA berhasil ditambahkan');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data COA gagal ditambah');
        }
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

    public function edit(Request $request, $id)
    {
        //
        try {
            $request->validate([
                'kode_account'          => ['required', 'string', 'unique:coa'],
                'nama'                  => ['required', 'string', 'max:100'],
                'posisi'                => ['required'],
                'letak'                 => ['required'],
                'jns'                   => ['required'],
                'id_lokasi'             => ['required'],
                'aktif'                 => ['required'],
                'pakai_budget'          => ['required'],
                'lama_budget_harian'    => ['required'],
                'lama_budget_bulanan'   => ['required'],
                'budget_harian'         => ['required'],
                'budget_bulanan'        => ['required'],
                'flag_khusus'           => ['required'],
                'id_kategori_coa'       => ['required'],
            ]);

            COA::where('id_coa', $id)->first()->update([
                'kode_account'          => $request->kode_account,
                'nama'                  => $request->nama,
                'posisi'                => $request->posisi,
                'letak'                 => $request->letak,
                'jns'                   => $request->jns,
                'id_lokasi'             => $request->id_lokasi,
                'aktif'                 => $request->aktif,
                'pakai_budget'          => $request->pakai_budget,
                'lama_budget_harian'    => $request->lama_budget_harian,
                'lama_budget_bulanan'   => $request->lama_budget_bulanan,
                'budget_harian'         => $request->budget_harian,
                'budget_bulanan'        => $request->budget_bulanan,
                'flag_khusus'           => $request->flag_khusus,
                'id_kategori_coa'       => $request->id_kategori_coa,
            ]);

            return ResponseFormatter::success([
                'coa' => $$request->all(),
                'Data COA berhasil diedit'
            ]);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data COA gagal diedit');
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
            // $coa = COA::where('id_coa', $id)->first();
            COA::where('id_coa', $id)->delete();
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
