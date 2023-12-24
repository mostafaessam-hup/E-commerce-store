<?php

namespace App\Services;

use App\Models\Category;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Utils\ImageUpload;

class CategoryService
{

    public function getMainCategories()
    {

        return Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
    }

    public function dataTable()
    {
        $query = Category::select('*')->with('parent');
        return  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $btn = '
                        <a href="' . Route('dashboard.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>

                        <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0 mt-2" data-toggle="modal"
                        data-original-title="test" data-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })

            ->addColumn('parent', function ($row) {
                // if ($row->parent) {
                //     return $row->parent->name;
                // }
                // return 'قسم رئيسي';
                return ($row->parent) ? $row->parent->name : 'قسم رئيسي';
            })


            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" width="50px" height="50px">';
            })

            ->rawColumns(['parent', 'action', 'image'])
            ->make(true);
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
        $params['image'] = ImageUpload::uploadImage($params['image']);
        return Category::create($params);
    }


    public function update($id, $params)
    {
        $category = $this->getById($id);
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image']);
        }

        return  $category->update($params);
    }

    public function delete ($id)
    {
        $category=$this->getById($id);
        return $category->delete();
        
    }
}
