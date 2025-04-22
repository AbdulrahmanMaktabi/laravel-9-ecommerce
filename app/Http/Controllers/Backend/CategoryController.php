<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Facades\Media;
use App\Facades\Loggy;
use Exception;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($name = $request->query('name')) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($status = $request->query('status')) {
            $query->whereStatus($status);
        }

        $categories = $query->select('id', 'name', 'status', 'image', 'parent_id', 'slug')
            ->with(['parent', 'children'])
            ->paginate(10);

        if (!$categories) {
            Loggy::error('Can`t load categories');
            return redirect()->back()->while('error', 'can`t load categories');
        }

        return view('dashboard.sections.categories.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name', 'status', 'image', 'parent_id', 'slug')
            ->with(['parent', 'children'])
            ->get();

        if (!$categories) {
            Loggy::error('Can`t load categories');
        }

        return view('dashboard.sections.categories.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image'     => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif'],
            'status'    => ['required'],
            'description' => ['required']
        ]);

        $imageLocation = Media::uploadImage($request, 'image', 'uploads\categories', 'categories');

        Category::create([
            'name'      => $request->input('name'),
            'slug'      => Str::slug($request->name),
            'image'     => $imageLocation,
            'status'    => $request->input('status'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::select('id', 'name', 'status', 'image', 'parent_id', 'slug')
            ->with(['parent', 'children'])
            ->where('id', '<>', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })
            ->get();


        return view('dashboard.sections.categories.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => ['required'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image'     => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'status'    => ['required'],
            'description' => ['required']
        ]);

        if ($request->has('image')) {
            $imageLocation = Media::updateImage($request, 'image', $category->image, 'uploads\categories', 'categories');
            $category->update(['image' => $imageLocation]);
        }

        $category->update([
            'name'      => $request->input('name'),
            'slug'      => Str::slug($request->name),
            'status'    => $request->input('status'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (Exception $e) {
            Loggy::error('Category deletion failed:' . $e->getMessage());
            return redirect()->back();
        }

        if ($category->image) {
            Media::deleteImage($category->image);
        }

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully');
    }

    /**
     * Update Status of category to archived
     */
    public function updateStatusToArchived(Category $category)
    {
        $category->update(['status' => 'archived']);
        return redirect()->route('categories.index')->with('success', 'Category Status Updated Successfully');
    }
}
