<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Models\V1\Master\Jurnal;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\V1\Master\DetailJurnalTemp;

class DetailJurnalTempController extends Controller
{
    public function show_all()
    {
        $user =auth()->user()->id;
        $djurnal = DetailJurnalTemp::with('coa')->where('user_id',$user)->get();
        $debit = $djurnal->sum('debit');
        $kredit = $djurnal->sum('kredit');
        return ResponseFormatter::success([
            'detail_jurnal_temp' => $djurnal,
            'total_debit' => $debit,
            'total_kredit' => $kredit,
         ], __('messages.detail_jurnal_controller.berhasil_diambil'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'coa_id'       => 'required',
                'posisi'   => 'required',
                'keterangan'   => 'required',
                'jumlah'       => 'required',
            ]);
            
            if ($request->posisi == 'debit') {
                 $detail=  DetailJurnalTemp::create([
                'coa_id'       => $request->coa_id,
                'user_id'      => $request->user_id,
                'keterangan'   => $request->keterangan,
                'debit'        => $request->jumlah,
                'kredit'        => 0,
            ]);
            // dd($detail);
            return ResponseFormatter::success([
                'detail_jurnal'=> $detail
            ],__('messages.detail_jurnal_controller.berhasil_ditambah'));
            } else if($request->posisi == 'kredit') {
                $detail=  DetailJurnalTemp::create([
                'coa_id'       => $request->coa_id,
                'user_id'      => $request->user_id,
                'keterangan'   => $request->keterangan,
                'debit'       => 0,
                'kredit'       => $request->jumlah,
            ]);
            return ResponseFormatter::success([
                'detail_jurnal'=> $detail
            ],__('messages.detail_jurnal_controller.berhasil_ditambah'));
            }
           
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function move_data(Request $request)
    {
            // try {

                $user =auth()->user()->id;
                $coa_id = DB::table('coa_bank_kas')
                    ->where('id_coa_bank_kas', $request->id_coa_bank_kas)->first();
                $jurnal =[ 
                        'jenis'         => $request->jenis,
                        'tanggal'       => $request->tanggal,
                        'user_id'       => $user,
                        'note'          => $request->note,
                        'coa_id'        => (int)$coa_id->coa_id,
                    ];
                    // dd($jurnal);
                    $coba = DB::select('exec simpan_jurnal ?,?,?,?,?,?,?',array($jurnal['jenis'],$jurnal['tanggal'] ,$jurnal['user_id'],$jurnal['note'],$jurnal['coa_id'],null,null));
                
                    // dd($coba);
                
                if ($coba) {
                    return ResponseFormatter::success([
                      'jurnal'=>$coba,
                    ],'Data berhasil diambil'
                    );
                } else {
                    return ResponseFormatter::error(
                        null,
                        'Data tidak ada',
                        404
                    );
                }
            // } catch (Exception $error) {
            //     //throw $th;

            //     return ResponseFormatter::error([
            //         'error'=> $error
            //     ],__('messages.detail_jurnal_controller.gagal_ditambah'),500);
                
            // }
    }

    public function show_by_jurnal($jurnal)
    {
        try {
            //code...
            $jurnal = DetailJurnalTemp::with('jurnal')->where('id_detail_jurnal',$jurnal)->get();
            return ResponseFormatter::success([
                'jurnal' => $jurnal,
            ], __('messages.detail_jurnal_controller.berhasil_diambil'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function delete_by_id($id)
    {
        try {
            //code...
            DetailJurnalTemp::where('id_detail_jurnal',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.detail_jurnal_controller.berhasil_dihapus'),
            ], __('messages.detail_jurnal_controller.berhasil_dihapus'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
            
        }
    }
}
