<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Facades\Media;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct()
    {
        $this->categories = Category::select('id', 'name', 'status', 'image', 'parent_id', 'slug')
            ->with(['parent', 'children'])
            ->paginate(10);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories;

        return view('dashboard.pages.categories.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories;
        return view('dashboard.pages.categories.create', get_defined_vars());
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
            'image'     => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = $this->categories;
        return view('dashboard.pages.categories.edit', get_defined_vars());
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
        if ($category->image) {
            Media::deleteImage($category->image);
        }

        $category->delete();

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
