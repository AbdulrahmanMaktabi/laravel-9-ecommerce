<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Facades\Loggy;
use App\Facades\Media;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use Exception;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Store;

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
            ->Trashed()
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
        $categories = Category::with(['children', 'parent'])
            ->get();

        $stores = Store::all();

        if (!$categories) {
            Loggy::error('Can`t load categories');
        }

        if (!$stores) {
            Loggy::error('Can`t load stores');
        }

        return view('dashboard.sections.products.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $request->validated();

        $imageLocation = Media::uploadImage($request, 'image', 'uploads/products', 'products');

        if (!$imageLocation) {
            Loggy::error('can not upload Image');
            return redirect()->route('products.index')->with('error', 'can not upload the image!');
        }

        try {
            $product = Product::create([
                'store_id' => Store::where('slug', $request->store)->value('id'),
                'category_id' => Category::where('slug', $request->category)->value('id'),
                'title' => $request->title,
                'slug'  => Str::slug($request->title),
                'small_description' => $request->small_description,
                'description' => $request->description,
                'price' => $request->price,
                'compare_price' => $request->compare_price,
                'status' => $request->status,
                'meta_title' => $request->meta_title,
                'meta_links' => $request->meta_links,
                'meta_description' => $request->meta_description,
                'image' => $imageLocation
            ]);
            Loggy::success("Product Created Successfully , " . $product);
        } catch (Exception $e) {
            Loggy::error($e->getMessage());
            return redirect()->route('products.index')->with('error', $e->getMessage());
        }

        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::with(['children', 'parent'])
            ->get();

        $stores = Store::all();

        if (!$categories) {
            Loggy::error('Can`t load categories');
        }

        if (!$stores) {
            Loggy::error('Can`t load stores');
        }

        return view('dashboard.sections.products.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $category
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->has('image')) {
            $imageLocation = Media::updateImage($request, 'image', $product->image, 'uploads/products', 'products');
            $product->update(['image' => $imageLocation]);
        }

        unset($data['store']);
        unset($data['category']);

        $data['store_id'] = Store::where('slug', $request->store)->value('id');
        $data['category_id'] = Category::where('slug', $request->category)->value('id');

        try {
            $product->update($data);
        } catch (Exception $e) {
            Loggy::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

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
