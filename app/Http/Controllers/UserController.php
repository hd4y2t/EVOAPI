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
               'name' =>['required','string','max:255','unique:costumer'],
               'email' => ['required', 'string','email','max:255','unique:costumer'],
               'password' => ['required', 'string', Password::min(3)],
            ]);   
            User::create([
               'name' => $request->name,
               'email' => $request->email,
               'username' =>$request->username,
               'password' => Hash::make($request->password),
            ]);
   
           $user= User::where('kode', $request->kode)->first();
   
            $tokenResult=$user->createToken('authToken')->plainTextToken;
   
            return ResponseFormatter::success([
               'access_token'=> $tokenResult,
               'token_type'=> 'Bearer',
               'costumer'=>$user
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
}
