<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuildingType;
use App\Building;

class BuildingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $building_type=BuildingType::all();
        return view('master/building_type', compact('building_type'));
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
            BuildingType::create([
                'nama_tipe'=>$request['nama_tipe'],
                'status_tipe'=>$request['status_tipe'],
            ]);
            return redirect()->back()->with('success', 'jenis bangunan telah berhasil ditambahkan');
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
        $building_type = BuildingType::find($id);
        
        $building_type->nama_tipe = $request->post('nama_tipe');
        $building_type->status_tipe = $request->post('status_tipe');
        $building_type->save();
        return redirect()->back()->with('success', 'jenis bangunan telah berhasil diubah');
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
            $building_type = BuildingType::find($id);
            $building_type->delete();

            return redirect()->back()->with('success', 'jenis bangunan telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
