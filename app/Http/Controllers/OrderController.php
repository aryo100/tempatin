<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\FormContent;
use App\Package;
use App\Room;
use App\PromoDetail;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
            $order = Order::create([
                'user_id'=>$request['user_id'],
                'form_id'=>$request['form_id'],
                'room_id'=>$request['room_id'],
                'promo_detail_id'=>$request['promo_detail_id'],
                'status_order'=>$request['status_order'],
            ]);
            $cost=0;
            for ($i=0; $i < count($request['order_detail']); $i++) {
                $order_detail=[
                  'order_id' => $order->id_order,
                  'package_id' => $request['order_detail'][$i]['package_id'],
                  'schedule_id' => $request['order_detail'][$i]['schedule_id'],
                  'jam_mulai' => $request['order_detail'][$i]['jam_mulai'],
                  'jam_selesai' => $request['order_detail'][$i]['jam_selesai'],
                  'total_package' => $request['order_detail'][$i]['total_package'],
                ];
                $package=Package::where('id_package',$request['order_detail'][$i]['package_id'])->with(['package_detail'])->first();
                // echo json_encode($package[0]->package_detail[0]->harga);
                $cost=$cost+floatval($package->package_detail[0]->harga);
                // break;
                OrderDetail::create($order_detail);
            }
            $order->cost_total=$cost;
            $order->save();
            for ($i=0; $i < count($request['form_content']); $i++) {
                // $form_detail=FormDetail::find($request['form_content'][$i]['form_detail_id']);
                // $default_value=$form_detail->??
                $form_content=[
                  'order_id' => $order->id_order,
                  'form_detail_id' => $request['form_content'][$i]['form_detail_id'],
                  'value' => $request['form_content'][$i]['value']==""?$request['form_content'][$i]['value']:$default_value,
                ];
                FormContent::create($form_content);
            }
            return response()->json([
                'data' => $order,
                'error' => false
            ]);
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
        $order=Order::find($id)->with(['order_detail'])->with('form_content')->get();
        if(request()->segment(1)=='api'){
            if($order){
                return response()->json([
                    'data'=> $order,
                    'error' => false
                ]);
            }else{
                return response()->json([
                    'error' => true
                ]);
            }
        }
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
        //
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
            $order = Order::find($id);
            $order->delete();
            $order_detail = OrderDetail::where('order_id',$id);
            $order_detail->delete();
            $form_content = FormContent::where('order_id',$id);
            $form_content->delete();

            // return redirect()->back()->with('success', 'order telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
