<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductStore;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Facades\Loggy;
use App\Models\Media;
use App\Facades\Media as ModelMedia;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Store;
use App\Models\Category;
use Exception;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Product::first()->;
        $products = Product::with(['store:id,name', 'tags:id,name', 'category:id,name'])
            ->Filter($request->query())
            ->paginate(10);
        return ProductResource::collection($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $request->validated();

            DB::beginTransaction();

            if ($request->has('tags')) {
                $tags = explode(',', $request->input('tags'));
                $tags_ids = [];
                foreach ($tags as $tagName) {
                    if (strlen($tagName) == 0) continue;

                    $tag = Tag::firstOrCreate(
                        ['slug' => Str::slug($tagName)],
                        [
                            'name'      => $tagName,
                            'slug'      => Str::slug($tagName)
                        ]
                    );
                    $tags_ids[] = $tag->id;
                }
            }

            $imageLocation = ModelMedia::uploadImage($request, 'image', "uploads/products", 'products');

            if (!$imageLocation) {
                Loggy::error('can not upload Image');
                return redirect()->route('products.index')->with('error', 'can not upload the image!');
            }

            if ($request->has('images')) {
                $locations = ModelMedia::uploadMultiImages($request, 'images');

                if (!$locations) {
                    Loggy::error('Error while uploading product images');
                    return redirect()->back()->with('error', 'Error while uploading product images');
                }

                $images_ids = [];
                foreach ($locations as $location) {
                    $media = Media::create(['location' => $location]);
                    $images_ids[] = $media->id;
                }
            }

            $featured = $request->input('featured') == 'on' ?  1 : 0;

            $product = Product::create([
                'store_id'          => Store::where('slug', $request->store)->value('id'),
                'category_id'       => Category::where('slug', $request->category)->value('id'),
                'title'             => $request->title,
                'small_description' => $request->small_description,
                'description'       => $request->description,
                'price'             => $request->price,
                'compare_price'     => $request->compare_price,
                'qty'               => $request->qty,
                'status'            => $request->status,
                'meta_title'        => $request->meta_title,
                'meta_links'        => $request->meta_links,
                'meta_description'  => $request->meta_description,
                'image'             => $imageLocation,
                'featured'          => $featured
            ]);

            // The sync() method in Laravel is used to synchronize many-to-many relationships
            $product->tags()->sync($tags_ids);
            // attach() adds new records to the pivot table without removing existing ones
            if ($request->has('images_ids'))
                $product->media()->attach($images_ids);

            Loggy::success("Product Created Successfully , " . $product);


            DB::commit();

            return new ProductResource($product);
        } catch (\Throwable $e) {

            DB::rollBack();
            Loggy::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::where('id', $id)->firstOrFail();
            return new ProductResource($product);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
