
    <nav class="site-navigation position-relative text-right" role="navigation">
    
        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
        <li><a href="{{ route('home.index') }}" class="nav-link"> <i class="fa fa-home"></i> Accueil</a></li>
        <li><a href="{{ route('home.about') }}" class="nav-link">A-propos</a></li>
        <li><a href="{{ route('event.index') }}" class="nav-link">Evenements</a></li>
        <li><a href="{{ route('blog.index') }}" class="nav-link">Blog</a></li>
        <li><a href="{{ route('product.index') }}" class="nav-link">Boutique</a></li>
    
        @if(auth::check())
            <li>
                <a href="{{ route('cart.index') }}" class="nav-link"><i class="fa fa-shopping-cart fa-lg"></i> 
                    <span class="badge badge-pill badge-dark"> {{ Cart::count() }} </span>
                </a>
            </li>
            <li>
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">
                    @if (Empty(auth::user()->profile_picture) )
                      <img id="profile_picture" src="{{ asset('images/users/default_picture.png') }}" alt="Default picture" class="rounded-circle z-depth-0" alt="Avatar_image" height="30"/>
                    @else  
                      <img id="profile_picture" src="{{ asset('images/users/'.auth::user()->profile_picture) }}" class="rounded-circle z-depth-0" alt="Avatar_image" height="40">
                    @endif 
                     {{auth::user()->name}}
                 </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                    <a class="dropdown-item" href="{{ route('profile.show',auth::id()) }}">Profil</a>
                    @if (auth::user()->isAdmin())
                       <a class="dropdown-item" href="{{ route('admin.index') }}"> Espace admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Déconnexion</button>
                    </form>
                </div>
            </li>
        @else 
            <li>
                <a href="{{ route('login') }}" class="btn btn-primary text-white ml-2">
                    <i class="fa fa-user fa-lg"></i> Espace membre
                </a>
            </li>
        @endif
        </ul>
        
    </nav>
