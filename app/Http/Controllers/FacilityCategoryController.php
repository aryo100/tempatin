<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacilityCategory;
use App\Room;
use App\FacilityDetail;

class FacilityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility_category=FacilityCategory::all();
        if(request()->segment(1)=='api'){
            if($facility_category){
                return response()->json([
                    'data'=> $facility_category,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
        return view('master/facility_category', compact('facility_category'));
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
            $file = $request->file('gambar_fasilitas');
            $gambar_fasilitas="";
            if($file){
            $gambar_fasilitas = $file->move('fasilitas',$file->getClientOriginalName());
            }
            FacilityCategory::create([
                'nama_fasilitas'=>$request['nama_fasilitas'],
                'gambar_fasilitas'=>$gambar_fasilitas,
            ]);
        return redirect()->back()->with('success', 'jenis fasilitas telah berhasil ditambahkan');
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
        $facility_category = FacilityCategory::find($id);
        
        $facility_category->nama_fasilitas = $request->post('nama_fasilitas');
        $file = $request->file('gambar_fasilitas');
        if($file){
            $gambar_fasilitas = $file->move('fasilitas',$file->getClientOriginalName());
            $facility_category->gambar_fasilitas = $gambar_fasilitas;
        }
        $facility_category->save();
        return redirect()->back()->with('success', 'jenis fasilitas telah berhasil diubah');
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
            $facility_category = FacilityCategory::find($id);
            $facility_category->delete();

            return redirect()->back()->with('success', 'jenis fasilitas telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
