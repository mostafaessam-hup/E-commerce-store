<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainCategories = Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
        return view('dashboard.categories.index', compact('mainCategories'));
    }

    public function getAll()
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
                if ($row->parent) {
                    return $row->parent->name;
                }
                return 'قسم رئيسي';

                // return ($row->parent ==  0) ? 'قسم رئيسي' :   $row->parent->name;
            })

            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" width="50px" height="50px">';
            })

            ->rawColumns(['parent', 'action', 'image'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mainCategories = Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
        return view('dashboard.categories.create', compact('mainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mainCategories = Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
        $category = Category::findorfail($id);
        return view('dashboard.categories.edit', compact('category', 'mainCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
    }

    public function delete(CategoryRequest $request)
    {
        $category = Category::findorfail($request->id)->delete();
        return redirect()->route('dashboard.categories.index');
    }
}
