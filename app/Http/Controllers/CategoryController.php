<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // index
    public function index() {
        $categories = \App\Models\Category::paginate(5);
        return view('pages.category.index', compact('categories'));
    }

    // create
    public function create() {
        return view('pages.dashboard');
    }

    // store
    public function store(Request $request) {
        return view('pages.dashboard');
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
