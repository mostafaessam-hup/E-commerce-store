@extends('layouts.master')

@section('title')
المنتجات
@endsection

@section('css')
@endsection

@section('pagename')
@endsection

@section('title_page1')

@endsection

@section('title_page2')

@endsection

@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> المنتجات
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
                        <a class="btn btn-primary mt-md-0 mt-2" href="{{route('dashboard.products.create')}}">إضافة منتج
                            جديد</a>
                    </div>

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
                            <table class="table all-package table-category mx-auto " id="editableTable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>الإسم</th>
                                        <th>القسم </th>
                                        <th>السعر الأساسي</th>
                                        <th>التخفيض الأساسي</th>
                                        <th> الألوان </th>
                                        <th>action</th>

                                    </tr></a>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ Route('dashboard.products.delete') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <p>متأكد من الحذف .. ؟؟</p>
                            @csrf
                            <input type="hidden" name="id" id="id" >
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-danger">حذف </button>
                    </div>
                </div>
            </form>

        

    </div>

</div>
@endsection
@section('scripts')

<script type="text/javascript">
    $(function() {
            var table = $('#editableTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.products.getall') }}",
                order:[
                    [0,"desc"]
                ],
                columnDefs: [
                     { targets: [0], visible: false } // Hide the 'id' column
                ],
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-center'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        className: 'text-center'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        className: 'text-center'
                    },
                    {
                        data: 'discount_price',
                        name: 'discount_price',
                        className: 'text-center'
                    },
                    {
                        data: 'color',
                        name: 'color',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });

        $('#editableTable tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            $('#deletemodal #id').val(id);
        })
</script>
@endsection

