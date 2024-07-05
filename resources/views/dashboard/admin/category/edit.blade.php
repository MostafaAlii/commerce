@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
Edit category
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                Edit category {{ $productCategory->name }}
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
                <form action="{{ route('category.update', $productCategory->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name', $productCategory->name) }}" class="form-control">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="parent_id">Parent</label>
                            <select name="parent_id" class="form-control">
                                <option value="">---</option>
                                @forelse($main_categories as $main_category)
                                    <option value="{{ $main_category->id }}" {{ old('parent_id', $productCategory->parent_id) == $main_category->id ? 'selected' : null }}>{{ $main_category->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('parent_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
    
                        <div class="col-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $productCategory->status) == 1 ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status', $productCategory->status) == 0 ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
    
                    <div class="form-group pt-4">
                        <button type="submit" name="submit" class="btn btn-primary">Edit Category</button>
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