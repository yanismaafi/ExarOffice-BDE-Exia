
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

   <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center">
            
            <div class="col-6 col-xl-2">
              <h1 class="mb-0 site-logo"><a href="{{ route('home.index') }}" class="text-black mb-0">Exar<span class="text-primary">Office.</span> </a></h1>
            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
               
              @if (Request::is('admin','admin/*'))
                  @include('admin.navbar')
              @else
                  @include('includes.navbar')
              @endif

            </div>
  
            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
              <a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
            </div>
  
          </div>
        </div>
        
      </header>
  