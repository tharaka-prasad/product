<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\categories\categoriesController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all products with their categories
        $products = Product::with('category')->get();

        // Pass the products data to the Inertia view
        return Inertia::render('products/All/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return Inertia::render('products/Create/Index',
        ['categories'=>$categories]
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }



        // Create the product
        Product::create($validated);

        // Redirect back to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        // $product = Product::all();


        return Inertia::render('products/Show/Index', [
            'product' => $product,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();

        return Inertia::render('products/Edit/Index', [
            'product' => $product,
            'categories' =>$categories


        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $product = Product::findOrFail($id);

            $product->update($request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'status' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
            ]));

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the category and delete it
        $products = Product::findOrFail($id);
        $products->delete();

        // Redirect to the categories index page
        return redirect()->route('products.index')->with('success', 'product deleted successfully.');
    }


}
