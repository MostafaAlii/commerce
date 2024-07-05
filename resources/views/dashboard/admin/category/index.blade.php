@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
الاقسام
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                {{-- get_user_data()?->name . ' ' . $title --}}
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                @section('breadcrumb')
                @show
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('layouts.common.partials.messages')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-header py-3 d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">الاقسام</h6>
                    <div class="ml-auto">
                        <a href="{{ route('category.create') }}" class="btn btn-primary">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">اضافة قسم جديد</span>
                        </a>
                    </div>
                </div>
                @include('dashboard.admin.category.filter.filter')
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>عدد المنتجات</th>
                            <th>القسم الرئيسى</th>
                            <th>الحاله</th>
                            <th>اضاف منذ</th>
                            <th class="text-center" style="width: 30px;">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>{{ $category->parent != null ? $category->parent->name : '-' }}</td>
                                <td>{{ $category->status() }}</td>
                                <td>{{ $category?->created_at?->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-product-category-{{ $category->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="post" id="delete-product-category-{{ $category->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No categories found</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="float-right">
                                        {!! $categories->appends(request()->all())->links() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection