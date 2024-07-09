@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
اضافة منتج جديد
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
                    <h6 class="m-0 font-weight-bold text-primary">اضافة منتج جديد</h6>
                </div>
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="category_id">القسم</label>
                            <select name="category_id" class="form-control">
                                <option value="">---</option>
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : null }}>{{ $category->name }}</option>
                                @empty
                                @endforelse
                            </select>
                             @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
    
                        <div class="col-3">
                            <label for="status">الحاله</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == 1 ? 'selected' : null }}>فعال</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : null }}>غير فعال</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <label for="description">الوصف</label>
                            <textarea name="description" rows="3" class="form-control summernote">
                                {!! old('description') !!}
                            </textarea>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-4">
                            <label for="quantity">المخزون / الكميه</label>
                            <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control">
                            @error('quantity')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <label for="price">السعر</label>
                            <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                            @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-4">
                            <label for="featured">مميز</label>
                            <select name="featured" class="form-control">
                                <option value="1" {{ old('featured') == 1 ? 'selected' : null }}>نعم</option>
                                <option value="0" {{ old('featured') == 0 ? 'selected' : null }}>لا</option>
                            </select>
                            @error('featured')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
    
                    <div class="row pt-4">
                        <div class="col-12">
                            <label for="images">الصوره</label>
                            <br>
                            <div class="file-loading">
                                <input type="file" name="image" id="product-images" class="file-input-overview">
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group pt-4">
                        <button type="submit" class="btn btn-primary">اضافة</button>
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