@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
الكوبونات
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
                    <h6 class="m-0 font-weight-bold text-primary">الكوبونات</h6>
                    <div class="ml-auto">
                        <a href="{{ route('coupons.create') }}" class="btn btn-primary">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">اضافة كوبون جديد</span>
                        </a>
                    </div>
                </div>
                @include('dashboard.admin.coupons.filter.filter')
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                        <tr>
                            <th>الكود</th>
                            <th>القيمه</th>
                            <th>عدد الاستخدام</th>
                            <th>متاح الى</th>
                            <th>اعلى من</th>
                            <th>الحاله</th>
                            <th>مضاف منذ</th>
                            <th class="text-center" style="width: 30px;">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->value }} {{ $coupon->type == 'fixed' ? '$' : '%' }}</td>
                                <td>{{ $coupon->used_times . ' / ' . $coupon->use_times }}</td>
                                {{--<td>{{ $coupon->start_date != '' ? '' . \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') . '' : '-' }} - {{ $coupon->expire_date != '' ? '' . \Carbon\Carbon::parse($coupon->expire_date)->format('Y-m-d') . '' : '-' }} </td>--}}
                                <td class="coupon-date">
                                    {!! $coupon->start_date != '' ? '<span class="text-success">' . \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') . '</span>' : '-' !!} <br> {!! $coupon->expire_date != '' ? '<span class="text-danger">' . \Carbon\Carbon::parse($coupon->expire_date)->format('Y-m-d') . '</span>' : '-' !!}
                                </td>
                                <td>{{ $coupon->greater_than ?? '-' }}</td>
                                <td>{{ $coupon->status() }}</td>
                                <td>{{ $coupon->created_at?->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="if (confirm('هل انت متاكد من الحذف?')) { document.getElementById('delete-product-coupon-{{ $coupon->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="post" id="delete-product-coupon-{{ $coupon->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No coupons found</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="float-right">
                                        {!! $coupons->appends(request()->all())->links() !!}
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