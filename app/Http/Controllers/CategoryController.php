<?php

namespace App\Http\Controllers;
// import models category
use App\Models\Category;
// import return type view
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller
{
    // show all categories
    public function index(Request $request): View {
        

        // get all categories
        $search = request()->query('search');

        $categories = Category::when($search, function($query) use ($search) {
            $query->where('name', 'like', '%' .$search. '%');
        })->latest()->paginate(5)->appends(['search' => $search]);
        
        // return view
        return view('admin.category.index', compact('search', 'categories'));
    }

    // show create category form
    public function create(): View {
        // return view
        return view('admin.category.create');
    }

    // store category
    public function store(Request $request) : RedirectResponse{
        // validate request
        $request->validate([
            'name' => 'required|string'
        ]);

        // create category
        Category::create([
            'name' => $request->name
        ]);

        // redirect to index
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    // show edit category form
    public function edit(string $id): View {

        $categories = Category::find($id);
        // return view
        return view('admin.category.edit', compact('categories'));
    }

    // update category
    public function update(Request $request, string $id): RedirectResponse {
        // Get category
        $categories = Category::findOrFail($id);

        // validate request
        $request->validate([
            'name' => 'required|string'
        ]);

        // update category
        $categories->update([
            'name' => $request->name
        ]);

        // return redirect
        return redirect()->route('category.index')->with('success', 'Category updateded successfully');
    }

    // delete category
    public function destroy(string $id): RedirectResponse {
        // get category
        $categories = Category::findOrFail($id);

        // delete category
        $categories->delete();

        // return redirect
        return redirect()->route('category.index')->with('success', 'Category delete successfuly');
    }
}
