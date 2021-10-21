<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $products = Product::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);
        $imageName = NULL;
        if ($request->image) {
            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }
        Product::create([
            'name' => $request->name,
            'image' => ($imageName) ? "images/$imageName" : NULL
        ]);
        return redirect()->route('products.index')->with('success', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Product $product
     *
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Product $product
     *
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  App\Models\Product $product
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);
        $imageName = NULL;
        if ($request->image) {
            $imageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            if (file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }
        }
        $product->update([
            'name' => $request->name,
            'image' => ($imageName) ? "images/$imageName" : $product->image
        ]);
        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Product $product
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product)
    {
        if (file_exists(public_path($product->image))) {
            @unlink(public_path($product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
