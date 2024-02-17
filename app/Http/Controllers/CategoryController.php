<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // index
    public function index(Request $request) {
        // Get users with pagination
        // $categories = \App\Models\Category::paginate(5);

        $categories = DB::table('categories')
        -> when($request -> input('name'),function ($query, $name){
            return $query-> where('name', 'like', '%' . $name. '%');
        }) -> paginate(5);


        return view('pages.category.index', compact('categories'));
    }

    // create
    public function create() {
        return view('pages.category.create');
    }

    // store
    public function store(Request $request) {
        $data = $request->all();
        // $data['password'] = Hash::make($request->input('password'));
        Category::create($data);
        return redirect()->route('category.index');
    }

    // show
    public function show($id) {
        return view('pages.dashboard');
    }

    // edit
    public function edit($id) {
        return view('pages.dashboard');
    }

    // update
    public function update(Request $request, $id) {
        return view('pages.dashboard');
    }


    // destroy
    public function destroy($id) {
        return view('pages.dashboard');
    }
}
