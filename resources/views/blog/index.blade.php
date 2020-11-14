@extends('layouts.app')

@section('content')

 
<div class="site-section" id="blog-section">
    <div class="container">

      <div class="row mb-5 justify-content-center">
        <div class="col-md-6 text-center">
          <h2 class="section-title mb-3 mt-4">Blog Posts </h2>
          <p>De nombreux évenements culturels et scientifiques sont organisés au sein de l'école Cesi Exia centre d'Alger, n'attendez plus est inscrivez-vous dès maintenant ! </p>
        </div>
      </div>

     
      @if ($posts->count() > 0)
        <div class="row">
            @foreach ($posts as $post)
                
                  <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                    <div class="h-entry">
                      <img src="{{ asset('images/blog/' . $post->image) }}" alt="Image" class="img-fluid">
                      <h2 class="font-size-regular"><a href="{{ route('blog.show',$post->id) }}" class="text-black">{{ ucfirst($post->title) }}</a></h2>
                      <div class="meta mb-4">{{ $post->author }}
                        <span class="mx-2">&bullet;</span> {{\Carbon\Carbon::parse($post->created_at)->toFormattedDateString()}}<span class="mx-2">&bullet;</span> 
                        <a href="#">Nouveau</a>
                      </div>
                      <div class="mb-4"> 
                        <div class="price">{{ Str::words( $post->content, 25, ' . . .') }}</div>
                      </div>
                      <p><a href="{{ route('blog.show',$post->id) }}">Continuer la lecture...</a></p>
                    </div> 
                  </div>
              
          @endforeach
        </div>

    
      @else
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <div class="clearfix">
                <img src="{{ asset('images/error_content/icon_Sad.png') }}" class="img-fluid pull-left mr-3 ml-2" alt="Icon" style="height:150px">
                <h3 class="display-5"> Désolé, il n'y a aucun post publier pour le moment.</h3>
                <p class="lead"> Voulez-vous créer un Post ? --> <a href="{{ route('blog.create') }}">Publier un Post</a></p>
              </div>
            </div>
          </div>      
      @endif
      
    </div>
  </div>

@endsection