
@extends('layouts.master')

@section('title')
Create Category
@endsection

@section('css')
@endsection

@section('pagename')
اضافة منتج
@endsection

@section('title_page1')
Digital
@endsection

@section('title_page2')
Sub Category

@endsection

@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        {{-- <h3>{{/*$category->name*/}} --}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">



                    </div>

                    <div class="card-body">

                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="table-responsive table-desi">

                            {{-- <form class="needs-validation" action="{{route('dashboard.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data"> --}}
                                <div class="form">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">الإسم :</label>
                                        <input class="form-control" id="validationCustom01" type="text"
                                            name="name" 
                                            >
                                    </div>
                                    {{-- @if ($category->child_count < 1) --}}
                                    <div class="form-group">
                                        <label for="validationCustom01" class="mb-1">القسم الرئيسي </label>
                                        <select name="parent_id" id="" class="form-control">
                                            <option value="" >قسم رئيسي</option>
                                            @foreach ($mainCategories as $category)
                                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- @endif --}}

                                    <div class="form-group mb-0">
                                        <label for="validationCustom02" class="mb-1">الصورة :</label>
                                        <input class="form-control dropify" id="validationCustom02" type="file"
                                            name="image" 
                                            {{-- data-default-file="{{asset($category->image)}}" --}}
                                            >
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>
    @endsection

    @section('scripts')
    @endsection