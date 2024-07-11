<a href="https://wa.me/966530882044" target="_blank" class="whatsapp d-flex align-items-center justify-content-center">
    <i class="fa-brands fa-whatsapp"></i>
  </a>
<!-- Start Navbar -->
<nav>
  <div class="navbar">
      <div class="container d-flex flex-column flex-lg-row flex-md-row">
          <div style="flex: 1" class="all d-flex justify-content-between">
              <div class="cart d-flex gap-4 align-items-center justify-content-center">
                  <div style="cursor: pointer" class="list" id="bar">
                      <i class="fa-solid fa-bars"></i>
                  </div>
              </div>
              <a href="{{-- route('web.index') --}}" class="logo d-flex gap-2 align-items-center">
                  <div class="pic">
                      <img style="width: 130px" class="mw-100"
                          src="{{ URL::asset('assets/web/asset_en/img/logo.png') }}" alt="" />
                  </div>
              </a>
              {{-- <form id="form-search" method="get" action="{{ route('web.shop') }}">
              </form> --}}

              <form method="get" action="{{-- route('web.shop') --}}"
                  class="search d-flex align-items-center justify-content-center">
                  <div class="form-outline" style="flex: 1" data-mdb-input-init>
                      <input type="search" id="form1" name="product" class="form-control"
                          @isset($request) value="{{-- $request->product --}}" @endisset
                          placeholder="search_all_products" aria-label="Search" />
                  </div>
                  <button type="button" class="btn btn-primary text-uppercase" data-mdb-ripple-init>
                      search
                  </button>
              </form>

              {{-- <input type="search" form="form-search" id="form1" class="form-control"name="product"
                  type="text" @isset($request) value="{{ $request->product }}" @endisset
                  placeholder="{{ __('web.search_all_products') }}" aria-label="Search" /> --}}
              <div class="icons d-flex align-items-center gap-3">
                  @if (app()->getLocale() == 'ar')
                      <a href="{{ LaravelLocalization::getLocalizedUrl('en') }}" class="text-black fw-bold">
                          english
                      </a>
                  @else
                      <a href="{{ LaravelLocalization::getLocalizedUrl('ar') }}" class="text-black fw-bold">
                          arabic
                      </a>
                  @endif
                  @auth
                      <a href="{{-- route('account.index') --}}" class="user d-flex align-items-center">
                          <i class="fa-regular fa-user text-black"></i>
                      </a>
                      <a href="{{-- route('favorite.index') --}}" class="cart-shopping position-relative d-flex align-items-center text-black">
                          <i class="fa-regular fa-heart"></i>
                          <span>&nbsp;</span>
                          <span class="icon-cart-span" id="count_favorites"></span>
                      </a>
                      <a href="{{-- route('cart.index') --}}">
                          <div class="cart-shopping position-relative d-flex align-items-center">
                              <img src="{{URL::asset('assets/web/asset_en/img/shopping-bag.png') }}" class="mw-100"
                                  alt="" />
                              <span>&nbsp;</span>
                              <span class="icon-cart-span" id="count_carts"></span>
                          </div>
                      </a>

                      <a href="{{-- route('compare.index') --}}" class="user d-flex align-items-center">
                          <div class="cart-shopping position-relative d-flex align-items-center">
                              {{-- <img src="{{ url('') }}/assets/web/asset_en/img/shopping-bag.png" class="mw-100"
                                  alt="" /> --}}
                                  <i class="fa-solid fa-code-compare text-black"></i>

                          </div>
                      </a>
                  @endauth
                  @guest

                      <a href="{{-- route('web.login') --}}" class="user d-flex align-items-center">
                          <i class="fa-regular fa-user text-black"></i>
                      </a>
                  @endguest

              </div>
          </div>
      </div>
  </div>
</nav>

{{-- <div class="comparee position-absolute d-flex align-items-center justify-content-center">
  <a data-id="{{ $product->id }}"  onclick="addCompare(this)" class="heart position-absolute d-flex align-items-center justify-content-center">
      <i class="fa-solid fa-code-compare"></i>

  </a>
</div> --}}
<div class="nav-two">
  <div class="container">
      <ul class="d-flex align-items-center justify-content-center gap-3 py-3 mb-0">
          <li class="link-two">
              <a href="{{ route('site.home') }}" class="text-uppercase">{{trans('site/home.home')}}</a>
          </li>
          {{-- <li>
              <a href="{{ route('web.about_us') }}" class="text-uppercase"> {{ __('web.about_us') }}</a>
          </li> --}}
          <li>
              <a href="{{-- route('web.contact') --}}" class="text-uppercase"> contact_us </a>
          </li>
          {{-- <li>
              <a href="{{ route('web.blog') }}" class="text-uppercase"> {{ __('web.blogs') }} </a>
          </li> --}}
          <li>
              <a href="{{-- route('web.shop') --}}" class="text-uppercase"> shop </a>
          </li>
          <li>
              <a href="{{-- route('web.shop') --}}" class="text-uppercase"> special_offer</a>
          </li>
      </ul>
  </div>
</div>
<!-- End Navbar -->
<!-- Start Sidebar -->
<div class="sidebar">
  <div class="content">
      <div class="close d-flex justify-content-between align-items-center border-bottom p-2">
          <div class="pic">
              <img style="width: 100px" class="mw-100" src="{{ URL::asset('assets/web/asset_en/img/logo.png') }}"
                  alt="" />
          </div>
          <i class="fa-solid fa-x m-0" id="close"></i>
      </div>
      <ul class="d-flex flex-column pe-2 p-0">
          <li>
              <form method="get" action="{{-- route('web.shop') --}}"
                  class="search d-flex align-items-center justify-content-center m-auto">
                  <div class="form-outline position-relative side-link" style="flex: 1" data-mdb-input-init>
                      <input style="border: none" type="search" id="form1" class="form-control"
                          placeholder= "search_all_products" aria-label="Search" />
                      <i class="fa-solid fa-magnifying-glass position-absolute"
                          style="
                  right: 1rem;
                  top: 5px;
                  border: none !important;
                  border-radius: 0;
                  border-left: 1px solid var(--second-color) !important;
                      "></i>
                  </div>
              </form>
          </li>
          <li><a href="{{-- route('web.index') --}}" class="side-link">home</a></li>
          <!-- Contenedor -->
          <li>
              <ul id="accordion" class="accordion">

                  {{--@foreach ($allcategories as $row)
                      @if (count($row->models))
                          <li>
                              <div class="link side-link">
                                  <span><a href="{{ route('web.shop') }}?category_id={{ $row->id }}"
                                          style="color: black">{{ $row->title }}</a></span><i
                                      class="fa fa-chevron-down"></i>
                              </div>
                              <ul class="submenu">
                                  @foreach ($row->models as $model)
                                      <li><a href="{{ route('web.shop') }}?category_id={{ $row->id }}&model_id={{ $model->id }}"
                                              style="color: black;background-color:white">{{ $model->details->title }}</a>
                                      </li>
                                  @endforeach
                              </ul>


                          </li>
                      @else
                          <li>
                              <div class="link side-link">
                                  <span><a href="{{ route('web.shop') }}?category_id={{ $row->id }}"
                                          style="color: black">{{ $row->title }}</a></span>
                              </div>
                          </li>
                      @endif
                  @endforeach--}}
              </ul>
          </li>
      </ul>
  </div>
</div>
<!-- End Sidebar -->
