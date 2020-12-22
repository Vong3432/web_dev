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
                'products.sprice',
                'products.quantity',
                'products.weight',
                'products.status',
                'products_categories.name as categories',
                'products_images.name as images',
                'products.tags',
                'products.discount_rate'
            )
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->join('products_images', 'products_images.product_id', '=', 'products.id')
            ->get();
      

        return view('admin.products.listing',['products' => $products]);        
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

        return view('admin.products.create', ['products_cates' => $products_cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo dd($request);
        
        $messages = [
            'product_name.require' => 'Product name is require.',
            'product_desc.require' => 'Product description is require.',
            'product_price.require' => 'Product price is require.',
            'product_quantity.require' => 'Product quantity is require.',
            'product_weight.require' => 'Product weight is require.',
            'product_category.require' => 'Category id is require.',
            'product_tags.require' => 'Product tags is require.',
            'product_discount_rate.require' => 'Product discount rate is require.',

          ];
        
        $products = new Products; 
      
        $sale_price = $request->get('product_price') - ($request->get('product_price') * ($request->get('product_discount_rate')) / 100);

        $product = new Products([
            'name' => $request->get('product_name'),
            'desc' => $request->get('product_desc'),
            'price' => $request->get('product_price'),
            'sprice' => $sale_price,
            'quantity' => $request->get('product_quantity'),
            'weight' => $request->get('product_weight'),
            'status' => '0',
            'discount_rate' => $request->get('product_discount_rate'),
            'category_id' => $request->get('product_category'),
            'tags' => $request->get('product_tags'),
            

        ]);


        // Save to order table
        $product->save();



        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('products_images/', $product->id.$name);
                $images[] = $product->id.$name;
            }
        }


        $productImg =  ProductsImages::insert([
            'name' =>  implode("|", $images),
            'product_id' => $product->id

        ]);


        // Here return a String because it is stage 1,
        // we will make it to return a page at stage 2.
        return redirect('products')->with('success','Done add product'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')
        ->select(
            'products.id',
            'products.name',
            'products.desc',
            'products.price',
            'products.sprice',
            'products.quantity',
            'products.weight',
            'products.status',
            'products_categories.name as categories',
            'products_images.name as images',
            'products.tags',
            'products.discount_rate'
        )
        ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
        ->join('products_images', 'products_images.product_id', '=', 'products.id')
        ->where('products.id', $id)
        ->first();

        $products_cate = DB::table('products_categories')
        ->select(
            'products_categories.id',
            'products_categories.name'

        )
        ->get();


        return view('admin.products.edit',['product' => $product, 'products_cates' => $products_cate]);        
    
        //return $product;
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
       
        $messages = [
            'product_name.require' => 'Product name is require.',
            'product_desc.require' => 'Product description is require.',
            'product_price.require' => 'Product price is require.',
            'product_quantity.require' => 'Product quantity is require.',
            'product_weight.require' => 'Product weight is require.',
            'product_category.require' => 'Category id is require.',
            'product_tags.require' => 'Product tags is require.',
            'product_discount_rate.require' => 'Product discount rate is require.',

          ];
        
        $products = new Products; 
      
        $sale_price = $request->get('product_price') - ($request->get('product_price') * ($request->get('product_discount_rate')) / 100);
        

        $affectedProducts = DB::table('products')
            ->where([
                ['id', '=', $id]
            ])
            ->update([
                'name' => $request->get('product_name'),
                'desc' => $request->get('product_desc'),
                'price' => $request->get('product_price'),
                'sprice' => $sale_price,
                'quantity' => $request->get('product_quantity'),
                'weight' => $request->get('product_weight'),
                'category_id' => $request->get('product_category'),
                'tags' => $request->get('product_tags'),
                'discount_rate' => $request->get('product_discount_rate')
            ]);

        



            return redirect('products/edit/'.$id)->with('success','Done edit product'); 
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
                'status' => '-1'
            ]);
        return "Delete";
    }

    public function status(Request $request, $id)
    {
        // Update order status
        if($request->get('status')) {

            try {
                Products::where('id', $id)
                ->update(['status' => $request->get('status')]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Update status successfully'
                ], 200);
            } catch(Throwable $err) {
                return "1232";
                return response()->json([
                    'success' => false,
                    'message' => 'Update status failed.'
                ], 422);
            }            
        }  
    }

    

    public function getAllProducts(Request $request)
    {        

        $priceFilters = array();

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
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id');

        // Filter category
        if($request->category) {
            $products = $products->where('products.category_id', $request->category);
        }

        // Filter price 
        if($request->price) {

            $lowestPrice = 0;
            $highestPrice = 0;                        

            foreach($request->price as $price)
            {
                // Save checked price range to array
                array_push($priceFilters, $price);

                $priceToArray = explode('-', $price);                

                $currentLowest = $priceToArray[0];
                $currentHighest = $priceToArray[1];

                if($lowestPrice === 0) $lowestPrice = $currentLowest;  
                else $currentLowest < $lowestPrice ? $lowestPrice = $currentLowest : null;

                if($highestPrice === 0) $highestPrice = $currentHighest;
                else $currentHighest > $highestPrice ? $highestPrice = $currentHighest : null;

            }            
                        
            $products = $products->whereBetween('products.price', [$lowestPrice, $highestPrice])->orWhereBetween('products.sprice', [$lowestPrice, $highestPrice]);                                    
        }            

        // Filter tags 
        if($request->tags) {
            $products = $products->whereIn('products.tags', [$request->tags]);
        }

        $products = $products->where('status', '1')->get();                

        $latestProducts = DB::table('products')
            ->select(
                'products.id',
                'products.name',                
                'products.price',
                'products.sprice as sale_price',                
                'products_categories.name as categories',
                'products.tags',
                'products.discount_rate',
                'products.created_at'
            )
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->where('status', '0')
            ->orderByDesc('products.created_at')
            ->limit(5)
            ->get();

        $productCategories = DB::table('products_categories')->select()->get();        

        return view('shop-grid',  [
            'products' => $products,
            'productcategories' => $productCategories,
            'latestproducts' => $latestProducts,
            'pricefilters' => $priceFilters
        ]);
    }

    public function getSingleProduct($id)
    {
        $product = DB::table('products')
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
                'products.created_at',
                'products.category_id'
            )
            ->where('products.id', $id)
            ->where('status', '0')
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->first();

        $similarProducts = DB::table('products')
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
            ->where('products.category_id', $product->category_id)
            ->where('products.id', '!=', $product->id)
            ->where('status', '0')
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->limit(5)
            ->get();

        return view(
            'shop-detail',
            [
                'product' => $product,
                'similarproducts' => $similarProducts,                
            ]
        );
    }
}
