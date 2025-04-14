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
        return redirect()->route('products.index')->with('success', 'Category created successfully');
    }
}
