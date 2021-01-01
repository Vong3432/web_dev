<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Client\Request;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $totalCustomers = User::where('level', "user")->count();
        $totalOrders = Order::get()->count();  
        
        // Stripe balance
        $stripe = Stripe::make(config('app.STRIPE_SECRET'));        
        $balance = $stripe->balance()->current();                
        $totalRevenue = $balance['pending'][0]['amount'];        

        return view('admin.dashboard', [
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue
        ]);
    }

    public function refundRequests(Request $request, $id)
    {
        dd($id);
    }
}
