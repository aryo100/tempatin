<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\PackageDetail;
use App\Room;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $package=Package::all();
        if(request()->segment(1)=='api'){
            if($package){
                return response()->json([
                    'data'=> $package,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
        return view('master/package', compact('package'));
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
            Package::create([
                'nama_paket'=>$request['nama_paket'],
                'durasi'=>$request['durasi'],
                'status_paket'=>$request['status_paket'],
            ]);
            return redirect()->back()->with('success', 'jenis durasi telah berhasil ditambahkan');
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
        $package = Package::find($id);
        
        $package->nama_paket = $request->post('nama_paket');
        $package->durasi = $request->post('durasi');
        $package->status_paket = $request->post('status_paket');
        $package->save();
        return redirect()->back()->with('success', 'jenis durasi telah berhasil diubah');
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
            $package = Package::find($id);
            $package->delete();

            return redirect()->back()->with('success', 'jenis durasi telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
