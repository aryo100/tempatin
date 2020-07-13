<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use App\Order;
use App\Building;
use App\Promo;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard_master()
    {
        $merchant=count(User::where('role_id',1)->get());
        $customer=count(User::where('role_id',2)->get());
        $room=count(Room::where('status_ruangan','publish')->get());
        $building=count(Building::where('status_tempat','publish')->get());
        $order_app=count(Order::where('status_order','APPROVE')->get());
        $order_unapp=count(Order::where('status_order','!=','APPROVE')->get());
        $promo=count(Promo::all());
        return view('master/dashboard', compact('merchant','customer','room','building','promo','order_app','order_unapp'));
    }

    public function dashboard_merchant()
    {
        $user=Auth::user();
        $room=count(Room::where('status_ruangan','publish')->where('user_id',Auth::user()->id_user)->get());
        $building=count(Building::where('status_tempat','publish')->where('user_id',Auth::user()->id_user)->get());
        $order_app=Order::where('status_order','APPROVE')
        ->whereHas('room', function ($query) use ($user){
                $query->where('rooms.user_id',$user->id_user);
        })
        ->get();
        $order_new=Order::where('status_order','UNPAID')
        ->whereHas('room', function ($query) use ($user){
                $query->where('rooms.user_id',$user->id_user);
        })
        ->get();
        $order_pen=Order::where('status_order','PAID')
        ->whereHas('room', function ($query) use ($user){
                $query->where('rooms.user_id',$user->id_user);
        })
        ->get();
        $order_unapp=Order::where('status_order','UNAPPROVE')
        ->whereHas('room', function ($query) use ($user){
                $query->where('rooms.user_id',$user->id_user);
        })
        ->get();
        $order_app=count($order_app);
        $order_new=count($order_new);
        $order_pen=count($order_pen);
        $order_unapp=count($order_unapp);
        $promo=count(Promo::where('user_id',Auth::user()->id_user)->get());
        return view('merchant/dashboard', compact('room','building','promo','order_app','order_new','order_pen','order_unapp'));
    }
}
