<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductImage;
use App\Utils\ImageUpload;

class ProductRepository implements RepositoryInterface
{
    public function query($relations = [], $withCount = [])
    {
        $query = Product::select('*')->with($relations);
        foreach ($withCount as $key => $value) {
            $query->withCount($value);
        }
        return $query;
    }

    public function getById($id, $childCount = false)
    {
        return Product::where('id', $id)->firstOrFail();
    }


    public function uploadMultiImage ($params, $product)
    {
        $images = [];
        if(isset($params['images'])){
            $i=0;
            foreach($params['images'] as $key=>$value){
                $images[$i]['image'] = ImageUpload::uploadImage($value);
                $images[$i]['product_id'] = $product->id;
                $i++;
            }

            return $images;
    }
}

    public function store($params)
    {
        $product = Product::create($params);
        $images =$this->uploadMultiImage($params, $product);
        $product->images()->createMany($images);
        return $product;
        
    }

    public function addColor ($product, $params)
    {
        $product->productColor()->createMany($params['colors']);
    }

    public function update($id, $params)
    {
        $product = $this->getById($id);
        $product = $product->update($params);
        $product = $this->getById($id);
        $images =$this->uploadMultiImage($params, $product);
        $product->images()->createMany($images);
        
    }

    public function delete($id)
    {
        $product = $this->getById($id);
        return $product->delete();
    }
}
