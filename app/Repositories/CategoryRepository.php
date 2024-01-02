<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements RepositoryInterface
{
    public function getMainCategories()
    {
        return Category::where('parent_id', 0)
            ->orWhere('parent_id', null)
            ->get();
    }

    public function query($relations = [])
    {
        return Category::select('*')->with($relations);
    }

    public function getById($id, $childCount = false)
    {
        $query = Category::where('id', $id);
        if ($childCount) {
            $query->withCount('child');
        }

        return  $query->firstOrfail();
    }

    public function store($params)
    {
        return Category::create($params);
    }

    public function update($id, $params)
    {
        $category = $this->getById($id);
        return $category->update($params);
    }

    public function delete($id)
    {
        $category = $this->getById($id);
        return $category->delete();
    }
}
