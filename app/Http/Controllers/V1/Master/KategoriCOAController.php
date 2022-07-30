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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //  public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }

     public function index()
    {
        //
        $kategori_coa = KategoriCOA::all();
        return ResponseFormatter::success([
            'kategori_coa' => $kategori_coa,
         ], 'Data kategori COA berhasil diambil');
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
                'message' => 'Data kategori COA berhasil ditambahkan',
                'kategori_coa' => $request->all(),
            ], 'Data kategori COA berhasil ditambahkan');

        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Kategori COA gagal ditambah');
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
            //code...
            $kategori_coa = KategoriCOA::findOrFail($id);
            return ResponseFormatter::success([
                'kategori_coa' => $kategori_coa,
             ], 'Data kategori COA berhasil diambil');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data kategori COA gagal diambil');
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
    public function update(Request $request, $id)
    {
        //
        try {
            //code...
            $request->validate([
                'nama' => 'required',
            ]);
            $kategori_coa = KategoriCOA::findOrFail($id);
            $kategori_coa->update([
                'nama' => $request->nama,
            ]);
            return ResponseFormatter::success([
                'message' => 'Data kategori COA berhasil diubah',
                'kategori_coa' => $request->all(),
            ], 'Data kategori COA berhasil diubah');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data kategori COA gagal diubah');
        }
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
            //code...
            $kategori_coa = KategoriCOA::findOrFail($id);
            $kategori_coa->delete();
            return ResponseFormatter::success([
                'message' => 'Data kategori COA berhasil dihapus',
            ], 'Data kategori COA berhasil dihapus');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data kategori COA gagal dihapus');
        }
    }
}