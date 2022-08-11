<?php

namespace App\Http\Controllers\V1\Master;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\V1\Master\DetailJurnalTemp;
use App\Models\V1\Master\Jurnal;
use Illuminate\Support\Facades\Session;

class DetailJurnalTempController extends Controller
{
    public function show_all()
    {
        $djurnal = DetailJurnalTemp::all();
        return ResponseFormatter::success([
            'detail_jurnal' => $djurnal,
         ], __('messages.detail_jurnal_controller.berhasil_diambil'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'coa_id'       => 'required',
                'keterangan'   => 'required',
                'debit'        => 'required',
                'kredit'       => 'required',
            ]);
            
            $jurnal = Jurnal::orderBy('id_jurnal','desc')->first();
            if($jurnal == null){
                $jurnal_id = 1;
            }else{
                $jurnal_id = $jurnal->id_jurnal + 1;
            }
            $user =1;
            // $user= Session::get('user.id');
            // dd($jurnal_id);
            $detail=  DetailJurnalTemp::create([
                'jurnal_id'    => $jurnal_id,
                'coa_id'       => $request->coa_id,
                'user_id'      => $user,
                'keterangan'   => $request->keterangan,
                'debit'        => $request->debit,
                'kredit'       => $request->kredit,
            ]);
            // dd($detail);
            return ResponseFormatter::success([
                'detail_jurnal'=> $detail
            ],__('messages.detail_jurnal_controller.berhasil_ditambah'));
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function move_data(Request $request)
    {
            try {
                //code...                
                $jam = date('H:i:s');
                 $jurnal= Jurnal::create([ 
                        'kode_voucher'  => $request->kode_voucher,
                        'tanggal'       => $request->tanggal,
                        'jam'           => $jam,
                        'user_id'       => $request->user_id,
                        'jenis'         => $request->jenis,
                        'note'         => $request->note,
                    ]);
                $jurnal_id = $jurnal->id_jurnal;
             
                $data = DetailJurnalTemp::where('jurnal_id',$jurnal_id)->orderBy('id_detail_jurnal', 'asc')
                ->each(function ($oldPost) {
                    
                $jurnal = Jurnal::orderBy('id_jurnal','desc')->first();
                $jurnal_id = $jurnal->id_jurnal;
                $newPost = $oldPost->replicate();
                $newPost->setTable('detail_jurnal');
                $newPost->save();
                $oldPost->where('jurnal_id',$jurnal_id)->delete();
                
                
                
                });
        
                return ResponseFormatter::success([
                    'detail_jurnal'=> $data
                ],__('messages.detail_jurnal_controller.berhasil_ditambah'));
                
            } catch (Exception $error) {
                //throw $th;

                return ResponseFormatter::error([
                    'error'=> $error
                ],__('messages.detail_jurnal_controller.gagal_ditambah'),500);
                
            }
    }


    public function show_by_id($id)
    {
        try {
            //code...
            $jurnal = DetailJurnalTemp::where('jurnal_id',$id)->first();
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

    public function show_by_jurnal($jurnal)
    {
        try {
            //code...
            $jurnal = DetailJurnalTemp::where('jurnal_id',$jurnal)->get();
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

    public function update_by_id(Request $request, $id)
    {
        try {
            //code...
            $request->validate([
                'kode_voucher'=> 'required|max:20',
                'tanggal'     => 'required|max:150',
                'jam'         => 'required',
                'user_id'     => 'required',
                'jenis'       => 'required',
                'note'        => 'required',
            ]);

            DetailJurnalTemp::where('jurnal_id',$id)->update($request->all());
            $a = DetailJurnalTemp::where('jurnal_id', $id)->first();

            return ResponseFormatter::success([
                'jurnal'=> $a
            ],__('messages.detail_jurnal_controller.berhasil_diubah'));
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
            DetailJurnalTemp::where('jurnal_id',$id)->delete();
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
