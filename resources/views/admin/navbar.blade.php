
    <nav class="site-navigation position-relative text-right" role="navigation">
    
        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
            <li><a href="{{ route('user.index') }}" class="nav-link"><i class="fa fa-users"></i> Gérer les users</a></li>
            <li><a href="{{ route('admin.event') }}" class="nav-link"><i class="fa fa-calendar"></i> Gérer les évents</a></li>
            <li><a href="{{ route('admin.product') }}" class="nav-link"><i class="fa fa-shopping-bag"></i> Gérer la boutique</a></li>
            <li><a href="{{ route('product.order') }}" class="nav-link"><i class="fa fa-list"></i>Commandes</a></li>
            <li>
              @if (auth::check())
                <li>
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"aria-haspopup="true" aria-expanded="false">
                        @if (Empty(auth::user()->profile_picture) )
                          <img src="{{ asset('images/users/default_picture.png') }}" alt="Default picture" class="rounded-circle z-depth-0" alt="Avatar_image" height="30"/>
                        @else  
                          <img src="{{ asset('images/users/'.auth::user()->profile_picture) }}" class="rounded-circle z-depth-0" alt="Avatar_image" height="30">
                        @endif 
                        <span> {{ auth::user()->name }} </span>
                     </a>
                    <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="{{ route('user.edit',auth::id()) }}">Profil</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </div>
                </li>    
              @endif

            </li>
        </ul>
        
    </nav>
