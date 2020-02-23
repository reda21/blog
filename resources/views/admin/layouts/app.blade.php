<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include("admin.layouts.meta")
    @component("admin.layouts.css")
        @yield('css')
    @endcomponent
</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    @include("admin.shared.nav-builder")
</div>
<div class="c-wrapper">
    @include("admin.shared.header")
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    </div>
    @include('admin.shared.footer')
</div>
@component("admin.layouts.js")
    @yield('javascript')
@endcomponent
</body>
</html>
