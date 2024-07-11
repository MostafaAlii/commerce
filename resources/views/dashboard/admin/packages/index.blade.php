@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('title')
الباكيدج
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
                    <h6 class="m-0 font-weight-bold text-primary">الباكيدج</h6>
                    <div class="ml-auto">
                        <button type="button" class="button x-small btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">اضافة باكيدج جديده</span>
                        </button>
                    </div>
                </div>
                @include('dashboard.admin.packages.modal.create')
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                        <tr>
                            <th>الصوره</th>
                            <th>الاسم</th>
                            <th>المنتجات</th>
                            <th>الوصف</th>
                            <th>السعر</th>
                            <th>الحاله</th>
                            <th>مضاف منذ</th>
                            <th class="text-center" style="width: 30px;">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($packages  as $package)
                            <tr>
                                <td>
                                    <img src="{{ $package?->ImagePath() }}" width="100">
                                </td>
                                <td>{{ $package->name }}</td>
                                <td>
                                    @foreach($package->products as $product)
                                        <span class="text-primary"> {{ $product?->name }} </span>
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{ $package->description }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ $package->getActive() }}</td>
                                <td>{{ $package->created_at?->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $package->id }}" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $package->id }}" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                @include('dashboard.admin.packages.modal.edit')
                                @include('dashboard.admin.packages.modal.destroy')
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No packages found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '80 px'
        });
    });
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection