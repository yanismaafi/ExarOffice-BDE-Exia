@extends('layouts.app')

@section('content')

 
<div class="site-section" id="product-section">
    <div class="container">

      <div class="row mb-5 justify-content-center">
        <div class="col-md-6 text-center">
          <h2 class="section-title mt-3 mb-3">Evenement à venir </h2>
          <p>De nombreux évenements culturels et scientifiques sont organisés au sein de l'école Cesi Exia centre d'Alger, n'attendez plus est inscrivez-vous dès maintenant ! </p>
        </div>
      </div>  

      @if ($events->count() > 0)

          <div class="row">

            <div class="col-md-12">
              <form action="{{ route('event.search') }}" method="POST">
                 @include('includes.search')
              </form>
            </div>

            @foreach ($events as $event)
    
              <div class="col-lg-4 col-md-6 mb-5">
                <div class="product-item">
                  <figure>
                    <a href="{{ route('event.show',$event->slug) }}"><img src="{{ asset('images/events/'. $event->image) }}" alt="Image" title="{{ $event->name }}" class="img-fluid" style="height:220px"></a>
                  </figure>
                  <div class="px-4">
                    <h4><a href="{{ route('event.show',$event->slug) }}">{{ $event->name }}</a></h4>
                    <p class="mb-4">Date de l'évenement : {{ \Carbon\Carbon::parse($event->date)->toFormattedDateString() }}</p>
                    
                    <div class="mb-4"> 
                    <div class="price">{{ Str::words($event->description,20,' . . .') }}</div>
                    </div>
                    <div>
                      <a href="{{ route('event.show',$event->slug) }}" class="btn btn-black mr-1 rounded-0">En savoir plus</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
                 <!-- Pagination-->
          <div class="row d-flex justify-content-center">
            {{ $events->links() }}
          </div>

      @else
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <div class="clearfix">
                <img src="{{asset('images/error_content/icon_Sad.png')}}" class="img-fluid pull-left mr-3 ml-2" alt="Icon" style="height:150px">
                <h3 class="display-5"> Désolé, il n'y a aucun évenement corespondant à votre recherche .</h3>
                <p class="lead"> Rester connecté pour être infromé sur d'éventuels évenements.</p>
              </div>
            </div>
          </div>      
      @endif
      
    </div>
  </div>

@endsection