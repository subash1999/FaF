<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pcs = ProductCategory::all();
        return view('admin.product-categories',compact('pcs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-product-categories');
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
           'name' => 'required',
            'description' => 'nullable',
        ]);
        $pc = new \App\Models\ProductCategory();
        $pc->name = $request->name;
        $pc->description = $request->description;
        $pc->save();
        return redirect()->route('admin.product-categories.show',[$pc->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pc = ProductCategory::findOrFail($id);
        return view('admin.show-product-categories',compact('pc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pc = ProductCategory::findOrFail($id);
        return view('admin.edit-product-categories',compact('pc'));
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
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $pc = \App\Models\ProductCategory::findOrFail($id);
        $pc->name = $request->name;
        $pc->description = $request->description;
        $pc->save();
        return redirect()->route('admin.product-categories.show',[$pc->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pc = \App\Models\ProductCategory::findOrFail($id);
        foreach($pc->Products as $product){
            $product->product_category_id = null;
            $product->save();
        }
        $pc->delete();
        return redirect()->route('admin.product-categories.index');
    }
}
