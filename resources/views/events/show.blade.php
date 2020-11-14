@extends('layouts.app')

@section('content')


<div class="site-section bg-light">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6 text-center">
            <h2 class="section-title mb-3">Détail de l'évenement</h2>
            <p>Cet évenement vous intéresse et vous voulez y participez ? <br> N'attendez plus et inscrivez-vous dés maintenant !</p>
            </div>
        </div>

        <div class="bg-white py-4 mb-4">
            <div class="row mx-4 my-4 product-item-2 align-items-start">
                <div class="col-md-6 mb-5 mb-md-0">
                    <img src="{{ asset('images/events/'. $event->image) }}" alt="Image" class="img-fluid">
                </div>
            
                <div class="col-md-5 ml-auto product-title-wrap">
                    <span class="number">Event</span>
                    <h3 class="text-black mb-4 font-weight-bold">{{ $event->name }}</h3>
                    <h5 class="text-black font-weight-bold h6">Date : {{ \Carbon\Carbon::parse($event->date)->toFormattedDateString() }}</h5>
                    <p class="mb-4">{{ $event->description }}</p>
                    
                    <div class="mb-4"> 
                    <div class="price text-danger">Place(s) restante : <span> {{ $event->nbrPlaces }} </span></div>
                    </div>

                    <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block">Je m'inscris</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>



@endsection
