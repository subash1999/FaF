<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_id' => 'required|exists:App\Models\Product,id',
        ]);
        if (isset($request->image)) {
            $img_name = Str::uuid() . "_" . $request->image->getClientOriginalName();
            $request->image->move(public_path('product_images'), $img_name);
            $pi = new ProductImage();
            $pi->image = $img_name;
            $pi->product_id = $request->product_id;
            $pi->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pi = ProductImage::findOrFail($id);
        $pi->delete();
        return redirect()->back();
    }
}
