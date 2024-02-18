<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // index
    public function index(Request $request) {
    // Search
    $query = Product::query();

    if ($request->has('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    // Eager load the 'category' relationship
    $products = $query->with('category')->paginate(5);

    // Fetch categories regardless of the search
    $categories = \App\Models\Category::all();

    return view('pages.product.index', compact('products', 'categories'));
    }

    // create
    public function create(){
        $categories = \App\Models\Category::all();
        return view('pages.product.create', compact( 'categories'));
    }

    // store
    public function store(Request $request){
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        // $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product successfully created'); // Redirect user to products list after creation
    }

    // show
    public function show($id) {
        return  view('pages.dashboard');
    }

    // edit
    public function edit($id) {
        $user  = Product::findOrFail($id);
        $categories = Category::all(); // Menambahkan baris ini untuk mendapatkan semua kategori
        return view('pages.product.edit', compact('user', 'categories'));
    }

    // update
    public function update(Request $request, $id) {
        $data = $request->all();
        $user  = Product::findOrFail($id);
        $user ->update($data);
        return redirect()->route('product.index');
    }

    // destroy
    public function destroy($id) {
        $user = Product::findOrFail($id);
        $user->delete();
        return redirect()->route('product.index');
    }

}
