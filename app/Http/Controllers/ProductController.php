<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data from database
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // post data to database

        $this->validate($request,[
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);
        $product = new Product();
        
        // image date
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedFileExtension = ['pdf', 'png', 'jpg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            }
        }

        // text data
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();
        return response()->json($product);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
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
        // update by use id
        $this->validate($request,[
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);
        $product = Product::find($id);

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedFileExtension = ['pdf', 'png', 'jpg', 'JPG'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if($check){
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            }
        }

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        
        $product->save();
        return response()->json($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete by use id
        $product = Product::find($id);
        $product->delete();
        return response()->json("Product deleted successfully");
    
    }
}
