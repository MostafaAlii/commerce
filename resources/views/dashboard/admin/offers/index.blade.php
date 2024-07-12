@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
العروض    
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
                    <h6 class="m-0 font-weight-bold text-primary">العروض</h6>
                    <div class="ml-auto">
                        <button type="button" class="button x-small btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">اضافة عرض جديد</span>
                        </button>
                    </div>
                </div>
                @include('dashboard.admin.offers.modal.create')
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الصوره</th>
                                <th>الحاله</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @forelse ($offers as $offer)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $offer?->name }}</td>
                                    <td>
                                        <img src="{{ $offer?->ImagePath() }}" width="100">
                                    </td>
                                    <td>{!! $offer?->statusWithLabel() !!}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $offer->id }}" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $offer->id }}" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    @include('dashboard.admin.offers.modal.edit')
                                    @include('dashboard.admin.offers.modal.destroy')
                                </tr>
                            @empty
                            
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
<script>
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