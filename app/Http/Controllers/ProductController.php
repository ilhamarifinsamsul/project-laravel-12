<?php

namespace App\Http\Controllers;

// import models products
use App\Models\Products;
// import models category
use App\Models\Category;
use App\Models\User;
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

        $products = Products::when($search, function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->latest()->paginate(5)->appends(['search' => $search]);

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
}
