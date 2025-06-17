@include("layouts.header")

@yield('content')
@stack('scripts')
@stack('styles')
@include("layouts.footer")
