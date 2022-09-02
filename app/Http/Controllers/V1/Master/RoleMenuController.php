<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Menu;
use App\Helpers\ResponseFormatter;
use App\Models\V1\Master\RoleMenu;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleMenuController extends Controller
{
    public function getMenu($id){
        $menu = DB::select('
select DISTINCT menu.id_menu as nama_menu,* from role_menu
	join menu on menu.id_menu = role_menu.menu_id
	where role_menu.user_id = ' . $id . '
	order by menu.nomor_urut asc ');
        return ResponseFormatter::success(['menu'=>$menu], __('messages.role_menu_controller.berhasil_diambil'));
        
    }
    public function getSubMenu($id)
    {   $user = auth()->user()->id;
        $submenu = DB::select('select submenu.nama as nama_sub,* from role_submenu role_submenu join submenu on submenu.id_submenu = role_submenu.id_submenu join menu on menu.id_menu = submenu.menu_id where user_id = '.$user.' and submenu.menu_id = '.$id.' order by menu.nomor_urut asc, submenu.nomor_urut_submenu asc');
        return ResponseFormatter::success(['submenu'=>$submenu], __('messages.role_menu_controller.berhasil_diambil'));
    }
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_all()
    {
        //
        // $role_menu = RoleMenu::with('user','menu');
        $role_menu = RoleMenu::with('user','menu')->get();
        return ResponseFormatter::success([
            'role_menu' => $role_menu,
        ], __('messages.role_controller.berhasil_diambil'));
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
            ], __('messages.role_controller.berhasil_ditambah'));
        } catch (Exception $error) {
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
            $role_menu = RoleMenu::where('id_role_menu',$id)->first();
            return ResponseFormatter::success([
                'role_menu' => $role_menu,
            ], __('messages.role_controller.berhasil_diambil'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'));
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
                'user_id' => 'max:100',
                'menu_id' => 'max:200'
            ]);

           $a = RoleMenu::where('id_role_menu',$id)->update($request->all());
            return ResponseFormatter::success([
                'role_menu'=> $a
            ], __('messages.role_controller.berhasil_diubah'));
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
            //code...
            RoleMenu::where('id_role_menu',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.role_controller.berhasil_dihapus'),
            ], __('messages.role_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }
}
