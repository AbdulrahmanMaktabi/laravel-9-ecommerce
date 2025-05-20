<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'          => [
                'title'         => $this->title,
                'price'         => [
                    'normal'            => $this->price,
                    'discount'          => $this->compare_price
                ],
                'discription'   => [
                    'long'          => $this->description,
                    'small'         => $this->small_description
                ],
                'qty'           => $this->qty,
                'meta'          => [
                    'title'         => $this->meta_title,
                    'links'         => $this->meta_links,
                    'description'   => $this->meta_description
                ],
                'image'         => $this->imageUrl,
                'status'        => $this->status,
                'relations'     => [
                    'category'          => [
                        'id'            => $this->category->id,
                        'name'          => $this->category->name
                    ],
                    'store'             => [
                        'id'            => $this->store->id,
                        'name'          => $this->store->name
                    ],
                    'tags' => $this->tags->map(function ($tag) {
                        return [
                            'id' => $tag->id,
                            'name' => $tag->name,
                        ];
                    }),
                ]
            ]
        ];
    }
}
