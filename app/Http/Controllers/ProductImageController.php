<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_imgs = DB::table('products_images')
            ->select(
                'products_images.id',
                'products_images.name as images_link'   
            )
            ->get();
        return $products_imgs;
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
        /*$request->validate([
            'product_id' => 'required',
            'images' => 'required',
        ]);  
        
        $productImg = new ProductsImages();
        $image = array();
        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $destinationPath = 'products_images/';
                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                
                $image = new ProductsImages([
                    'product_id' => $request->get('product_id'),
                    'name' => $filename,
                ]);
                
            }
            
        }
        $productImg->productImgs()->createMany($image); 

        */

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
        

        if($request->get('status')) {

            try {
                ProductsImages::where('id', $id)
                ->update(['name' => $request->get('status')]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Update status successfully'
                ], 200);
            } catch(Throwable $err) {
                return response()->json([
                    'success' => false,
                    'message' => 'Update status failed.'
                ], 422);
            }            
        }   
        
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

   
        // Update order status
        if($request->get('name')) {

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products_images')
        ->where("id", $id)
        ->delete();        
          
        return "Delete";
    }
}
