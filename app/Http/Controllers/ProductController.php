<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrdersProduct;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        $products = DB::table('products')
            ->select(
                'products.id',
                'products.name',
                'products.desc',
                'products.price',
                'products.sprice as sale_price',
                'products.quantity',
                'products.weight',
                'products.status',
                'products_categories.name as categories',
                'products.tags',
                'products.discount_rate',
                'products.created_at'
            )            
            ->join('products_categories', 'products_categories.id', '=', 'products.categories.id')
            ->get();
        return $products;
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
            'product_id' => 'required',
            'product_name'=> 'required',
            'product_price'=> 'required',
            'product_selling_price'=> 'required',
            'product_quantity' => 'required',
            'product_weight'=> 'required',
            'product_status'=> 'required',
            'product_categories.name as categories'=> 'required',
            'product_tags'=> 'required',
            'product_discount_rate'=> 'required'
        ]);        

       
        $products->save();

       

        // Here return a String because it is stage 1,
        // we will make it to return a page at stage 2.
        return "Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = DB::table('products')
        ->select(
                'products.id',
                'products.name',
                'products.desc',
                'products.price',
                'products.sprice as sale_price',
                'products.quantity',
                'products.weight',
                'products.status',
                'products_categories.name as categories',
                'products.tags',
                'products.discount_rate',
                'products.created_at'
        )
        ->where('id', $id)
        ->join('products_categories', 'products_categories.id', '=', 'products.categories.id')
        ->get();
        return $product;
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
            'product_id' => 'required',
            'product_name'=> 'required',
            'product_price'=> 'required',
            'product_selling_price'=> 'required',
            'product_quantity' => 'required',
            'product_weight'=> 'required',
            'product_status'=> 'required',
            'product_categories_id' => 'required',
            'product_tags'=> 'required',
            'product_discount_rate'=> 'required'
        ]);                      

        $affectedProducts = DB::table('products')
            ->where([
                ['product_id', '=', $id]
            ])
            ->update([
                'name' => $request->get('product_name'),
                'desc' => $request->get('product_description'),
                'price' => $request->get('product_price'),
                'sprice' => $request->get('product_selling_price'),
                'quantity'=> $request->get('product_quantity'),
                'weight'=> $request->get('product_weight'),
                'status'=> $request->get('product_status'),
                'category_id'=> $request->get('product_categories_id'),
                'tags'=> $request->get('product_tags'),
                'discount_rate'=> $request->get('product_discount_rate')
            ]);       
        
      
            
        return $affectedProducts;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $affectedProducts = DB::table('products')
            ->where([
                ['product_id', '=', $id]
            ])
            ->update([
                'status'=> '1'
            ]);             
        return "Delete";
    }
}
