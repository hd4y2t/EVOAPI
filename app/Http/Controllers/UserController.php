<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Hamcrest\Core\IsSame;
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
                    // $user->remember_token = $tokenResult;
                    // $user->update();
                    return ResponseFormatter::success([
                       'access_token'=> $tokenResult,
                       'token_type'=> 'Bearer',
                       'user'=>$user
                    ], 'Selamat Datang '.$user['name']);
                }else{
                    return ResponseFormatter::error([
                        'message' => 'Password Salah',
                    ], 'User gagal Login',500);
                }
            }else{
                return ResponseFormatter::error([
                    'message' => 'Email tidak ditemukan',
                ], 'User gagal Login',500);
            }
           }catch(Exception $error){
               return ResponseFormatter::error([
                   'message' => 'Something went wrong!',
                   'error' => $error,
                ], 'User gagal Login',500);
           }
    }
    
    public function show_all()
    {
        //
         //
        $user = User::all();
        return ResponseFormatter::success([
            'user' => $user,
         ], 'Data user berhasil diambil');
        
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
            ], 'User Terdaftar');
           }catch(Exception $error){
               return ResponseFormatter::error([
                   'message' => 'Something went wrong!',
                   'error' => $error,
                ], 'User gagal daftar',500);
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
    public function update_by_id(Request $request, $id)
    {
        //
        try{
            $request->validate([
               'name' => [ 'string','max:255'],
               'email' => [ 'string','max:255','email','unique:users'],
            ]);   
         
            User::where('id', $id)->update($request->all());
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
            User::where('id',$id)->delete();
            return ResponseFormatter::success([
                'message' => 'Data user berhasil dihapus'
            ],'Data User berhasil dihapus');
        } catch (Exception $error) {
            //throw $th;
            return ResponseFormatter::error([
                'message' => $error->getMessage(),
                'error' => $error
            ], 'Data User gagal dihapus');
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        
        return ResponseFormatter::success($token, 'Token berhasil dihapus');
    }


}
