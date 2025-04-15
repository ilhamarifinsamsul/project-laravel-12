<?php

namespace App\Http\Controllers;

// import models products
use App\Models\Products;
// import models category
use App\Models\Category;

// import return type view
use Illuminate\View\View;
// import return type redirect
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(): View
    {
        // get all products & search
        $search = request()->query('search');

        // 
        $products = Products::with('category') // Eager load relationship
        ->when($search, function($query) use ($search) {
            $query->where(function($q) use ($search) {
                $q->where('products.title', 'like', '%' . $search . '%')
                ->orWhereHas('category', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            });
        })
        ->latest()
        ->paginate(5)
        ->appends(['search' => $search]);

        // return view
        return view('admin.products.index', compact('products', 'search'));

    }

    /**
     * create
     * 
     * @return view
     */

    public function create(): View
    {
        // get all categories
        $categories = Category::all();

        // return view
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) : RedirectResponse 
    {
        // validation form
        $request->validate([
            'category_id' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        // create product
        Products::create([
            'category_id' => $request->category_id,
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        // redirect to index
        return redirect()->route('products.index')->with('success', 'Products created successfully');
    }

    public function show (string $id) : View 
    {
        // get product by id
        $product = Products::findOrFail($id);

        // return view
        return view('admin.products.show', compact('product'));
    }

    public function edit(string $id) : View
    {
        $product =  Products::findOrFail($id);
        $category = Category::all();

        return view('admin.products.edit', compact('product', 'category'));
    }

    /**
     * 
     * update
     * @param mixed $request
     * @param mixed $id
     * @return RedirectResponse
     */

    public function update(Request $request, $id) : RedirectResponse
    {
        // validate form
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);
        
        // get pruduct by id
        $product = Products::findOrFail($id);

        // check image is uploaded
        if ($request->hasFile('image')) {
            // delete old image
            Storage::delete('products/' . $product->image);

            // upload new image
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName());

            // update product with new image
            $product->update([
                'category_id' => $request->category_id,
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);
        } else {
            // update product without image
            $product->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            ]);
        }

        // redirect to index
        return redirect()->route('products.index')->with('success', 'Products updated successfully');
    }

    public function destroy($id) : RedirectResponse
    {
        // get product by id
        $product = Products::findOrFail($id);

        // delete image
        Storage::delete('products/' . $product->image);

        // delete product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Products deleted successfully');
    }


}
