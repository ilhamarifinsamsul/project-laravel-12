<?php

namespace App\Http\Controllers;
// import models category
use App\Models\Category;
// import return type view
use Illuminate\View\View;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // show all categories
    public function index(): View {
        $categories = Category::all();

        // return view
        return view('admin.category.index', ['categories' => $categories]);
    }

    // show create category form
    public function create(): View {
        // return view
        return view('admin.category.create');
    }
}
