<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::with('product')
            ->get();

        // return view('admin.vouchers.listing', ['vouchers' => $vouchers]);
        return view('admin.vouchers.listing', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(Request $request, $id)
    {        
        $request->validate([
            'model_id' => 'required',
            // 'data' => 'required',
        ]);

        $product = Products::findOrFail('model_id');

        $voucher = $product->createVoucher(['discount_percent' => '23']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Voucher $voucher)
    {
        // return view('admin.vouchers.show', compact('voucher'));
        return view('admin.vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        //Allow user to change voucher of product

        $request->validate([
            'code' => 'required',
            'model_id' => 'required',
            // 'data' => 'required',
        ]);

        $voucher->update($request->all());

        return redirect()->route('admin.vouchers')->with('success', 'Voucher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Voucher::where('id', $id)->delete();

        return redirect()->route('admin.vouchers')->with('Voucher deleted sucecessfully');
    }
}
