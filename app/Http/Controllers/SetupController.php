<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setup;
use App\SetupDetail;
use App\Room;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_setup=Setup::all();
        if(request()->segment(1)=='api'){
            if($room_setup){
                return response()->json([
                    'data'=> $room_setup,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
        return view('master/room_setup', compact('room_setup'));
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
            $file = $request->file('gambar_setup');
            $gambar_setup="";
            if($file){
            $gambar_setup = $file->move('setup',$file->getClientOriginalName());
            }
            Setup::create([
                'nama_setup'=>$request['nama_setup'],
                'gambar_setup'=>$gambar_setup,
            ]);
        return redirect()->back()->with('success', 'setup ruangan telah berhasil ditambahkan');
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
        $room_setup = Setup::find($id);
        
        $room_setup->nama_setup = $request->post('nama_setup');
        $file = $request->file('gambar_setup');
        if($file){
            $gambar_setup = $file->move('setup',$file->getClientOriginalName());
            $room_setup->gambar_setup = $gambar_setup;
        }
        $room_setup->save();
        return redirect()->back()->with('success', 'setup ruangan telah berhasil diubah');
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
            $room_setup = Setup::find($id);
            $room_setup->delete();

            return redirect()->back()->with('success', 'setup ruangan telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
