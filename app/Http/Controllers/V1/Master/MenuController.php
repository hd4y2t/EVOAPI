<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Menu;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function show_all()
    {
        //
        $menu = Menu::all();
        return ResponseFormatter::success([
            'menu' => $menu,
         ], 'Data menu berhasil diambil');
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
                'nama' => 'required|max:50',
                'route' => 'required|max:200',
            ]);

            Menu::create([
                'nama' => $request->nama,
                'route' => $request->route,
            ]);
            
            return ResponseFormatter::success([
                'menu'=>$request->all()
            ],'Data menu berhasil ditambahkan');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'menu gagal ditambah');
            
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
            $menu = Menu::where('id_menu',$id)->first();
            return ResponseFormatter::success([
                'menu' => $menu,
            ], 'Data menu berhasil diambil');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data menu gagal diambil');
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
                'nama' => 'max:100',
                'route' => 'max:200'
            ]);

            menu::where('id_menu',$id)->update($request->all());
            $a = menu::where('id_menu', $id)->first();

            return ResponseFormatter::success([
                'menu'=> $a
            ],'Data menu berhasil diubah');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data menu gagal diubah');
            
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
            Menu::where('id_menu',$id)->delete();
            return ResponseFormatter::success([
                'message' => 'Data menu berhasil dihapus'
            ],'Data menu berhasil dihapus');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data menu gagal dihapus');
            
        }
    }
}

