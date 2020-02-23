<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Scripts -->
    <script>
        @include("layouts.ConfigJs")
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="{{ mix('/js/app.js')  }}" defer></script>
    @yield('css')

    <!-- Style-->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include("layouts.smallTop")
    @include("layouts.navbar");
    <div class="container">
        <div class="logo">
            <div class="row">
                <div class="col-12 text-center"><h2 class="brand">Webmax</h2>
                    <p class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</p>
                </div>
            </div>
        </div>
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        @section('breadcrumb')
                            {!! Breadcrumbs::render('home') !!}
                        @show
                    </nav>
                </div>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="row">
                <div class="col-sm">
                    <div class="footer-col text-center">
                        <h5>About assan</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing
                            condimentum
                            tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum
                            purus
                            molestie.
                        </p>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="footer-col">
                        <h5>Contact</h5>
                        <ul class="list-unstyled contact">
                            <li>
                                <p>
                                    <strong> <i class="fa fa-map-marker"> </i> Address:</strong> vaisahali, jaipur,
                                    302012
                                </p>
                            </li>
                            <li>
                                <p>
                                    <strong><i class="fa fa-envelope"></i> Mail Us:</strong>
                                    <a href="#">Support@designmylife .com</a>
                                </p>
                            </li>
                            <li>
                                <p>
                                    <strong><i class="fa fa-phone"></i> Phone:</strong> +91 1800 2345 2132
                                </p>
                            </li>
                            <li>
                                <p>
                                    <strong><i class="fa fa-print"></i> Fax</strong> 1800 2345 2132
                                </p>
                            </li>
                            <li>
                                <p>
                                    <strong><i class="fa fa-skype"></i> Skype</strong> assan.856
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm">
                    <h5>menu</h5>
                    <ul class="list-unstyled quick-links">
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i>Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i>About</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i>FAQ</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i>Get Started</a>
                        </li>
                        <li>
                            <a href="https://wwwe.sunlimetech.com" title="Design and developed by">
                                <i class="fa fa-angle-double-right"></i>Imprint</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <div class="footer-btm" style="color: white;">
                        <span id="span">©2014. Theme by Design_mylife</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
</html>
