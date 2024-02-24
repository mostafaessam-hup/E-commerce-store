<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Product;
use App\Utils\ImageUpload;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('dashboard.products.index');
    }

    public function show($id)
    {
        $product = $this->productService->getById($id, true);
        return view('dashboard.products.show',compact('product'));
    }

    public function getall()
    {
        return $this->productService->dataTable();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getMainCategories();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->store($request->validated());
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->getMainCategories();
        $product = $this->productService->getById($id, true);
        return view('dashboard.products.edit', compact('categories', 'product'));
    }

    public function update(ProductRequest $request, string $id)
    {
        $this->productService->update($id, $request->validated());
        return redirect()->route('dashboard.products.index')->with('success', 'تمت الاضافة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(ProductRequest $request)
    {
        $this->productService->delete($request->id);
        return redirect()->route('dashboard.products.index');
    }
}
