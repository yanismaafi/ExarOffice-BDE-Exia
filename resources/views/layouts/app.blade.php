<!DOCTYPE html>
<html lang="fr">

    @include('includes.head')
   
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    
        <div class="site-wrap">

            @include('includes.header')

            @yield('content')
        
            @include('includes.footer')

        </div> <!-- .site-wrap -->

            @include('includes.script')
            @include('sweetalert::alert')
    </body>
</html>