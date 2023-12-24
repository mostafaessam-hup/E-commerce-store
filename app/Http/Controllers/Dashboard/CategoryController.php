<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    public function index()
    {
        $mainCategories = $this->CategoryService->getMainCategories();
        return view('dashboard.categories.index', compact('mainCategories'));
    }

    public function getAll()
    {
        return $this->CategoryService->dataTable();
    }


    public function create()
    {
        $mainCategories = $this->CategoryService->getMainCategories();
        return view('dashboard.categories.create', compact('mainCategories'));
    }


    public function store(CategoryRequest $request)
    {
        $this->CategoryService->store($request->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'تمت الاضافة بنجاح');
    }



    public function edit(string $id)
    {
        $mainCategories = $this->CategoryService->getMainCategories();
        $category = $this->CategoryService->getById($id, true);
        return view('dashboard.categories.edit', compact('category', 'mainCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->CategoryService->update($id, $request->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'تمت الاضافة بنجاح');
    }




    public function delete(CategoryRequest $request)
    {
        $category=$this->CategoryService->delete($request->id);
        return redirect()->route('dashboard.categories.index');
    }
}
