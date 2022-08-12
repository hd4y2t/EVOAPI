<?php

namespace App\Http\Controllers\V1\Master;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    public function cobaview()
    {
        $coba = DB::table('vw_kategori')
            ->get(['id_kategori_coa', 'nama']);


        if ($coba) {
            return ResponseFormatter::success(
                $coba,
                'Data berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data tidak ada',
                404
            );
        }
    }

    public function cobainsert()
    {
        $coba = DB::select('call sp_kategori ("BIAYA LAINyyxx", "2022-08-11", "2022-08-11", "1")');
        //$coba = DB::table('exec sp_kategori "BIAYA LAINxx", "2022-08-11", "2022-08-11"');
       
        if ($coba) {
            return ResponseFormatter::success(
                $coba,
                'Data berhasil diambil'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Data tidak ada',
                404
            );
        }
        //         if ($coba) {
        // return 'ada';
        //         }else{
        //             return 'tdk ada';
        //         }
        //       return $coba->;
        //$xx = $coba->toArray();
        //$record = $coba->fetchAssoc();

        //$json = json_encode($coba);
        //return $json['hasil'];
        //return json_decode( $json);


        // if ($coba) {
        //     return ResponseFormatter::success(
        //         $coba,
        //         'Data berhasil diinsert'
        //     );
        // } else {
        //     return ResponseFormatter::error(
        //         null,
        //         'Data gagal insert',
        //         404
        //     );
        // }
    }
}
