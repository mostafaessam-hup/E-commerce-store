<?php

namespace App\Repositories;

use App\Models\Product;

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

    public function store($params)
    {
        return Product::create($params);
    }

    public function addColor ($product, $params)
    {
        $product->productColor()->createMany($params['colors']);
    }

    public function update($id, $params)
    {
        $product = $this->getById($id);
        return $product->update($params);
        
    }

    public function delete($id)
    {
        $product = $this->getById($id);
        return $product->delete();
    }
}
