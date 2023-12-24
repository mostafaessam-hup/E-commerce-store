<?php

namespace App\Services;

use App\Models\Category;
use Yajra\DataTables\DataTables;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Utils\ImageUpload;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getMainCategories()
    {
        return $this->categoryRepository->getMainCategories();
    }

    public function dataTable()
    {
        $query = $this->categoryRepository->query(['parent']);
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
        return $this->categoryRepository->getById($id, $childCount);
    }

    public function store($params)
    {
        $params['image'] = ImageUpload::uploadImage($params['image']);
        return $this->categoryRepository->store($params);
    }


    public function update($id, $params)
    {
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image']);
        }

        return $this->categoryRepository->update($id, $params);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
