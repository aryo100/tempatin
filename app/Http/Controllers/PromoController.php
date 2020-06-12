<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;
use App\Room;
use App\User;
use App\PromoDetail;


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
        return view('merchant/promo', compact('promo','room'));
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
            Promo::create([
                'gambar_promo'=>$gambar_promo,
                'kode'=>$request['kode'],
                'diskon'=>$request['diskon'],
                'used_times'=>$request['used_times'],
                'start_date'=>$request['start_date'],
                'end_date'=>$request['end_date'],
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
        $promo->kode = $request->post('kode');
        $promo->diskon = $request->post('diskon');
        $promo->used_times = $request->post('used_times');
        $promo->start_date = $request->post('start_date');
        $promo->end_date = $request->post('end_date');
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
