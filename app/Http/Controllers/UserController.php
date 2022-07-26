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
    public function index()
    {
        //
        
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
    public function show($id)
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
    public function update(Request $request, $id)
    {
        //
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
    }
    public function formLogin()
    {
        //
        return view('login');
    }

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
                    ], 'User Terdaftar');
                }else{
                    return ResponseFormatter::error([
                        'message' => 'Password Salah',
                    ], 'User gagal daftar',500);
                }
            }else{
                return ResponseFormatter::error([
                    'message' => 'Email tidak ditemukan',
                ], 'User gagal daftar',500);
            }
           }catch(Exception $error){
               return ResponseFormatter::error([
                   'message' => 'Something went wrong!',
                   'error' => $error,
                ], 'User gagal daftar',500);
           }
    }
}
