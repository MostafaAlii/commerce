<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @if (app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_en/css/normalize.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_en/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_en/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_en/css/style.css') }}" />
        <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    @else
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_ar/css/normalize.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_ar/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_ar/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_ar/css/style.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/web/asset_ar/css/style-rtl.css') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    @yield('styles')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-qMbF/3gU4p8zYUV6+0kXmHJOMF3z0spNJid6a9b+ou0Df2C97KpxLmyW+5g3zzVb" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <title>@yield('title') | We-Digit</title>
</head>

<body>
    @include('layouts.common.includes.site.header')
    @yield('content')
    @include('layouts.common.includes.site.footer')
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @if (app()->getLocale() == 'en')
        <script src="{{ URL::asset('assets/web/asset_en/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ URL::asset('assets/web/asset_en/js/main.js') }}"></script>
        <script src="{{ URL::asset('assets/web/asset_en/js/swiper.js') }}"></script>

        {{-- <script src="{{ url('') }}/assets/web/asset_en/js/count.js"></script> --}}
        <script src="{{ URL::asset('assets/web/asset_en/js/filter.js') }}"></script>



    @else
        <script src="{{ URL::asset('assets/web/asset_ar/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ URL::asset('assets/web/asset_ar/js/main.js') }}"></script>
        <script src="{{ URL::asset('assets/web/asset_ar/js/swiper.js') }}"></script>

        {{-- <script src="{{ url('') }}/assets/web/asset_ar/js/count.js"></script> --}}
        <script src="{{ URL::asset('assets/web/asset_ar/js/filter.js') }}"></script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>



    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ URL::asset('assets/web/asset_en/js/custom/formAction.js') }}"></script>
    <script src="{{ URL::asset('assets/web/asset_en/js/custom/toastrResponse.js') }}"></script>
    @if (\Auth::user())
        <script>
            setTimeout(
                function() {
                    viewCart()
                    viewFavorite()
                }, 50);
        </script>
    @endif
    <script>

    </script>
</body>

</html>
