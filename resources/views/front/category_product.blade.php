@extends('layouts.site')
@section('styles')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
{{$title . ' ' . $category?->name}}
@stop
@endsection

@section('content')
    <!-- Start Paths -->
    <div class="paths py-4">
        <div class="container">
            <p style="gap: 0.5rem" class="d-flex align-items-center">
                <span>
                    <a href="{{ route('site.home') }}" class="text-dark">
                        {{trans('site/home.home')}}
                    </a>
                </span>
                <i class="fa-solid fa-chevron-left"></i>
                <span>{{$title . ' ' . $category?->name}}</span>
            </p>
        </div>
    </div>
    <!-- End Paths -->

    <!-- Start Products -->
    <div class="product-slider mt-5">
        <div class="container">
            <div class="filters d-flex flex-column flex-md-row gap-4 justify-content-between mb-3">
                <p class="text-secondary showing">عرض <small id="num"></small>–<small
                        id="paginates"></small> من
                    <small id="count_products"></small> نتائج
                </p>
                <div class="filter-icon d-flex align-items-center gap-4">
                    <div class="filter d-flex align-items-center gap-2" id="bar-one">
                        <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_456_25)">
                                <path
                                    d="M0.5625 3.17317H9.12674C9.38486 4.34806 10.4341 5.2301 11.6853 5.2301C12.9366 5.2301 13.9858 4.3481 14.2439 3.17317H17.4375C17.7481 3.17317 18 2.92131 18 2.61067C18 2.30003 17.7481 2.04817 17.4375 2.04817H14.2437C13.9851 0.873885 12.9344 -0.00871277 11.6853 -0.00871277C10.4356 -0.00871277 9.38545 0.873744 9.12695 2.04817H0.5625C0.251859 2.04817 0 2.30003 0 2.61067C0 2.92131 0.251859 3.17317 0.5625 3.17317ZM10.191 2.61215L10.191 2.6061C10.1935 1.78461 10.8638 1.11632 11.6853 1.11632C12.5057 1.11632 13.1761 1.78369 13.1796 2.6048L13.1797 2.61306C13.1784 3.43597 12.5086 4.10513 11.6853 4.10513C10.8625 4.10513 10.1928 3.43663 10.191 2.61422L10.191 2.61215ZM17.4375 14.8268H14.2437C13.985 13.6525 12.9344 12.7699 11.6853 12.7699C10.4356 12.7699 9.38545 13.6524 9.12695 14.8268H0.5625C0.251859 14.8268 0 15.0786 0 15.3893C0 15.7 0.251859 15.9518 0.5625 15.9518H9.12674C9.38486 17.1267 10.4341 18.0087 11.6853 18.0087C12.9366 18.0087 13.9858 17.1267 14.2439 15.9518H17.4375C17.7481 15.9518 18 15.7 18 15.3893C18 15.0786 17.7481 14.8268 17.4375 14.8268ZM11.6853 16.8837C10.8625 16.8837 10.1928 16.2152 10.191 15.3928L10.191 15.3908L10.191 15.3847C10.1935 14.5632 10.8638 13.8949 11.6853 13.8949C12.5057 13.8949 13.1761 14.5623 13.1796 15.3834L13.1797 15.3916C13.1785 16.2146 12.5086 16.8837 11.6853 16.8837ZM17.4375 8.43751H8.87326C8.61514 7.26262 7.56594 6.38062 6.31466 6.38062C5.06338 6.38062 4.01418 7.26262 3.75606 8.43751H0.5625C0.251859 8.43751 0 8.68936 0 9.00001C0 9.31068 0.251859 9.56251 0.5625 9.56251H3.75634C4.01498 10.7368 5.06559 11.6194 6.31466 11.6194C7.56439 11.6194 8.61455 10.7369 8.87305 9.56251H17.4375C17.7481 9.56251 18 9.31068 18 9.00001C18 8.68936 17.7481 8.43751 17.4375 8.43751ZM7.80901 8.99853L7.80898 9.00458C7.80652 9.82607 7.13619 10.4944 6.31466 10.4944C5.49429 10.4944 4.82393 9.82699 4.82038 9.00591L4.82027 8.99769C4.8215 8.17468 5.49141 7.50562 6.31466 7.50562C7.13753 7.50562 7.80718 8.17408 7.80905 8.99653L7.80901 8.99853Z">
                                </path>
                            </g>
                        </svg>
                        <p>الفلاتر</p>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2" style="margin: 0px;">
                        <li><a class="dropdown-item priceBy" data-id="ASC" onclick="selectPrice(this)"
                                style="cursor: pointer">web.low_high</a></li>
                        <li><a class="dropdown-item priceBy" data-id="DESC" onclick="selectPrice(this)"
                                style="cursor: pointer">web.high_low</a></li>
                    </ul>
                </div>
            </div>
            
            <div id="filtering">
                <!-- Start Product -->
                <div class="row gy-4 mb-80">
                    @forelse($category->products as $product)
                    <div class="col-6 col-md-4 col-lg-3 mb-3">
                        <div class="box rounded overflow-hidden border position-relative">
                            <div class="seller position-absolute">76% off</div>
                            <div class="icons d-flex align-items-center gap-2">
                                <div class="heart d-flex align-items-center justify-content-center">
                                    <a data-id="3" onclick="toggleFavoriteProduct(this)" class="heart position-absolute d-flex align-items-center justify-content-center">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                </div>
                                <div class="comparee d-flex align-items-center justify-content-center">
                                    <a data-id="3" onclick="addCompare(this)" class="heart position-absolute d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-code-compare"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Product Img -->
                            <a href="{{route('site.product.details', $product->id)}}" class="pic">
                                <img src="{{$product->ImagePath()}}" alt="{{$product?->name}}" class="mw-100">
                            </a>
                            <!-- Start Product Info -->
                            <div class="content d-flex flex-column align-items-center justify-content-center gap-1 px-1 pb-2">
                                <a href="{{route('site.product.details', $product->id)}}" class="fw-bold text-black">{{$product?->name}}</a>
                                <p>{{ Illuminate\Support\Str::limit($product->description, 25) }}</p>
                                <div class="price d-flex align-items-center justify-content-center gap-2 pt-1">
                                    <div class="old" style="color: var(--second-color)">{{$product?->price}} ريال سعودي</div>
                                        <div class="old" style="text-decoration: line-through;margin-top: -5px;color: var(--fourth-color);">
                                            {{$product?->price}} ريال سعودي
                                        </div>
                                    </div>
                                <div class="btn shop-btn">
                                    <a data-id="3" data-message="يرجي تسجيل الدخول" onclick="addCart(this)">اضف لعربة التسوق</a>
                                </div>
                            </div>
                            <!-- End Product Info -->
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <!-- End Product -->
            </div>
        </div>
    </div>
    <!-- End Products -->
@endsection
@section('scripts')
<script src="https://wedigitsa.com/assets/web/asset_ar/js/main.js"></script>
<script src="https://wedigitsa.com/assets/web/asset_ar/js/swiper.js"></script>
@endsection