<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        Query Builder Style
        ======================================
        */
        // $orders = DB::table('orders_products')
        //     ->select(
        //         'orders_products.order_id',
        //         'orders_products.product_id',
        //         'orders_products.id as orderProduct_id',
        //         'products.*',
        //         'products.name as product_name',
        //         'users.*'
        //     )            
        //     ->join('products', 'orders_products.product_id', '=', 'products.id')
        //     ->join('orders', 'orders_products.order_id', '=', 'orders.id')
        //     ->join('users', 'orders.user_id', '=', 'users.id')
        //     ->get();
        // return $orders;

        /*
        Eloquent Style
        ======================================
        */
        $orders = Order::with('user')
            ->with('products')
            ->get();

        return view('admin.orders.listing', $orders);
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
        // Valdiate requests
        $request->validate([
            'user_id' => 'required',
            'product_ids' => 'required',
        ]);

        // Initialize a new order
        $order = new Order([
            'user_id' => $request->get('user_id'),
        ]);

        // Save to order table
        $order->save();

        foreach ($request->get('product_ids') as $product) {
            // Initialize new order_product
            $orderProduct = new OrdersProduct([
                'product_id' => $product,
                'order_id' => $order->id,
            ]);

            // Save to order_products table
            $orderProduct->save();
        }

        // Here return a String because it is stage 1,
        // we will make it to return a page at stage 2.
        return "Success";

        // return to view .... (stage 2)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* 
        Query Builder style 
        ==========================================
        */

        // $orders = DB::table('orders_products')
        //     ->select(
        //         'orders_products.order_id',
        //         'orders_products.product_id',
        //         'orders_products.id as order_product_id',
        //         'orders.status as order_status',
        //         'products.*',
        //         'products.name as product_name',
        //         'users.*'
        //     )
        //     ->where('order_id', $id)
        //     ->join('products', 'orders_products.product_id', '=', 'products.id')
        //     ->join('orders', 'orders_products.order_id', '=', 'orders.id')
        //     ->join('users', 'orders.user_id', '=', 'users.id')
        //     ->get();
        // return $orders;

        /* 
        Eloquent style 
        ==========================================
        */
        // $orders = OrdersProduct::where('order_id', $id)
        //          ->with('order')  
        //          ->with('order.user')                 
        //          ->with('product')                 
        //          ->get();

        $orders = Order::with('user')
            ->with('products')
            ->where('id', $id)
            ->get();
        return $orders;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $order = Order::find($id);
        return "edit view";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id order_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Allow users to change product of a order

        $request->validate([
            'old_product_id' => 'required',
            'product_id' => 'required',
            'status' => 'required'
        ]);

        /*
        Query Builder Style
        ==============================
        */
        // $affectedOrderProducts = DB::table('orders_products')
        //     ->where([
        //         ['order_id', '=', $id],
        //         ['product_id', '=', $request->get('old_product_id')],
        //     ])
        //     ->update([
        //         'product_id' => $request->get('product_id')
        //     ]);       

        // $affectedOrder = DB::table('orders')
        //         ->where("id", $id)
        //         ->update([
        //             "status" => $request->get('status')
        //         ]);


        /*
        Eloquent Style
        ==============================
        */
        // Update order product
        OrdersProduct::where('order_id', $id)
            ->where('product_id', $request->get('old_product_id'))
            ->update(['product_id' => $request->get('product_id')]);

        // Update order 
        Order::where('id', $id)
            ->update(['status' => $request->get('status')]);

        return OrdersProduct::where('order_id', $id)
            ->with('order')
            ->with('product')
            ->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        OrdersProduct::where("order_id", $id)->delete();

        return "Deleted";
    }
}
