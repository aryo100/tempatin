<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Building;
use App\BuildingType;
use RajaOngkir;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $building=Building::all();
        $building_type=BuildingType::all();
        $provinsi=RajaOngkir::Provinsi()->all();
        $kota=RajaOngkir::Kota()->all();
        return view('merchant/building', compact('building','building_type','provinsi','kota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province=RajaOngkir::Provinsi()->all();
        $building_type=BuildingType::all();
        return view('merchant/add_building', compact('building_type','province'));
    }

    public function api_kota($id)
    {
        $city=RajaOngkir::Kota()->byProvinsi($id)->get();
        foreach($city as $item){
            echo "<option value='".$item['city_id']."'>".$item['city_name']."</option>";
        }
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
            $images=array();
            if($files=$request->file('foto_bangunan')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('foto_bangunan',$name);
                    $images[]=$name;
                }
            }
            /*Insert your data*/
        
            Building::create([
                'user_id'=>Auth::user()->id_user,
                'building_type_id'=>json_encode($request['type']),
                'nama_bangunan'=>$request['nama_bangunan'],
                'jumlah_lantai'=>$request['jumlah_lantai'],
                'deskripsi'=>$request['deskripsi'],
                'alamat'=>$request['alamat'],
                'kota'=>$request['kota'],
                'provinsi'=>$request['provinsi'],
                'negara'=>$request['negara'],
                'kode_pos'=>$request['kode_pos'],
                'status_tempat'=>$request['status_tempat'],
                'foto_bangunan'=>json_encode($images),
            ]);
            
            return redirect()->route('index.building')->with('success', 'bangunan telah berhasil ditambahkan');
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
        $province=RajaOngkir::Provinsi()->all();
        $building_type=BuildingType::all();
        $building=Building::find($id);
        return view('merchant/add_building', compact('building','building_type','province'));
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
        $building = Building::find($id);
        try{
            $images=array();
            if($files=$request->file('foto_bangunan')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('foto_bangunan',$name);
                    $images[]=$name;
                }
                
                $building->foto_bangunan=json_encode($images);
            }
        
            $building->building_type_id=json_encode($request['type']);
            $building->nama_bangunan=$request['nama_bangunan'];
            $building->jumlah_lantai=$request['jumlah_lantai'];
            $building->deskripsi=$request['deskripsi'];
            $building->alamat=$request['alamat'];
            $building->kota=$request['kota'];
            $building->provinsi=$request['provinsi'];
            $building->negara=$request['negara'];
            $building->kode_pos=$request['kode_pos'];
            $building->status_tempat=$request['status_tempat'];
            $building->save();
            return redirect()->route('index.building')->with('success', '
            bangunan telah berhasil diubah');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
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
            $building = Building::find($id);
            $building->delete();

            return redirect()->back()->with('success', 'Data bangunan telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
