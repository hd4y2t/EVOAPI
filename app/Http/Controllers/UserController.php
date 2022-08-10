<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function login(Request $request){
        try{
            $request->validate([
               'email' => ['required', 'string','email','max:255'],
               'password' => ['required', 'string', Password::min(6)],
            ]);   
            $user= User::where('email', $request->email)->first();
            if($user){
                if(Hash::check($request->password, $user->password)){
                    $tokenResult=$user->createToken('authToken')->plainTextToken;
                    return ResponseFormatter::success([
                       'access_token'=> $tokenResult,
                       'token_type'=> 'Bearer',
                       'user'=>$user
                    ], __('messages.user_controller.berhasil_login').$user['name']);
                }else{
                    return ResponseFormatter::error([
                        'message' => __('messages.user_controller.password_salah'),
                    ], __('messages.user_controller.password_salah'),500);
                }
            }else{
               return ResponseFormatter::error([
                    'message' => __('messages.user_controller.email_tidak_ada'),
                ], __('messages.user_controller.email_tidak_ada'),500);
            }
           }catch(Exception $error){
              return ResponseFormatter::error([
                   'message' => __('messages.user_controller.gagal_login'),
                   'error' => $error,
                ], __('messages.user_controller.gagal_login'),500);
           }
    }
    
    public function show_all()
    {
        //
         //
        $user = User::all();
       return ResponseFormatter::success([
            'user' => $user,
         ], __('messages.user_controller.berhasil_ambil'));
        
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
        try{
            $request->validate([
               'name' =>['required','string','max:255','unique:users'],
               'email' => ['required', 'string','email','max:255','unique:users'],
               'password' => ['required', 'string', Password::min(6)],
            ]);   
            User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
            ]);
   
            $user= User::where('email', $request->email)->first();
   
            $tokenResult=$user->createToken('authToken')->plainTextToken;
   
            return ResponseFormatter::success([
               'access_token'=> $tokenResult,
               'token_type'=> 'Bearer',
               'user'=>$user
            ],  __('messages.user_controller.berhasil_daftar'));
           }catch(Exception $error){
              return ResponseFormatter::error([
                   'message' => __('messages.error_json_umum.error_catch_data'),
                   'error' => $error,
                ], __('messages.error_json_umum.error_catch_meta'),500);
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
        try{
            $request->validate([
               'name' => [ 'string','max:255'],
               'email' => [ 'string','max:255','email','unique:users'],
            ]);   
         
            $user = User::where('id', $id)->update($request->all());
            return ResponseFormatter::success([
               'user'=>$user
            ], __('messages.user_controller.berhasil_daftar'));
           }catch(Exception $error){
               return ResponseFormatter::error([
                   'message' => __('messages.error_json_umum.error_catch_data'),
                   'error' => $error,
                ], __('messages.error_json_umum.error_catch_meta'),500);
           }
    }

    public function changePassword(Request $request, $id)
    {
        //
        try{
            $request->validate([
               'password' => [ 'string', Password::min(6)],
               'password2' => [ 'string', Password::min(6) ],
            ]);   
         
            User::where('id', $id)->update([
               'password' => Hash::make($request->password2),
            ]);
            $user= User::where('email', $request->email)->first();
            return ResponseFormatter::success([
              'user'=>$user
            ], 'User Terdaftar');
           }catch(Exception $error){
               return ResponseFormatter::error([
                   'message' => 'Something went wrong!',
                   'error' => $error,
                ], 'User gagal daftar',500);
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
            User::where('id',$id)->delete();
            return ResponseFormatter::success([
                'message' => __('messages.user_controller.berhasil_hapus'),
            ], __('messages.user_controller.berhasil_hapus'));
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => __('messages.error_json_umum.error_catch_data'),
                'error' => $error
            ], __('messages.error_json_umum.error_catch_meta'),500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        
        return ResponseFormatter::success($token, 'Token berhasil dihapus');
    }


}
