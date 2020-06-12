<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomCategory;
use App\Room;
use App\RoomDetail;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_category=RoomCategory::all();
        return view('master/room_category', compact('room_category'));
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
            RoomCategory::create([
                'nama_kategori'=>$request['nama_kategori'],
                'gambar_kategori'=>$request['gambar_kategori'],
            ]);
            return redirect()->back()->with('success', 'kategori telah berhasil ditambahkan');
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
        $room_category = RoomCategory::find($id);
        
        $room_category->nama_kategori = $request->post('nama_kategori');
        $room_category->gambar_kategori = $request->post('gambar_kategori');
        $room_category->save();
        return redirect()->back()->with('success', 'kategori telah berhasil diubah');
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
            $room_category = RoomCategory::find($id);
            $room_category->delete();

            return redirect()->back()->with('success', 'kategori telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
