<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('includes.head')

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">
        @include('includes.header')

        @yield('content')
    
        @include('includes.footer')
    </div> 

    @include('includes.script')
    
</body>
</html>