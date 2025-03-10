<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        return view('categories.index', [
            'categories' => Category::filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories,name',
            'description' => 'required|unique:categories,description|alpha_dash',
        ];

        $validatedData = $request->validate($rules);

        Category::create($validatedData);

        return Redirect::route('categories.index')->with('success', 'Category has been created!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|unique:categories,name,'.$category->id,
            'description' => 'required|alpha_dash|unique:categories,description,'.$category->id,
        ];

        $validatedData = $request->validate($rules);

        // Update the category using the validated data
        $category->update($validatedData);

        return Redirect::route('categories.index')->with('success', 'Category has been updated!');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category has been deleted!');
    }
}
