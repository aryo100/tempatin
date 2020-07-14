<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showToken() {
        echo csrf_token(); 
  
    }

    public function index()
    {
        $user=User::all();
        
        if(request()->segment(1)=='api'){
            if($user){
                return response()->json([
                    'data'=> $user,
                    'error' => false
                ]);
            }else{ 
                return response()->json([
                    'error' => true
                ]);
            }
        }else{
            return view('master/user', compact('user'));
        }
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
        try{
            $file = $request->file('foto_profile');
            $foto_profile="";
            if($file){
            $foto_profile = $file->move('foto',$file->getClientOriginalName());
            }
            $data=$request->all();
            User::create([
                'foto_profile' => $foto_profile,
                'nama_user' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => $request['role_id']?$data['role_id']:1,
                'status_user'=>$data['status_user']?$data['status_user']:'approved',
            ]);
            return redirect()->back()->with('success', 'user telah berhasil ditambah');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
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
        $user = User::find($id);
        if($user){
            return response()->json([
                'data'=> $user,
                'error' => false
            ]);
        }else{ 
            return response()->json([
                'error' => true
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user=User::find(Auth::user()->id_user);
        return view('merchant/profile', compact('user'));
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
        $user = User::find($id);
        
        $file = $request->file('foto_profile');
        if($file){
            $foto_profile = $file->move('foto',$file->getClientOriginalName());
            $user->foto_profile = $foto_profile;
        }
        if($request->post('nama')){
            $user->nama_user = $request->post('nama');
        }
        if($request->post('no_telp')){
            $user->no_telp = $request->post('no_telp');
        }
        if($request->post('no_rek')){
            $user->no_rek = $request->post('no_rek');
        }
        if($request->post('email')){
            $user->email = $request->post('email');
        }
        if($request->post('password')){
            $user->password = Hash::make($request->post('password'));
        }
        if(request()->segment(1)!='api'){
            if($request->post('role_id')){
            $user->role_id = $request->post('role_id');
            }
            if($request->post('status_user')){
            $user->status_user = $request->post('status_user');
            }
        }
        $user->save();
        if(request()->segment(1)=='api'){
            if($user){
                return response()->json([
                    'data'=> $user,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }else{
                return redirect()->back()->with('success', 'user telah berhasil diubah');
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
        try{
            $user = User::find($id);
            $user->delete();

            return redirect()->back()->with('success', 'user telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
