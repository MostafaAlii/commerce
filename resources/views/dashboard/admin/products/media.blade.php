@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@section('title')
صور {{ $product?->name }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">
                صور {{ $product?->name }}
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
                <form class="form form-horizontal"
                    action="{{ route('products.images.store.db') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="product_id" value="{{$id}}">
                    <div class="form-body">
                        <div class="form-group">
                            <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                <div class="dz-message">رفع الملفات هنا</div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                            <i class="ft-x"></i> رجوع
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> حفظ
                        </button>
                    </div>
                </form>
                @php
                    $images = \App\Models\ProductImage::where('product_id', $id)->get(['photo','id', 'product_id']);
                @endphp
            </div>
            </br>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="card-text">
                        <h3>Media</h3>
                    </div>
                    <div class="card-body  my-gallery" itemscope="" itemtype="http://schema.org/ImageGallery"  data-pswp-uid="1">
                        <div class="row">
                            @isset($images)
                                @forelse($images as $image)
                                    <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope=""
                                            itemtype="http://schema.org/ImageObject">
                                        <a href="{{asset('dashboard/img/product/productGallery/' . $image->photo)}}" itemprop="contentUrl" data-size="480x360">
                                            <img class="img-thumbnail img-fluid"
                                                src="{{asset('dashboard/img/product/productGallery/' . $image->photo)}}"
                                                itemprop="thumbnail" alt="Image description">
                                        </a>
                                        <form method="POST" action="{{ route('products.image.destroy', ['product_id' => $id, 'image_id' => $image->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </figure>
                                @empty
                                     لا يوجد صور لهذا المنتج  <span class="text-success">{{ ' ' . $product?->name}}</span>
                                @endforelse
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.dpzMultipleFiles = {
        paramName: "dzfile", // The name that will be used to transfer the file
        //autoProcessQueue: false,
        maxFilesize: 10240, // MB
        clickable: true,
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        dictFallbackMessage: "your browser not support drag and drop",
        dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
        dictCancelUpload: " Cancel Upload ",
        dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
        dictRemoveFile: "Delete",
        dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }

        ,
        url: "{{ route('products.images.store') }}", // Set the url
        success: function(file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
        init: function() {

            @if (isset($event) && $event->document)
                var files =
                    {!! json_encode($event->document) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }
</script>
@endsection