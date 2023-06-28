<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Master Page')</title>
    @yield('header')
</head>
<body>
    <!-- top-banner -->
    <div class="top-banner position-relative" style="background: #f5f5f5;">
        <div class="text-center px-0">
            <a href="#" class="position-relative d-sm-block d-none " style="max-height: 70px; height:  calc(70 * 100vw /1200); width: 100%;" title="Khuyến mãi">
                <img class="img-fluid position-absolute" src="{{ asset('images/banner-top.png') }}" style="left:0" alt="Khuyến mãi" width="1280" height="44">
            </a>
            <button type="button" class="close" aria-label="Close" style="z-index: 9;">✕</button>
        </div>
    </div>

    <!-- header -->
    @include('user.layout.header')

    <!-- content -->
    <div id="content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('user.layout.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-danger back-to-top"><i class="fa fa-angle-double-up"></i></a>

</body>
@yield('jsblock')
</html>