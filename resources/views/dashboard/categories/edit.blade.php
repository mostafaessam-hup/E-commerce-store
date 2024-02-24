@extends('layouts.master')

@section('title')
تعديل قسم
@endsection

@section('css')
@endsection

@section('pagename')
تعديل قسم
@endsection

@section('title_page1')
Digital
@endsection

@section('title_page2')
Sub Category

@endsection

@section('content')

<div class="page-body">

    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
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

                                <form class="needs-validation"
                                    action="{{route('dashboard.categories.update',$category->id)}}" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="form">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="validationCustom01" class="mb-1">الإسم :</label>
                                            <input class="form-control" id="validationCustom01" type="text" name="name"
                                                value="{{$category->name}}">
                                        </div>
                                        @if ($category->child_count < 1) <div class="form-group">
                                            <label for="validationCustom01" class="mb-1">القسم الرئيسي </label>
                                            <select name="parent_id" id="" class="form-control">
                                                <option value="" @if ($category->parent_id == null ) selected @endif>
                                                    قسم رئيسي </option>
                                                @foreach ($mainCategories as $maincategory)
                                                <option value="{{ $maincategory->id }}" @if ($maincategory->id ==
                                                    $category->parent_id) selected @endif> {{$maincategory->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                    </div>
                                    @endif
                                    <div class="form-group mb-0">
                                        <label for="validationCustom02" class="mb-1">الصورة :</label>
                                        <input class="form-control dropify" id="validationCustom02" type="file"
                                            name="image" data-default-file="{{asset($category->image)}}">
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