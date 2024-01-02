<?php

namespace App\Services;

use App\Utils\ImageUpload;
use App\Repositories\ProductRepository;
use Yajra\DataTables\Facades\DataTables;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function dataTable()
    {
        $query = $this->productRepository->query(relations: ['category'], withCount: ['productColor']);
        return  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $btn = '
                        <a href="' . Route('dashboard.products.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>

                        <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0 mt-2" data-toggle="modal"
                        data-original-title="test" data-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })
            ->addColumn('category', function ($row) {
                return $row->category->name;
            })
            ->rawColumns(['action', 'category'])
            ->make(true);
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function store($params)
    {
        if (isset($params['image'])) {

            $params['image'] = ImageUpload::uploadImage($params['image']);
        }
        $product = $this->productRepository->store($params);

        if (isset($params['colors'])) {
            $params['colors'] = array_map(function($color) use ($product){
                $colors['color']= $color;
                $colors['product_id']=$product->id;
                return $colors ;
            },$params['colors']);
            $this->productRepository->addColor($product,['colors'=> $params['colors']]);
        }
        return $product;

    }


    public function update($id, $params)
    {
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image']);
        }

        return $this->productRepository->update($id, $params);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}
