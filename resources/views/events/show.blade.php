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

                    <form method="POST">
                    @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button id="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block">Je m'inscris</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-6 text-center">
              <h2 class="section-title mb-1">Autres évènement</h2>
              <p>Les évènements à venir à ne pas rater</p>

            </div>
        </div>

        <div class="row">

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
    </div>
  </div>


  <script type="text/javascript">

      $("#submit").on('click',function(e){
      e.preventDefault();
  
      var eventId = $("input[name=event_id]").val();

     
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
        $.ajax({
  
          type:'POST',
          url: '/evenement/inscription/'+eventId,
          typeData:'JSON',
  
          
          success:function(data)
          {
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'bottom-end',
                  showConfirmButton: false,
                  timer: 3000
                });
             
              if(data == 'success')
              {
                Toast.fire({
                    icon: 'success',
                    title: 'Insription reussi, veuillez consulter vos mails.'
                })

              }else
              {
                Toast.fire({
                    icon: 'warning',
                    title: 'Vous étes déja inscris à cet évènement.'
                })
              }
          },
          
      });
      
  });
  
  </script>

@endsection

