<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;
use App\Room;
use App\Building;
use App\User;
use App\PromoDetail;
use Illuminate\Support\Facades\Auth;


class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo=Promo::all();
        $room=Room::all();
        $building=Building::all();
        if(request()->segment(1)=='api'){
            if($promo){
                foreach($promo as $i =>$item){
                    $promo[$i]->room_or_building_id=json_decode($item->room_or_building_id);
                }
                return response()->json([
                    'data'=> $promo,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
        return view('merchant/promo', compact('promo','room','building'));
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
            $file = $request->file('gambar_promo');
            $gambar_promo="";
            if($file){
            $gambar_promo = $file->move('promo',$file->getClientOriginalName());
            }
            $date = explode(" - ",$request['tanggal_promo']);
            Promo::create([
                'user_id'=>Auth::user()->id_user,
                'gambar_promo'=>$gambar_promo,
                'nama_promo'=>$request['nama_promo'],
                'diskon'=>$request['diskon'],
                'nominal'=>$request['nominal'],
                'batas_durasi_per_jam'=>$request['batas_durasi_per_jam'],
                'kuota'=>$request['kuota'],
                'deskripsi'=>$request['deskripsi'],
                'start_date'=>date_format(date_create_from_format("m/d/Y H:i A",$date[0]),"Y-m-d H:i:s"),
                'end_date'=>date_format(date_create_from_format("m/d/Y H:i A",$date[1]),"Y-m-d H:i:s"),
                'role_id'=>Auth::user()->role_id,
                'room_or_building_id'=>json_encode($request['room_or_building_id']),
                'status_penyebaran'=>$request['status_penyebaran']
            ]);

            return redirect()->back()->with('success', 'promo telah berhasil ditambahkan');
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
        $promo = Promo::find($id);
        
        $file = $request->file('gambar_promo');
        if($file){
            $gambar_promo = $file->move('promo',$file->getClientOriginalName());
            $promo->gambar_promo = $gambar_promo;
        }
        $date = explode(" - ", $request->post('tanggal_promo'));
        if($date){
            $promo->start_date = date_format(date_create_from_format("m/d/Y H:i A",$date[0]),"Y-m-d H:i:s");
            $promo->end_date = date_format(date_create_from_format("m/d/Y H:i A",$date[1]),"Y-m-d H:i:s");
        }
        $promo->nama_promo = $request->post('nama_promo');
        $promo->diskon = $request->post('diskon');
        $promo->nominal = $request->post('nominal');
        $promo->deskripsi = $request->post('deskripsi');
        $promo->batas_durasi_per_jam = $request->post('batas_durasi_per_jam');
        $promo->kuota = $request->post('kuota');
        $promo->room_or_building_id = $request->post('room_or_building_id');
        $promo->status_penyebaran = $request->post('status_penyebaran');
        $promo->save();
        return redirect()->back()->with('success', 'promo telah berhasil diubah');
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
            $promo = Promo::find($id);
            $promo->delete();

            return redirect()->back()->with('success', 'kategori telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
