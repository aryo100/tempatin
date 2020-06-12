<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\RoomCategory;
use App\CategoryDetail;
use App\Setup;
use App\SetupDetail;
use App\Package;
use App\PackageDetail;
use App\FacilityCategory;
use App\FacilityDetail;
use App\Schedule;
use App\OrderDetail;
use App\Promo;
use App\Review;
use App\Building;
use App\BuildingDetail;
use App\Form;
use App\FormDetail;
use Illuminate\Support\Facades\Auth;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room=Room::all();
        $room_category=RoomCategory::all();
        // $provinsi=RajaOngkir::Provinsi()->all();
        // $kota=RajaOngkir::Kota()->all();
        return view('merchant/room', compact('room','room_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room_category=RoomCategory::all();
        $facility_category=FacilityCategory::all();
        $setup=Setup::all();
        $package=Package::all();
        $promo=Promo::all();
        $building=Building::where('user_id',Auth::user()->id_user)->where('status_tempat','publish')->get();
        $form=Form::where('user_id',Auth::user()->id_user)->where('status_formulir','publish')->get();
        $schedule=[];
        return view('merchant/add_room', compact('schedule','room_category','facility_category','setup','package','building','form','promo'));
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
            if($files=$request->file('foto_ruangan')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('foto_ruangan',$name);
                    $images[]=$name;
                }
            }
            $image='';
            if($file=$request->file('foto_denah')){
                $name=$file->getClientOriginalName();
                $file->move('foto_denah',$name);
                $image=$name;
            }
            /*Insert your data*/
        
            $room=Room::create([
                'user_id'=>Auth::user()->id_user,
                'building_id'=>$request['building_id'],
                'form_id'=>json_encode($request['form_id']),
                'nama_ruangan'=>$request['nama_ruangan'],
                'foto_ruangan'=>json_encode($images),
                'deskripsi'=>$request['deskripsi'],
                'aturan'=>$request['aturan'],
                'kapasitas'=>$request['kapasitas'],
                'lantai'=>$request['lantai'],
                'foto_denah'=>$image,
                'status_ruangan'=>$request['status_ruangan'],
            ]);
            
            for ($i=0; $i < count($request['category']); $i++) {
                $data=[
                    'room_id' =>$room->id_room,
                    'room_category_id' =>$request['category'][$i],
                ];
                CategoryDetail::create($data);
            }
            for ($i=0; $i < count($request['setup']); $i++) {
                $data=[
                    'room_id' =>$room->id_room,
                    'setup_id' =>$request['setup'][$i],
                ];
                SetupDetail::create($data);
            }
            for ($i=0; $i < count($request['facility']); $i++) {
                $data=[
                    'room_id' =>$room->id_room,
                    'facility_category_id' =>$request['facility'][$i],
                ];
                FacilityDetail::create($data);
            }

            for ($i=0; $i < count($request['paket']); $i++) {
                $data=[
                  'room_id' => $room->id_room,
                  'package_id' => $request['paket'][$i]['package_id'],
                  'harga' => $request['paket'][$i]['harga'],
                ];
                PackageDetail::create($data);
            }

            foreach($request['hari'] as $i => $hari) {
                if($hari){
                    $jam = explode(" - ",$request['jam'][$i]);
                    $data=[
                    'room_id' => $room->id_room,
                    'hari' => $hari,
                    'jam_buka' => $jam[0],
                    'jam_tutup' => $jam[1],
                    'status_jadwal' => 'public',
                    ];
                    Schedule::create($data);
                }
            }
            
            return redirect()->route('index.room')->with('success', 'ruangan telah berhasil ditambahkan');
            // return redirect()->back()->with('success', 'ruangan telah berhasil ditambahkan');
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
        $room_category=RoomCategory::all();
        $facility_category=FacilityCategory::all();
        $setup=Setup::all();
        $package=Package::all();
        $promo=Promo::all();
        $building=Building::where('user_id',Auth::user()->id_user)->where('status_tempat','publish')->get();
        $form=Form::where('user_id',Auth::user()->id_user)->where('status_formulir','publish')->get();
        
        $room=Room::find($id);
        $category_detail = CategoryDetail::where('room_id',$id)->get();
        // echo json_encode($category_detail);
        $setup_detail = SetupDetail::where('room_id',$id)->get();
        $facility_detail = FacilityDetail::where('room_id',$id)->get();
        $package_detail = PackageDetail::where('room_id',$id)->get();
        $schedule = Schedule::where('room_id',$id)->get();
        return view('merchant/add_room', compact('room','category_detail','setup_detail','facility_detail','package_detail','schedule','room_category','facility_category','setup','package','building','form','promo'));
    }

    /*public function api_package_detail($id)
    {
        $package_detail=PackageDetail::where('room_id',$id)->get();
        $i=0;
        foreach($package_detail as $item){
             echo'<div class="row mt-repeater-row">															
                    <div class="col-sm-3">   
                        <select id="paket" name="package_id['.$i.'][id_package]" value="'.$item->id_package.'"  data-placeholder="Click to Choose...">
                        @foreach($package as $item)	
                            <option value="{{$item->id_package}}">{{$item->nama_paket." = ".$item->durasi." ".$item->status_paket}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input name="harga['.$i.'][harga]" value="'.$item->harga.'" type="text" id="form-field-1" placeholder="Rp." />
                    </div>
                    <div class="col-md-1">
                        <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                            <i class="fa fa-close"></i>
                        </a>
                    </div>
                </div>';
            $i++;
        }
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        try{
            $images=array();
            if($files=$request->file('foto_ruangan')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('foto_ruangan',$name);
                    $images[]=$name;
                }
                
                $room->foto_ruangan=json_encode($images);
            }

            $image='';
            if($file=$request->file('foto_denah')){
                $name=$file->getClientOriginalName();
                $file->move('foto_denah',$name);
                $image=$name;
                $room->foto_denah=json_encode($image);
            }
            
            $room->building_id=$request['building_id'];
            $room->form_id=json_encode($request['form_id']);
            $room->nama_ruangan=$request['nama_ruangan'];
            $room->deskripsi=$request['deskripsi'];
            $room->aturan=$request['aturan'];
            $room->kapasitas=$request['kapasitas'];
            $room->lantai=$request['lantai'];
            $room->status_ruangan=$request['status_ruangan'];
            $room->save();

            $category_detail = CategoryDetail::where('room_id',$id);
            $category_detail->delete();
            for ($i=0; $i < count($request['category']); $i++) {
                $data=[
                  'room_id' => $id,
                  'room_category_id' =>$request['category'][$i]
                ];
                CategoryDetail::create($data);
            }

            $setup_detail = SetupDetail::where('room_id',$id);
            $setup_detail->delete();
            for ($i=0; $i < count($request['setup']); $i++) {
                $data=[
                  'room_id' => $id,
                  'setup_id' =>$request['setup'][$i],
                ];
                SetupDetail::create($data);
            }

            $facility_detail = FacilityDetail::where('room_id',$id);
            $facility_detail->delete();
            for ($i=0; $i < count($request['facility']); $i++) {
                $data=[
                  'room_id' => $id,
                  'facility_category_id' =>$request['facility'][$i],
                ];
                FacilityDetail::create($data);
            }

            $package_detail = PackageDetail::where('room_id',$id);
            $package_detail->delete();
            for ($i=0; $i < count($request['paket']); $i++) {
                $data=[
                  'room_id' => $id,
                  'package_id' => $request['paket'][$i]['package_id'],
                  'harga' => $request['paket'][$i]['harga'],
                ];
                PackageDetail::create($data);
            }
            $schedule = Schedule::where('room_id',$id);
            $schedule->delete();
            foreach($request['hari'] as $i => $hari) {
                if($hari){
                    $jam = explode(" - ",$request['jam'][$i]);
                    $data=[
                    'room_id' => $id,
                    'hari' => $hari,
                    'jam_buka' => $jam[0],
                    'jam_tutup' => $jam[1],
                    'status_jadwal' => 'public',
                    ];
                    Schedule::create($data);
                }
            }
            return redirect()->route('index.room')->with('success', 'ruangan telah berhasil diubah');
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
            $room = Room::find($id);
            CategoryDetail::where('room_id',$id)->delete();
            SetupDetail::where('room_id',$id)->delete();
            FacilityDetail::where('room_id',$id)->delete();
            PackageDetail::where('room_id',$id)->delete();
            Schedule::where('room_id',$id)->delete();
            $room->delete();

            return redirect()->back()->with('success', 'Data ruangan telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
