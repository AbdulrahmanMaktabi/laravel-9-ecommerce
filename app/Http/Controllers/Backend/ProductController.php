<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Facades\Loggy;
use App\Facades\Media;
use Exception;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::Filter($request->query())
            ->with(['store', 'category'])
            ->paginate(10);

        if (!$products) {
            Loggy::error('Can`t load products');
            return redirect()->back()->while('error', 'can`t load products');
        }

        return view('dashboard.sections.products.index', get_defined_vars());
    }

    /**
     * Display a listing of the resource only trashed
     * 
     * @return void
     */
    public function trash(Request $request)
    {
        $products = Product::Filter($request->query())
            ->onlyTrashed()
            ->with(['store', 'category'])
            ->paginate(10);

        if (!$products) {
            Loggy::error('Can`t load products');
            return redirect()->back()->while('error', 'can`t load products');
        }

        return view('dashboard.sections.products.trashed', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with(['store', 'category'])
            ->get();

        if (!$products) {
            Loggy::error('Can`t load products');
        }

        return view('dashboard.sections.products.create', get_defined_vars());
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
            'parent_id' => ['nullable', 'exists:products,id'],
            'image'     => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif'],
            'status'    => ['required'],
            'description' => ['required']
        ]);

        $imageLocation = Media::uploadImage($request, 'image', 'uploads\products', 'products');

        Product::create([
            'name'      => $request->input('name'),
            'slug'      => Str::slug($request->name),
            'image'     => $imageLocation,
            'status'    => $request->input('status'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $category)
    {
        $products = Product::select('id', 'name', 'status', 'image', 'parent_id', 'slug')
            ->with(['parent', 'children'])
            ->where('id', '<>', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })
            ->get();


        return view('dashboard.sections.products.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $category)
    {
        $request->validate([
            'name'      => ['required'],
            'parent_id' => ['nullable', 'exists:products,id'],
            'image'     => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'status'    => ['required'],
            'description' => ['required']
        ]);

        if ($request->has('image')) {
            $imageLocation = Media::updateImage($request, 'image', $category->image, 'uploads\products', 'products');
            $category->update(['image' => $imageLocation]);
        }

        $category->update([
            'name'      => $request->input('name'),
            'slug'      => Str::slug($request->name),
            'status'    => $request->input('status'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Restore trashed specified resource 
     */
    public function restore($category)
    {
        // Cat
        if (!$category = Product::onlyTrashed()->where('slug', $category)->first()) {
            Loggy::error('Product is not found');
            return redirect()->back()->with('error', 'The category is not found');
        }

        try {
            $category->restore();
            return redirect()->back()->with('success', 'The Product is restored');
        } catch (Exception $e) {
            Loggy('Error With restoring Product: ' . $category . ' Message: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error with restoring the category: ' . $category->name);
        }
    }

    /**
     * Force Delete specified resource from storage.
     */
    public function forceDelete($category)
    {
        if (!$category = Product::onlyTrashed()->where('slug', $category)->first()) {
            Loggy::error('Product is not found');
            return redirect()->back()->with('error', 'Product is not found');
        }

        try {
            $category->forceDelete();

            if ($category->image) {
                Media::deleteImage($category->image);
            }
            Loggy::success('Product Force Deleted Successfully , ' . $category);
            return redirect()->back()->with('success', 'Product is force deleted');
        } catch (Exception $e) {
            Loggy('Error with Force Deleting the category: ' . $category . ' Message: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error with Force Deleting the category: ' . $category->name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $category)
    {
        try {
            $category->delete();
        } catch (Exception $e) {
            Loggy::error('Product deletion failed:' . $e->getMessage());
            return redirect()->back()->with('error', 'Product deleted failed');
        }

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }

    /**
     * Update Status of category to archived
     */
    public function updateStatusToArchived(Product $category)
    {
        $category->update(['status' => 'archived']);
        return redirect()->route('products.index')->with('success', 'Product Status Updated Successfully');
    }
}
