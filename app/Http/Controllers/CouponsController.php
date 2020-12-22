<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
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
        /* $coupons = DB::table('coupons')
            ->select(
                'coupons.id',
                'coupons.code',
                'coupons.type',
                'coupons.value',
                'coupons.percent_off',
            )
            ->get(); */

        /*
        Eloquent Style
        ======================================
        */
        $coupons = Coupon::with('product')
            ->get();

        return $coupons;
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
        // Validate requests
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            /* 'value' => 'required',
            'percent_off' => 'required', */
        ]);

        // Initialize a new coupon
        $coupon = new Coupon([
            'code' => $request->get('code'),
            'type' => $request->get('type'),
            'value' => $request->get('value'),
            'percent_off' => $request->get('percent_off'),
        ]);

        // Save to Coupon table
        $coupon->save();

        return "done save";
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
        /* $coupon = DB::table('coupons')
        ->select(
            'coupons.code',
            'coupons.type',
            'coupons.value',
            'coupons.percent_off',
        )
        ->where('id', $id)
        ->get(); */
        
        /* 
        Eloquent style 
        ==========================================
        */
        $coupon = Coupon::with('product')
            ->where('id', $id)
            ->get();

        return $coupon;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $coupon = Coupon::find($id);
        return "edit view";
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
        // Allow user to change coupon of product
        
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'percent_off' => 'required',
        ]);

        /*
        Query Builder Style
        ==============================
        */
        /* $affectedCoupon = DB::table('coupons')
            ->where([
                ['id', '=', $id]
            ])
            ->update([
                'code' => $request->get('code'),
                'type' => $request->get('type'),
                'value' => $request->get('value'),
                'percent_off' => $request->get('percent_off'),
            ]); */

        /*
        Eloquent Style
        ==============================
        */
        // Update product coupon
        $affectedCoupon = Coupon::where('id', $id)
            ->update([
                'code' => $request->get('code'), 
                'type' => $request->get('type'), 
                'value' => $request->get('value'), 
                'percent_off' => $request->get('percent_off')
            ]);

        return $affectedCoupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        Query Builder Style
        ==============================
        */
        /* DB::table('coupons')
            ->where('id', $id)
            ->delete(); */
        
        /*
        Eloquent Style
        ==============================
        */
        Coupon::where('id', $id)->delete();
        return "Data deleted";

        /* session()->forget('coupon');

        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been removed!'); */
    }
}
