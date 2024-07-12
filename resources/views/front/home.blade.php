@extends('layouts.site')
@section('styles')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
{{$title}}
@stop
@endsection

@section('content')
<!-- Start Offer -->
@isset($offers)
    <div class="offer mt-5">
        <div class="container">
            <!-- Swiper -->
            <div class="swiper mySwiper rounded overflow-hidden">
                <div class="swiper-wrapper">
                    @forelse ($offers as $key => $offer)
                    <div class="swiper-slide">
                        <div class="pic">
                            <a href="{{ $offer?->id }}">
                                <img src="{{ asset($offer->ImagePath()) }}" alt="{{ $offer?->name }}" class="mw-100" />
                            </a>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
@endisset
<!-- End Offer -->

<!-- Start Categories -->
@isset($categories)
<div class="categories mt-5">
    <div class="container">
        <h4 class="fw-bold">تسوق حسب الاقسام</h4>
        <!-- Swiper -->
        <div class="swiper mySwiperOne">
            <div class="swiper-wrapper">
                @forelse ($categories as $key => $category)
                <div class="swiper-slide">
                    <a href="{{ route('site.category.products', $category->id) }}"
                        class="box d-flex align-items-center flex-column gap-2">
                        <div class="pic">
                            <img src="{{ asset($category?->ImagePath()) }}" alt="{{ $category?->name }}" class="mw-100" />
                        </div>
                        <span>{{ $category?->name }}</span>
                    </a>
                </div>
                @empty
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
@endisset
<!-- End Categories -->
@endsection
@section('scripts')
<script src="https://wedigitsa.com/assets/web/asset_ar/js/main.js"></script>
<script src="https://wedigitsa.com/assets/web/asset_ar/js/swiper.js"></script>
@endsection