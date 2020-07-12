<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\FormContent;
use App\Package;
use App\PackageDetail;
use App\Room;
use App\PromoDetail;
use Illuminate\Support\Facades\Auth;
use XenditClient\XenditPHPClient as Xendit;
use RajaOngkir;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order=Order::with(['order_detail'])->with('form_content')->with('room')->orderBy('created_at','desc')->get();
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
        if(Auth::user()->role_id==0){
            return view('master/order', compact('order'));
        }else if(Auth::user()->role_id==1){
            $order=$order->where('room.user_id',Auth::user()->id_user);
            // echo json_encode($order);
            return view('merchant/order', compact('order'));
        }
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
                'setup_id'=>$request['setup_id'],
                'start_date'=>date_format(date_create($request['start_date']),"Y-m-d H:i:s"),
                'end_date'=>date_format(date_create($request['end_date']),"Y-m-d H:i:s"),
                'promo_detail_id'=>$request['promo_detail_id'],
                'status_order'=>$request['status_order'],
            ]);
            $room = Room::with('schedule')->with('package')->find($request['room_id']);
            // echo json_encode($room);
            $schedule=$room->schedule;
            $package=$room->package;
            $data=[];
            for ($i=0; $i < count($schedule); $i++) {
                $data[$schedule[$i]->hari]=$schedule[$i];
                $data[$schedule[$i]->hari]->durasi=round((strtotime($schedule[$i]->jam_tutup)-strtotime($schedule[$i]->jam_buka))/(60 * 60));
                if($data[$schedule[$i]->hari]->durasi==24){
                    $data[$schedule[$i]->hari]->durasi=0;
                }
            }
            $schedule=$data;
            // echo json_encode($schedule);
            // echo json_encode($package);
            $start_date=strtotime($request['start_date']);
            $end_date=strtotime($request['end_date']);
            $cal_pack=[
                'hour' => 0,
                'day' => 0,
                'month' => 0,
                'year' => 0,
            ];
            $order_detail=[];
            // $order_detail=[
            //     'date_day'=>"",
            //     'jam_buka'=>"",
            //     'jam_tutup'=>""
            // ];
            // $order_detail=json_encode($order_detail);
            // return $order_detail;
            $order_no=0;
            while(date('Y m d H', $start_date) < date('Y m d H', $end_date)){

                $range_date=$end_date-$start_date;
                
                $hours  = round(($range_date) / (60 * 60));
                $days  = round(($hours) / ((24-$schedule[date('w',$start_date)+1]->durasi)));
                // echo date("Y m d H",$start_date)."=".(date('w',$start_date)+1)."|".$days." - ";
                // echo $schedule[date('w',$start_date]->durasi;

                $month=$start_date;
                $total_month=0;
                // $days_of_month=0;
                // $start_day = date("d",$start_date);
                // $end_day = date("d",$end_date);
                if($days>28){
                    while(date('Y m d', $month) < date('Y m d', $end_date))
                    {
                        $month = strtotime("+1 month", $month);
                        // $days_of_month=
                        $total_month++;
                    }
                    $month  = $total_month-1;
                }else{
                    $month=$total_month;
                }

                // $month = round(($range_date) / (60 * 60 * 24 * round($end_day-$start_day)));
                $year  = round($total_month/12);

                if($year>0){
                    $start_date = strtotime("+".$year." year", $start_date);
                    $cal_pack['year']=$year;
                }else if($month>0){
                    $start_date = strtotime("+".$month." month", $start_date);
                    $cal_pack['month']=$month;
                }else if($days>=0){
                    $date_day=date('Y-m-d',$start_date);
                    if(date("d",$start_date)==date("d",$end_date)){
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=date('H:i:s',$end_date);
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }elseif($order_no==0){
                        $jam_buka=date('H:i:s',$start_date);
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }else{
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=12;
                    }
                    $order_detail[$order_no]=[
                        'package_id'=>null,
                        'schedule_id'=>$schedule[date('w',$start_date)+1]->id_schedule,
                        'date_day'=>$date_day,
                        'jam_buka'=>$jam_buka,
                        'jam_tutup'=>$jam_tutup,
                        'durasi'=>$durasi
                    ];
                    $order_no++;
                    $start_date = strtotime("+1 day", $start_date);
                    $cal_pack['day']=$cal_pack['day']+$days;
                // }else if($hours>=24){
                //     $start_date = strtotime("+".round($hours/24)." day", $start_date);
                //     $cal_pack['day']=$cal_pack['day']+round($hours/24);
                }else if($hours>0){
                    // $order_detail[$order_no]=["date_day"=>date('Y-m-d',$start_date)];
                    // $order_no++;
                    $start_date = strtotime("+".$hours." hour", $start_date);
                    $cal_pack['hour']=$hours;
                }
            }
            // echo json_encode($cal_pack);
            $durasi=0;
            for ($i=0; $i < count($order_detail); $i++) {
                // $order_detail[$i]['order_id']=;
                for ($j=0; $j < count($package); $j++) {
                    if($package[$j]->durasi>$durasi&&$package[$j]->durasi<$order_detail[$i]['durasi']){
                        // echo $order_detail[$i]['package_id'];
                        $order_detail[$i]['package_id']=$package[$j]->id_package;
                        $order_detail[$i]['total_package']=round($order_detail[$i]['durasi']/$package[$j]->durasi);
                    }
                }
            }
            // return json_encode($order_detail);
            // if($days>1){
            //     for ($i=0; $i < $days; $i++) {
                    
                    
            //     }
            // }else{
            //     $order_detail=[
            //     'order_id' => $order->id_order,
            //     'package_id' => $request['order_detail'][$i]['package_id'],
            //     'schedule_id' => $request['order_detail'][$i]['schedule_id'],
            //     'date_day' => ,
            //     'jam_mulai' => ,
            //     'jam_selesai' => ,
            //     'total_package' => ,
            //     ];
            // }
            $cost=0;
            for ($i=0; $i < count($order_detail); $i++) {
                $order_d=[
                  'order_id' => $order->id_order,
                  'date_day' => $order_detail[$i]['date_day'],
                  'package_id' => $order_detail[$i]['package_id'],
                  'schedule_id' => $order_detail[$i]['schedule_id'],
                  'jam_mulai' => $order_detail[$i]['jam_buka'],
                  'jam_selesai' => $order_detail[$i]['jam_tutup'],
                  'total_package' => $order_detail[$i]['total_package'],
                ];
                $package=PackageDetail::with('package')->where('package_id',$order_detail[$i]['package_id'])->where('room_id',$order['room_id'])->first();
                // echo json_encode($package[0]->package_detail[0]->harga);
                $cost=$cost+($package->harga*$order_detail[$i]['total_package']);
                // break;
                OrderDetail::create($order_d);
                $o_d[$i]=$order_d;
            }
            $order->cost_total=$cost;
            $order->save();
            for ($i=0; $i < count($request['form_content']); $i++) {
                // $form_detail=FormDetail::find($request['form_content'][$i]['form_detail_id']);
                // $default_value=$form_detail->??
                // $request['form_content'][$i]['value']==""?: $default_value
                $form_content=[
                  'order_id' => $order->id_order,
                  'form_detail_id' => $request['form_content'][$i]['form_detail_id'],
                  'value' => $request['form_content'][$i]['value'],
                ];
                FormContent::create($form_content);
                $f_c[$i]=$form_content;
            }

            $options['secret_api_key'] = env('SECRET_API_KEY');
            $xenditPHPClient = new Xendit($options);

            $external_id = 'tempatin_payment_'.$order->id_order;
            $payer_email = $request['email'];
            $description = 'Room Payment by Web';
            $amount = $order->cost_total;

            $response = $xenditPHPClient->createInvoice($external_id, $amount, $payer_email, $description);
            $order->invoice_id=$response['external_id'];
            $order->status_order=$response['status'];
            $order->save();

            $order->order_detail=$o_d;
            $order->form_content=$f_c;
            return response()->json([
                'data' => $order,
                // 'xendit'=>$response,
                'error' => false
            ]);
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
    
    public function preview(Request $request)
    {
        try{
            $order = [
                'user_id'=>$request['user_id'],
                'form_id'=>$request['form_id'],
                'room_id'=>$request['room_id'],
                'setup_id'=>$request['setup_id'],
                'start_date'=>date_format(date_create($request['start_date']),"Y-m-d H:i:s"),
                'end_date'=>date_format(date_create($request['end_date']),"Y-m-d H:i:s"),
                'promo_detail_id'=>$request['promo_detail_id'],
                'status_order'=>$request['status_order'],
                'cost_total'=>0
            ];
            $room = Room::with('schedule')->with('package')->find($request['room_id']);
            // echo json_encode($room);
            $schedule=$room->schedule;
            $package=$room->package;
            $data=[];
            for ($i=0; $i < count($schedule); $i++) {
                $data[$schedule[$i]->hari]=$schedule[$i];
                $data[$schedule[$i]->hari]->durasi=round((strtotime($schedule[$i]->jam_tutup)-strtotime($schedule[$i]->jam_buka))/(60 * 60));
                if($data[$schedule[$i]->hari]->durasi==24){
                    $data[$schedule[$i]->hari]->durasi=0;
                }
            }
            $schedule=$data;
            // echo json_encode($schedule);
            // echo json_encode($package);
            $start_date=strtotime($request['start_date']);
            $end_date=strtotime($request['end_date']);
            $cal_pack=[
                'hour' => 0,
                'day' => 0,
                'month' => 0,
                'year' => 0,
            ];
            $order_detail=[];
            $order_no=0;
            while(date('Y m d H', $start_date) < date('Y m d H', $end_date)){

                $range_date=$end_date-$start_date;
                
                $hours  = round(($range_date) / (60 * 60));
                $days  = round(($hours) / ((24-$schedule[date('w',$start_date)+1]->durasi)));
                // echo date("Y m d H",$start_date)."=".(date('w',$start_date)+1)."|".$days." - ";
                // echo $schedule[date('w',$start_date]->durasi;

                $month=$start_date;
                $total_month=0;
                // $days_of_month=0;
                // $start_day = date("d",$start_date);
                // $end_day = date("d",$end_date);
                if($days>28){
                    while(date('Y m d', $month) < date('Y m d', $end_date))
                    {
                        $month = strtotime("+1 month", $month);
                        // $days_of_month=
                        $total_month++;
                    }
                    $month  = $total_month-1;
                }else{
                    $month=$total_month;
                }

                // $month = round(($range_date) / (60 * 60 * 24 * round($end_day-$start_day)));
                $year  = round($total_month/12);

                if($year>0){
                    $start_date = strtotime("+".$year." year", $start_date);
                    $cal_pack['year']=$year;
                }else if($month>0){
                    $start_date = strtotime("+".$month." month", $start_date);
                    $cal_pack['month']=$month;
                }else if($days>=0){
                    $date_day=date('Y-m-d',$start_date);
                    if(date("d",$start_date)==date("d",$end_date)){
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=date('H:i:s',$end_date);
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }elseif($order_no==0){
                        $jam_buka=date('H:i:s',$start_date);
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=(strtotime($jam_tutup)-strtotime($jam_buka))/3600;
                    }else{
                        $jam_buka=$schedule[date('w',$start_date)+1]->jam_buka;
                        $jam_tutup=$schedule[date('w',$start_date)+1]->jam_tutup;
                        $durasi=12;
                    }
                    $order_detail[$order_no]=[
                        'package_id'=>null,
                        'schedule_id'=>$schedule[date('w',$start_date)+1]->id_schedule,
                        'date_day'=>$date_day,
                        'jam_buka'=>$jam_buka,
                        'jam_tutup'=>$jam_tutup,
                        'durasi'=>$durasi
                    ];
                    $order_no++;
                    $start_date = strtotime("+1 day", $start_date);
                    $cal_pack['day']=$cal_pack['day']+$days;
                }else if($hours>0){
                    $start_date = strtotime("+".$hours." hour", $start_date);
                    $cal_pack['hour']=$hours;
                }
            }
            // echo json_encode($cal_pack);
            $durasi=0;
            for ($i=0; $i < count($order_detail); $i++) {
                for ($j=0; $j < count($package); $j++) {
                    if($package[$j]->durasi>$durasi&&$package[$j]->durasi<$order_detail[$i]['durasi']){
                        // echo $order_detail[$i]['package_id'];
                        $order_detail[$i]['package_id']=$package[$j]->id_package;
                        $order_detail[$i]['total_package']=round($order_detail[$i]['durasi']/$package[$j]->durasi);
                        $order_detail[$i]['total_test']=$order_detail[$i]['durasi']/$package[$j]->durasi;
                    }
                }
            }
            // return json_encode($order_detail);
            $cost=0;
            for ($i=0; $i < count($order_detail); $i++) {
                // $package=Package::whereHas('package_detail', function ($query) use ($order,$order_detail,$i){
                //         $query->where('package_details.room_id',$order['room_id']);
                // })
                // ->with('package_detail')
                // ->get();
                // $package=Package::with('package_detail')->where('id_package',$order_detail[$i]['package_id'])->where('package_details.room_id',$order['room_id'])->get();
                // $room=Room::with('package')->find($order['room_id']);
                $package=PackageDetail::with('package')->where('package_id',$order_detail[$i]['package_id'])->where('room_id',$order['room_id'])->first();
                $order_d=[
                  'package_id' => $order_detail[$i]['package_id'],
                  'schedule_id' => $order_detail[$i]['schedule_id'],
                  'jam_mulai' => $order_detail[$i]['jam_buka'],
                  'jam_selesai' => $order_detail[$i]['jam_tutup'],
                  'total_package' => $order_detail[$i]['total_package']
                ];
                // echo json_encode($package[0]->package_detail[0]->harga);
                // $cost=$cost+(floatval($package->package_detail[0]->harga)*$order_detail[$i]['total_package']);
                $cost=$cost+($package->harga*$order_detail[$i]['total_package']);
                // break;
                $o_d[$i]=$order_d;
            }
            $order['cost_total']=$cost;
            for ($i=0; $i < count($request['form_content']); $i++) {
                // $form_detail=FormDetail::find($request['form_content'][$i]['form_detail_id']);
                // $default_value=$form_detail->??
                // $request['form_content'][$i]['value']==""?: $default_value
                $form_content=[
                  'form_detail_id' => $request['form_content'][$i]['form_detail_id'],
                  'value' => $request['form_content'][$i]['value'],
                ];
                $f_c[$i]=$form_content;
            }
            $order['order_detail']=$o_d;
            $order['form_content']=$f_c;
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
        $order=Order::with(['order_detail'])->with('form_content')->with('room')->with(['setup'])->with('user')->find($id);
        $package_detail=PackageDetail::with('package')->get();
        $kota=RajaOngkir::Kota()->find($order->room->building->kota);
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

        if(Auth::user()->role_id==0){
            return view('master/pre_order', compact('order','package_detail','kota'));
        }else if(Auth::user()->role_id==1){
            // echo json_encode($order);
            return view('merchant/pre_order', compact('order','package_detail','kota'));
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
        $order = Order::find($id);
        
        if($request['user_id'])
        $order->user_id = $request['user_id'];
        if($request['form_id'])
        $order->form_id = $request['form_id'];
        if($request['room_id'])
        $order->room_id = $request['room_id'];
        if($request['setup_id'])
        $order->setup_id = $request['setup_id'];
        if($request['start_date'])
        $order->start_date = $request['start_date'];
        if($request['end_date'])
        $order->end_date = $request['end_date'];
        if($request['promo_detail_id'])
        $order->promo_detail_id = $request['promo_detail_id'];
        if($request['external_id'])
        $order->invoice_id = $request['external_id'];
        if($request['payment_method'])
        $order->method_pay = $request['payment_method'];
        if($request['status'])
        $order->status_order = $request['status'];
        $order->save();
        // $order_detail = OrderDetail::where('order_id',$id);
        // $order_detail->delete();
        // for ($i=0; $i < count($request['order-detail']); $i++) {
        //     $data=[
        //       'order_id' => $id,
        //       'nama_kolom' => $request['order-detail'][$i]['nama_kolom'],
        //       'tipe_input' => $request['order-detail'][$i]['tipe_input'],
        //       'input_awal' => json_encode(explode(',', $request['order-detail'][$i]['input_awal'])),
        //       'status_value' => empty($request['order-detail'][$i]['status_value']) ? 0:1,
        //     ];
        //     OrderDetail::create($data);
        // }

        if(request()->segment(1)=='api'){

            return response()->json([
                'data'=>$order,
                'error' => false
            ]);
        }else{
            return response()->json([
                'error' => true
            ]);
        }
        
        return redirect()->back()->with('success', 'order telah berhasil diubah');
    }
    
    public function callback(Request $request)
    {
        $order = Order::where('invoice_id',$request['external_id'])->first();
        $order->method_pay = $request['payment_method'];
        $order->status_order = $request['status'];
        $order->save();

        if(request()->segment(1)=='api'){

            return response()->json([
                'data'=>$order,
                'error' => false
            ]);
        }else{
            return response()->json([
                'error' => true
            ]);
        }

        return redirect()->back()->with('success', 'order telah berhasil diubah');
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

            return redirect()->back()->with('success', 'order telah berhasil dihapus');
        }catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ]);
        }
    }
}
