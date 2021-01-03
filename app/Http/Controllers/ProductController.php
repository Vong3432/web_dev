<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Products;
use App\Models\ProductsCategory;
use App\Models\ProductsImages;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.products.listing', ['products' => $products]);
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
            'status' => '1',
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
                $file->move('products_images/', $product->id . $name);
                $images[] = $product->id . $name;
            }
        }


        $productImg =  ProductsImages::insert([
            'name' =>  implode("|", $images),
            'product_id' => $product->id

        ]);


        // Here return a String because it is stage 1,
        // we will make it to return a page at stage 2.
        return redirect('products')->with('success', 'Done add product');
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


        return view('admin.products.edit', ['product' => $product, 'products_cates' => $products_cate]);

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


            $images = array();
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('products_images/', $id . $name);
                    $images[] = $id . $name;
                }
            }
          

            $products_img = DB::table('products_images')
            ->select(
                'name'
            )
            ->where('product_id', $id)
            ->get()
            ->first();
            if($images!=null){
                 $newImg = $products_img->name ."|". implode("|", $images);
            }else{
                $newImg = $products_img->name;
            }


            $affectedProductsImg = DB::table('products_images')
            ->where([
                ['product_id', '=', $id]
            ])
            ->update([
                'name' => $newImg
            ]);



        return redirect('products/edit/' . $id)->with('success', 'Done edit product');
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
        if ($request->get('status')) {

            try {
                Products::where('id', $id)
                    ->update(['status' => $request->get('status')]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update status successfully'
                ], 200);
            } catch (Throwable $err) {
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
                'products.discount_rate',
                'products_images.name as images'
            )
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->join('products_images', 'products_images.product_id', '=', 'products.id');

        // Filter category
        if ($request->category) {
            $products = $products->where('products.category_id', $request->category);
        }

        // Filter price 
        if ($request->price) {

            $lowestPrice = 0;
            $highestPrice = 0;

            foreach ($request->price as $price) {
                // Save checked price range to array
                array_push($priceFilters, $price);

                $priceToArray = explode('-', $price);

                $currentLowest = $priceToArray[0];
                $currentHighest = $priceToArray[1];

                if ($lowestPrice === 0) $lowestPrice = $currentLowest;
                else $currentLowest < $lowestPrice ? $lowestPrice = $currentLowest : null;

                if ($highestPrice === 0) $highestPrice = $currentHighest;
                else $currentHighest > $highestPrice ? $highestPrice = $currentHighest : null;
            }

            $products = $products->whereBetween('products.price', [$lowestPrice, $highestPrice])->orWhereBetween('products.sprice', [$lowestPrice, $highestPrice]);
        }

        // Filter tags 
        if ($request->tags) {
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
                'products.created_at',
                'products_images.name as images'
            )
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->join('products_images', 'products_images.product_id', '=', 'products.id')
            ->where('status', '1')
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
                'products.category_id',
                'products_images.name as images'
            )
            ->where('products.id', $id)
            ->where('status', '1')
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->join('products_images', 'products_images.product_id', '=', 'products.id')
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
                'products.created_at',
                'products_images.name as images'
            )
            ->where('products.category_id', $product->category_id)
            ->where('products.id', '!=', $product->id)
            ->where('status', '1')
            ->join('products_categories', 'products_categories.id', '=', 'products.category_id')
            ->join('products_images', 'products_images.product_id', '=', 'products.id')
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

    public function addToCart(Request $request, $id)
    {
        // $product = Products::find($id);        
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

        $user = Auth::user();                                  

        if ($product->quantity > 0 ) {

            if(\Cart::isEmpty() === false) {

                if($currProductInCart = \Cart::get($product->id)) {                          
                    if($product->quantity === $currProductInCart->quantity)
                        return redirect('cart')->with('flashMessage', $product->name . "'s stocks current is " . $product->quantity . " and you have " . $currProductInCart->quantity . "");            
                }                                 
            }

            $price = 0;

            if ($product->sprice)
                $price = $product->sprice;
            else
                $price = $product->price;

            // add the product to cart
            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' => 1,
                'attributes' => array(
                    'images' => $product->images
                ),
                'associatedModel' => $product
            ));

            return back();            

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Added to cart successfully',
            //     'cart' => session('cart')
            // ], 200);
        } 
    }

    // public function checkout($id, Request $request)
    public function checkout(Request $request)
    {        
        // $post = Post::find($id);
        // $product = Products::findOrFail($id);
        
        // $total_price = 100;
        $total = \Cart::getTotal();  
        $discount = 0;

        $voucher = false;

        if(isset($request->voucher))
        // if($request->get('coupon_code'))
        {
            $voucher = Auth::user();
            try{
                $voucher = auth()->user()->redeemCode($request->voucher);
                // $voucher = Auth::user();
                // ->redeemCode($request->voucher);
                $discount = $voucher->data->get('discount_percent');
                $total = round($total * (1-$discount/100), 2);
            } catch (\Exception $ex) {
                session()->flash('error', $ex->getMessage());
            }
        }
        
        // return view('admin.products.checkout', compact('total_price', 'voucher')); 
        return view('checkout', compact('total', 'discount', 'voucher')); 
    }
    /* $discount = 10;
    
    $voucher = auth()->user()->redeemCode($request->voucher);
    $discount = $voucher->data->get('discount_percent');
    $total = round($total * (1-$discount/100), 2); */
    /* $total = \Cart::getTotal();  
    $discount = 0;

    if($request->get('coupon_code'))
    {
        $discount = $this->validCoupon($request->get('coupon_code'));                            
        $total = $total - $discount;
    }                    

    return view('checkout', [
        'total' => $total,
        'discount' => $discount
    ]); */
    
    public function checkout2(Request $request)
    {        
        $total = \Cart::getTotal();  
        $discount = 0;

        if($request->get('coupon_code'))
        {
            $discount = $this->validCoupon($request->get('coupon_code'));                            
            $total = $total - $discount;
        }                    

        return view('checkout', [
            'total' => $total,
            'discount' => $discount
        ]);
    }

    public function cart(Request $request)
    {
        // $userId = Auth::user()->id; // or any string represents user identifier

        $cart = \Cart::getContent();
        $total = \Cart::getTotal();  
        $discount = 0;

        if($request->get('coupon_code'))
        {
            $discount = $this->validCoupon($request->get('coupon_code'));                            
            $total = $total - $discount;
        }                    

        return view('cart', [
            'cart' => $cart,
            'total' => $total,
            'discount' => $discount
        ]);
    }

    public function removeItemFromCart(Request $request, $id)
    {
        // $userId = Auth::user()->id; 

        $item = \Cart::get($id);

        if ($item->quantity > 1) {
            \Cart::update($id, array(
                'quantity' => -1
            ));
        } else {
            \Cart::remove($id);
        }

        return back();
    }

    public function removeThisItemFromCart(Request $request, $id)
    {
        \Cart::remove($id);
        return back();
    }

    public function clearCart()
    {
        // $userId = Auth::user()->id; 

        \Cart::clear();
        // \Cart::session($userId)->clear();

        return back()->with('success', 'Cart is cleared.');
    }

    public function validCoupon(String $code) 
    {        
        $coupon = Coupon::where('code', $code)->first();

        return $coupon ? $coupon->value : 0;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addVoucher($id)
    // public function show1(Post $post)
    {
        $product = Products::findOrFail($id);
        // $post = Post::find($id);

        $voucher = $product->createVoucher(['discount_percent' => '10']);

        return view('admin.products.addVoucher', compact('voucher','product'));
    }
}
