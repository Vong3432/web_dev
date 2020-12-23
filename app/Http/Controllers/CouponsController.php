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

        return view('admin.coupons.listing', ['coupons' => $coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
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
        
        // === Opt 1 ===
        /* $coupon = new Coupon([
            'code' => $request->get('code'),
            'type' => $request->get('type'),
            'value' => $request->get('value'),
            'percent_off' => $request->get('percent_off'),
        ]); */
        
        // Save to Coupon table
        // $coupon->save();
        // === /Opt 1 ===

        // === Opt 2 ===
        Coupon::create($request->all());
        // === /Opt 2 ===

        return redirect()->route('admin.coupons')->with('success', 'Coupon created successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
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
        
        // === Opt 1 ===
        /* $coupon = Coupon::with('product')
        ->where('id', $id)
        ->get();
        
        return $coupon; */
        // === /Opt 1 ===
        
        // === Opt 2 ===
        return view('admin.coupons.show', compact('coupon'));
        // === /Opt 2 ===
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    public function edit(Coupon $coupon)
    {
        // $coupon = Coupon::find($id);
        // return view('admin.coupons.edit', $id);

        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(Request $request, Coupon $coupon)
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

        // === Opt 1 ===
        /* $affectedCoupon = Coupon::where('id', $id)
            ->update([
                'code' => $request->get('code'), 
                'type' => $request->get('type'), 
                'value' => $request->get('value'), 
                'percent_off' => $request->get('percent_off')
            ]); */
        // === /Opt 1 ===

        // === Opt 2 ===
        $coupon->update($request->all());
        // === /Opt 2 ===

        return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully');
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
        
        return redirect()->route('admin.coupons')->with('Coupon deleted successfully');

        /* session()->forget('coupon');

        return redirect()->route('checkout.index')->with('success_message', 'Coupon has been removed!'); */
    }
}
