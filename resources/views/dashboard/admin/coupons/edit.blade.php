@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
تعديل {{ $coupon->code }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                تعديل {{ $coupon->code }}
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
                <form action="{{ route('coupons.update', $coupon->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="code">الكود</label>
                                <input type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}" class="form-control">
                                @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="type">النوع</label>
                            <select name="type" class="form-control">
                                <option value="">---</option>
                                <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : null }}>ثابت</option>
                                <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : null }}>مئوى</option>
                            </select>
                            @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="value">القيمه</label>
                                <input type="text" name="value" value="{{ old('value', $coupon->value) }}" class="form-control">
                                @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="use_times">عدد الاستخدام</label>
                                <input type="number" name="use_times" value="{{ old('use_times', $coupon->use_times) }}" class="form-control">
                                @error('use_times')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="start_date">تاريخ البداية</label>
                                <input type="date" name="start_date" id="start_date" value="{{ \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') }}" class="form-control">
                                @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="expire_date">تاريخ الانتهاء</label>
                                <input type="date" name="expire_date" id="expire_date" value="{{ \Carbon\Carbon::parse($coupon->expire_date)->format('Y-m-d') }}" class="form-control">
                                @error('expire_date')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="greater_than">اعلى من</label>
                                <input type="number" name="greater_than" value="{{ old('greater_than', $coupon->greater_than) }}" class="form-control">
                                @error('greater_than')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="status">الحاله</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status', $coupon->status) == '1' ? 'selected' : null }}>فعال</option>
                                    <option value="0" {{ old('status', $coupon->status) == '0' ? 'selected' : null }}>غير فعال</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">الوصف</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $coupon->description) }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group pt-4">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection