<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \App\Models\Product::all();
        return view('admin.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-products');
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
            'name'=>'required|min:3',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'quantity_available' => 'required|numeric',
            'quantity_sold' => 'nullable|numeric',
            'product_category' => 'nullable|exists:App\Models\ProductCategory,id',
            'description'=> 'nullable',
        ]);
        $product = new \App\Models\Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity_available = $request->quantity_available;
        $product->quantity_sold = $request->quantity_sold;
        $product->product_category_id = $request->product_category;
        $product->description = $request->description;
        $product->save();

        if(isset($request->image1)){
            $img_name =  Str::uuid()."_".$request->image1->getClientOriginalName();
            $request->image1->move(public_path('product_images'), $img_name);
            $pi = new ProductImage();
            $pi->image = $img_name;
            $pi->product_id = $product->id;
            $pi->save();
        }
        if(isset($request->image2)){
            $img_name =  Str::uuid()."_".$request->image2->getClientOriginalName();
            $request->image2->move(public_path('product_images'), $img_name);
            $pi = new ProductImage();
            $pi->image = $img_name;
            $pi->product_id = $product->id;
            $pi->save();
        }
        if(isset($request->image3)){
            $img_name =  Str::uuid()."_".$request->image3->getClientOriginalName();
            $request->image3->move(public_path('product_images'), $img_name);
            $pi = new ProductImage();
            $pi->image = $img_name;
            $pi->product_id = $product->id;
            $pi->save();
        }
        if(isset($request->image4)){
            $img_name =  Str::uuid()."_".$request->image4->getClientOriginalName();
            $request->image4->move(public_path('product_images'), $img_name);
            $pi = new ProductImage();
            $pi->image = $img_name;
            $pi->product_id = $product->id;
            $pi->save();
        }
        if(isset($request->image5)){
            $img_name =  Str::uuid()."_".$request->image5->getClientOriginalName();
            $request->image5->move(public_path('product_images'), $img_name);
            $pi = new ProductImage();
            $pi->image = $img_name;
            $pi->product_id = $product->id;
            $pi->save();
        }

        return redirect()->route('admin.products.show',$product->id);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.show-products',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.edit-products',compact('product'));
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
            'name'=>'required|min:3',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'quantity_available' => 'required|numeric',
            'quantity_sold' => 'nullable|numeric',
            'product_category' => 'nullable|exists:App\Models\ProductCategory,id',
            'description'=> 'nullable',
        ]);
        $product =\App\Models\Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity_available = $request->quantity_available;
        $product->quantity_sold = $request->quantity_sold;
        $product->product_category_id = $request->product_category;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('admin.products.show',$product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =\App\Models\Product::findOrFail($id);
        foreach($product->ProductImages as $product_image){
            $file =public_path('product_images/'.$product_image->image);
            File::delete($file);
            $product_image->delete();
        }
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
