<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\V1\Master\RoleMenu;
use App\Http\Controllers\Controller;

class RoleMenuController extends Controller
{
   
    public function index()
    {
        //
        // $role_menu = RoleMenu::with('user','menu');
        $role_menu = RoleMenu::with('user','menu')->get();
        return ResponseFormatter::success([
            'role_menu' => $role_menu,
         ], 'Data Role Menu berhasil diambil');
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
                'user_id' => 'required',
                'menu_id' => 'required',
            ]);

            RoleMenu::create([
                'user_id' => $request->user_id,
                'menu_id' => $request->menu_id,
            ]);
            
            return ResponseFormatter::success([
                'role_menu'=>$request->all()
            ],'Data Role Menu berhasil ditambahkan');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Role Menu gagal ditambah');
            
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
            $role_menu = RoleMenu::where('id_role_menu',$id)->first();
            return ResponseFormatter::success([
                'role_menu' => $role_menu,
            ], 'Data Role Menu berhasil diambil');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Role Menu gagal diambil');
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
                'menu_id' => 'max:200',
                'user_id' => 'max:100'
            ]);

           $a= RoleMenu::where('id_role_menu',$id)->update($request->all());

            return ResponseFormatter::success([
                'role_menu'=> $request->all()
            ],'Data Role Menu berhasil diubah');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data Role Menu gagal diubah');
            
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
            RoleMenu::where('id_role_menu',$id)->delete();
            return ResponseFormatter::success([
                'message' => 'Data role_menu berhasil dihapus'
            ],'Data role_menu berhasil dihapus');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data role_menu gagal dihapus');
            
        }
    }
}
