<?php

namespace App\Http\Controllers;

use App\Events\OrderReceived;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Products;
use App\Models\TradeRequest;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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
            ->with('ordered_products')
            ->with('ordered_products.product')            
            ->get();                            

        return view('admin.orders.listing', ['orders' => $orders]);
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
        try {
            // Valdiate requests
            $request->validate([
                'line1' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'state' => 'required'
            ]);

            $user = Auth::user();

            $user_id = $user->id;

            $items = \Cart::getContent();            

            $cartTotal = \Cart::getTotal();

            $stripeOrder = Stripe::charges()->create([
                'amount' => $cartTotal,
                'currency' => 'MYR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $user->email,
                'shipping' => [
                    'name' => $user->name,
                    'address' => [
                        'line1' => $request->line1,
                        'city' => $request->city,
                        'postal_code' => $request->postal_code,
                        'country' => 'MY',
                        'state' => $request->state
                    ]
                ],
                'metadata' => [
                    'quantity' => $items->count()
                ]
            ]);

            // Initialize a new order
            $order = new Order([
                'stripe_order_id' => $stripeOrder["id"],
                'user_id' => $user_id
            ]);

            // Save to order table
            $order->save();

            foreach ($items as $id => $product) {

                // Initialize new order_product
                $orderProduct = new OrdersProduct([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'quantity' => $product->quantity
                ]);

                // Save to order_products table
                $orderProduct->save();

                // Update product quantity
                Products::where('id', $product->id)->decrement('quantity', $product->quantity);                

            }

            // Post message
            event(new OrderReceived($order));

            // Clear cart
            \Cart::clear();

            // Return
            return view('success-checkout', [
                'order_id' => $order->id
            ]);

        } catch (Exception $err) {
            dd($err);
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
        /* 
        Query Builder style 
        ==========================================
        */

        /* $orders = DB::table('orders_products')
            ->select(
                'orders_products.order_id',
                'orders_products.product_id',
                'orders_products.id as order_product_id',
                'orders.status as order_status',
                'products.*',
                'products.name as product_name',
                'users.*'
            )
            ->where('order_id', $id)
            ->join('products', 'orders_products.product_id', '=', 'products.id')
            ->join('orders', 'orders_products.order_id', '=', 'orders.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->get();
        return $orders; */

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
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
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
        // Update order product
        if ($request->get('old_product_id') && $request->get('product_id')) {
            OrdersProduct::where('order_id', $id)
                ->where('product_id', $request->get('old_product_id'))
                ->update(['product_id' => $request->get('product_id')]);
        }

        // Update order status
        if ($request->get('status')) {

            try {
                Order::where('id', $id)
                    ->update(['status' => $request->get('status')]);

                /* Update product quantity - 1 if is delivering */

                return response()->json([
                    'success' => true,
                    'message' => 'Update status successfully'
                ], 200);
            } catch (Throwable $err) {
                return response()->json([
                    'success' => false,
                    'message' => 'Update status failed.'
                ], 422);
            }
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
        Order::where('id', $id)->delete();
        OrdersProduct::where("order_id", $id)->delete();

        return "Deleted";
    }

    public function getOrdersByUser(Request $request)
    {        
        $user_id = Auth::user()->id;
        $matchedUserRecord = User::where('id', $user_id)->with('orders', 'orders.ordered_products', 'orders.ordered_products.product', 'orders.ordered_products.product.images')->first();        
        // $matchedUserRecord = OrdersProduct::where('order_id', )                

        return view('orders', ['orders' => $matchedUserRecord->orders]);
    }

    public function refund(Request $request) 
    {
        $order_id = $request->id;        

        return view('refund', ['order_id' => $order_id]);
    }

    public function sendRefund(Request $request) 
    {
        $order_id = $request->order_id;                  

        $checkExistingOrderId = TradeRequest::where('order_id', $order_id)->first();

        if($checkExistingOrderId) {
            return redirect('my-orders')->with('flashMessage', "You have already sent a refund request for this order.");             
        }   
        
        $tradeRequest = new TradeRequest([
            'order_id' => $order_id,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'status' => "PENDING"
        ]);

        $tradeRequest->save();                    
        return redirect('my-orders')->with('flashMessage', "Your refund request have been sent. Please check it at request page.");            
    }

    public function viewRefundRequests()
    {
        $user = Auth::user();     
        $tradeRequests = TradeRequest::where('user_id', $user->id)
                        ->with('order', 'order.ordered_products', 'order.ordered_products.product', 'order.ordered_products.product.images')
                        ->get();               

        return view('refund-request', ['trade_requests' => $tradeRequests]);
    }

    public function viewAllUserRefunds()
    {
        $tradeRequests = TradeRequest::with('order', 'order.ordered_products', 'order.ordered_products.product', 'order.ordered_products.product.images')
                        ->get();                  

        return view('admin.orders.trade_request_listing', ['trade_requests' => $tradeRequests]);
    }

    public function updateRefundStatus(Request $request)
    {
        // dd($request->get('status'));

        try {
            $tradeRequestID = $request->id;            
            $message = "Update status successfully";            

            if($request->get('status') === "REFUNDED")
            {
                $stripeOrderID = $request->get('stripe_order_id');                
                
                $refund = Stripe::refunds()->create($stripeOrderID);

                $tradeRequest = TradeRequest::where('id', $tradeRequestID)->first();
                
                $refundedOrderID = $tradeRequest->order_id;
                $refundedProducts = OrdersProduct::where('order_id', $refundedOrderID)->get();  
                                

                foreach($refundedProducts as $row) {                    
                    Products::where('id', $row->product_id)->increment('quantity', $row->quantity);   
                }

                $message = 'Refund is in process';
            }        
    
            TradeRequest::where('id', $tradeRequestID)->update(['status' => $request->get('status')]);   

            return response()->json(['message' => $message], 200);
        } catch(Throwable $err) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
             

    }

}
