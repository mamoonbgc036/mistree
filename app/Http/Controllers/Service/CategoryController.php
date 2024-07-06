<?php

namespace App\Http\Controllers\Service;

use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $all_categories = ServiceCategory::all();
        return view('category.index', compact('all_categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category_create_info = $request->all();
        if ($request->hasFile('image')) {
            $admin_image_path = $request->file('image')->store('category', 'public');
            $category_create_info['image'] = $admin_image_path;
        }
        ServiceCategory::create($category_create_info);
        return redirect()->route('category')->with('success', 'Category created successfully');
    }

    public function destroy($id)
    {
        $category_for_delete = ServiceCategory::findOrFail($id);
        $category_for_delete->delete();
        return response()->json(['success' => 'Category deleted successfully']);
    }

    public function edit($service_category)
    {
        $category_update_info = ServiceCategory::findOrFail($service_category);
        return view('category.edit', compact('category_update_info'));
    }

    public function update(CategoryStoreRequest $request, $id)
    {
        $category_for_update = ServiceCategory::findOrFail($id);
        $updated_data = $request->all();
        if ($request->hasFile('image')) {
            $updated_data['image'] = $request->file('image')->store('category', 'public');
        }
        $category_for_update->update($updated_data);
        return redirect()->route('category')->with('success', 'Category updated');
    }
}
