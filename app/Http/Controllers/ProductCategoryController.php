<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsCategory;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_cate = DB::table('products_categories')
            ->select(
                'products_categories.id',
                'products_categories.name'
                
            )
            ->get();
        $count = 1;
        return view('admin.product_category.listing',['products_cates' => $products_cate, 'count' => $count]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           
        $messages = [
            'category_name.unique' => 'Category name had exist, Use other category name.'
          ];
        
        $products_cate = new ProductsCategory; 
       
        $this->validate($request,[
            'category_name' => 'required|unique:products_categories,name'.$products_cate->name
    
        ],$messages);

       
      
       $products_cate = new ProductsCategory([
            'name' => $request->get('category_name'),
        ]);
       
        $products_cate->save();
        
        return redirect('product_category')->with('success','Done add product category'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products_cate = DB::table('products_categories')
        ->select(
               
                'products_categories.name'
        )
        ->where('id', $id)
        ->get();
        return $products_cate;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProductsCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsCategory $productCategory)
    {
        return view('admin.product_category.edit', compact($productCategory));
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
            
            'category_name'=> 'required'
        ]);                      

        $affectedProductCate = DB::table('products_categories')
            ->where([
                ['id', '=', $id]
            ])
            ->update([
                'name' => $request->get('category_name')
            ]);       
  
        return $affectedProductCate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products_categories')
        ->where("id", $id)
        ->delete();        
          
        return "Delete";
    }
}
