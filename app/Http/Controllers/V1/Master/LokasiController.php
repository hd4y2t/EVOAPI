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
    public function index()
    {
        //
        $lokasi = Lokasi::all();
        return ResponseFormatter::success([
            'lokasi' => $lokasi,
         ], 'Data lokasi berhasil diambil');
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
            //code...
            $request->validate([
                'nama' => 'required|max:50|unique:lokasi',
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
            ],'Data Lokasi berhasil ditambahkan');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Lokasi gagal ditambah');
            
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
            $lokasi = Lokasi::where('id_lokasi',$id)->first();
            return ResponseFormatter::success([
                'lokasi' => $lokasi,
            ], 'Data lokasi berhasil diambil');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data lokasi gagal diambil');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {
            //code...
            $request->validate([
                'nama' => 'required|unique:lokasi',
                'alamat' => 'required',
                'hp' => 'required',
                'inisial_faktur' => 'required',
            ]);

          
            Lokasi::where('id_lokasi',$id)->update($request->all());
            $a = Lokasi::where('id_lokasi', $id)->first();

            return ResponseFormatter::success([
                'lokasi'=> $a
            ],'Data Lokasi berhasil diubah');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Lokasi gagal diubah');
            
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
            Lokasi::where('id_lokasi',$id)->delete();
            return ResponseFormatter::success([
                'message' => 'Data lokasi berhasil dihapus'
            ],'Data Lokasi berhasil dihapus');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Lokasi gagal dihapus');
            
        }
    }
}
