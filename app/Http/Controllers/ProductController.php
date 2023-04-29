<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products.products', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create([
            // 'product_id' => $request-> id,
            'product_name' => $request-> product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);

        return redirect()->back()->with(['Add' => 'تم إضافه المنتج بنجاح ']);

        // return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {


        // $id = Section::where('section_name', $request -> section_name)->first()->id;

        // $pro_id = $request -> product_id;
        // $product = Product::find($pro_id);

        // $product -> update([
        //     'product_name' => $request -> product_name,
        //     'description' => $request -> description,
        //     'section_id' => $id,
        // ]);

        // return redirect()->back()->with(['Add' => 'تم تعديل المنتج بنجاح ']);

        // return "welcome";
        // $id = $request -> product_name;
        // $pro = Product::findOrFail($request -> product_name);
        // return $pro;
        // $all = Product::find($request -> product_name);
        // return $all;

        // $id = Section::where('section_name', $request->section_name)->first()->id;

        // $products = Product::findOrFail($request->product_id);

        // $products->update([
        //     'Product_name' => $request->product_name,
        //     'description' => $request->description,
        //     'section_id' => $id,
        // ]);

        // $id = Product::find($request -> id);
        // $id = $request -> id;

        // return Product::find($id);
        // return Product::find();
        // return $request -> pro_id;

        $section_id = Section::where(
            'section_name', $request -> section_name
        )
        -> first()
        -> id;

        $product = Product::findOrFail($request -> pro_id);

        $product -> update([
            'product_name' => $request-> product_name,
            'description' => $request->description,
            'section_id' => $section_id,

        ]);

        return redirect()->back()->with(['Add' => 'تم تعديل المنتج بنجاح ']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request -> pro_id;

        Product::findOrFail($id)
        -> delete();

        return redirect() -> back() -> with(['Add' => 'تم حذف المنتج بنجاح']);

        // return $request;
    }
}
