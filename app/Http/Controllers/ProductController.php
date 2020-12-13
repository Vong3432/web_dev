<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\ProductsCategory;
use App\Models\ProductsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'products.discount_rate'
            )            
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->get();
        return view('admin.products.listing',  $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products_cate = DB::table('products_categories')
            ->select(
                'products_categories.id',
                'products_categories.name'
                
            )
            ->get();
       
        return view('admin.products.create',['products_cates' => $products_cate]);
       
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
            'product_name'=> 'required',
            'product_desc'=> 'required',
            'product_price'=> 'required',
            'product_quantity' => 'required',
            'product_weight'=> 'required',
            'category_id'=> 'required',
            'product_tags'=> 'required',
            'product_discount_rate'=> 'required',
            'images'=> 'required'
        ]);        

         $sale_price = $request->get('product_price') * ($request->get('product_discount_rate'))/100;
          
         $product = new Products([
            'name' => $request->get('product_name'),
            'desc' => $request->get('product_desc'),
            'price' => $request->get('product_price'),
            'sprice' => $sale_price,
            'quantity' => $request->get('product_quantity'),
            'weight' => $request->get('product_weight'),
            'status' => '0',
            'category_id'=> $request->get('category_id'),
            'tags'=> $request->get('product_tags'),
            'discount_rate'=> $request->get('product_discount_rate'),
            
        ]);

       
        // Save to order table
        $product->save();

        
        
        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('products_images/',$name);
                $images[]=$name;
            }
        }
     

        $productImg =  ProductsImages::insert( [
            'name'=>  implode("|",$images),
            'product_id'=> $product->id
          
        ]);
       

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
        ->where('status', '0')
        ->join('products_categories', 'products_categories.id', '=', 'products.categories.id')
        ->get();


        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Products $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('admin.products.edit', compact($product));
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
            'product_name'=> 'required',
            'product_desc'=> 'required',
            'product_price'=> 'required',
            'product_selling_price'=> 'required',
            'product_quantity' => 'required',
            'product_weight'=> 'required',
            'category_id'=> 'required',
            'product_tags'=> 'required',
            'product_discount_rate'=> 'required',
            'images'=> 'required'
        ]);                          

        $affectedProducts = DB::table('products')
            ->where([
                ['id', '=', $id]
            ])
            ->update([
                'name' => $request->get('product_name'),
                'desc' => $request->get('product_desc'),
                'price' => $request->get('product_price'),
                'sprice' => $request->get('product_selling_price'),
                'quantity'=> $request->get('product_quantity'),
                'weight'=> $request->get('product_weight'),
                'status'=> '0',
                'category_id'=> $request->get('category_id'),
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
                ['id', '=', $id]
            ])
            ->update([
                'status'=> '1'
            ]);             
        return "Delete";
    }
}
