@extends('layouts.app')
@section('content')

  <div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
            <h2 class="section-title mb-3">Détail de l'évenement</h2>
            <p>Cet évenement vous intéresse et vous voulez y participez ? <br> N'attendez plus et inscrivez-vous dés maintenant !</p>
            </div>
        </div>

        <div class="bg-white py-4 mb-4">
            <div class="row mx-4 my-4 product-item-2 align-items-start">
                <div class="col-md-6 mb-5 mb-md-0">
                    <img src="{{ asset('storage/'. $event->image) }}" alt="Image" class="img-fluid">
                </div>
            
                <div class="col-md-5 ml-auto product-title-wrap">
                    <span class="number">Event</span>
                    <h3 class="text-black mb-4 font-weight-bold">{{ $event->name }}</h3>
                    <h5 class="text-black font-weight-bold h6">Date : {{ \Carbon\Carbon::parse($event->date)->toFormattedDateString() }}</h5>
                    <p class="mb-4">{{ $event->description }}</p>
                    
                    <div class="mb-4"> 
                    <div class="price text-danger">Place(s) restante : {{ $event->nbrPlaces }} </div>
                    </div>

                    <form method="POST">
                    @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button id="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block">Je m'inscris</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Other Event -->
        <div class="row mt-1 justify-content-center">
            <div class="col-md-6 text-center">
              <h2 class="section-title mb-1">Autres évènement</h2>
              <p>Les évènements à venir à ne pas rater</p>

            </div>
        </div>

        <div class="row">

          @foreach ($otherEvents as $event)
  
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="product-item">
                <figure>
                  <a href="{{ route('event.show',$event->id) }}"><img src="{{ asset('storage/'. $event->image) }}" alt="Image" title="{{ $event->name }}" class="img-fluid" style="height:220px"></a>
                </figure>
                <div class="px-4">
                  <h4><a href="{{ route('event.show',$event->id) }}">{{ $event->name }}</a></h4>
                  <p class="mb-4">Date de l'évenement : {{ \Carbon\Carbon::parse($event->date)->toFormattedDateString() }}</p>
                  
                  <div class="mb-4"> 
                  <div class="price">{{ Str::words($event->description,20,' . . .') }}</div>
                  </div>
                  <div>
                    <a href="{{ route('event.show',$event->id) }}" class="btn btn-black mr-1 rounded-0">En savoir plus</a>
                  </div>
                </div>
              </div>
            </div>
          
        @endforeach
        </div>
    </div>
  </div>

@endsection

