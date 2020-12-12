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
        $coupon = DB::table('coupons')
            ->select(
                'coupons.id',
                'coupons.code',
                'coupons.type',
                'coupons.value',
                'coupons.percent_off',
            )
            ->get();
        return $coupon;
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
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'percent_off' => 'required',
        ]);

        $coupon = new Coupon([
            'code' => $request->get('code'),
            'type' => $request->get('type'),
            'value' => $request->get('value'),
            'percent_off' => $request->get('percent_off'),
        ]);

        $coupon->save();
        return "done save";
        /* // return 'adding coupon';
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        // dd($coupon);
        if (!$coupon) {
            return redirect()->route('checkout.index')->withErrors('Invalid coupon code. Please try it again.');
        }

        session()->put('coupon', [
            'name' =>  $coupon->code,
            'discount' =>  $coupon->discount,
            'name' =>  $coupon->code,
        ]);

        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been applied!'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = DB::table('coupons')
        ->select(
            'coupons.code',
            'coupons.type',
            'coupons.value',
            'coupons.percent_off',
        )
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
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'percent_off' => 'required',
        ]);

        $affectedCoupon = DB::table('coupons')
            ->where([
                ['id', '=', $id]
            ])
            ->update([
                'code' => $request->get('code'),
                'type' => $request->get('type'),
                'value' => $request->get('value'),
                'percent_off' => $request->get('percent_off'),
            ]);

        return $affectedCoupon;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        DB::table('coupons')
            ->where('id', $id)
            ->delete();

        return "Data deleted";

        /* session()->forget('coupon');

        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been removed!'); */
    }
}
