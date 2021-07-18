@extends('layouts.app')

@section('content')

    <div class="site-section bg-light">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                   <h2 class="section-title mb-3"> Modifier l'évenement :</h2>
                </div>
                <div class="container">
                    @if (session('success_msg'))
                        <div class="alert alert-success">
                            {{ session('success_msg') }}
                        </div>
                    @endif
                </div>
            </div>

                <div class="bg-white py-4 mb-4">
                    <div class="row mx-4 my-4 product-item-2 align-items-start">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/'. $event->image) }}" alt="Image" class="img-fluid">
                        </div>
                
                        <div class="col-md-6 ml-auto product-title-wrap">
                        
                            <form method="POST" action="{{ route('event.update', $event->id) }}" autocomplete="off" is-dynamic-form>
                            @csrf
                            @method('PUT')
                            
                                <div class="col-md-12 mb-3 mb-md-0 mt-2">
                                    <label class="text-black" for="name">Nom de l'évenement :</label>
                                    <input type="text" name="name" id="name" class="form-control rounded-0" value="{{ $event->name }}">     
                                    <div class="invalid-feedback name-error"></div>                                                                   
                                </div>
                            
                                <div class="col-md-12 mt-2">
                                    <label class="text-black" for="date">Date de l'évenement :</label>
                                    <input type="date" name="date" id="date" class="form-control rounded-0" value="{{ $event->date }}"> 
                                    <div class="invalid-feedback date-error"></div>                                                                   
                                </div>
                            
                                <div class="col-md-12 mt-2">
                                    <label class="text-black" for="nbrPlaces">Nombre de place :</label> 
                                    <input type="text" name="nbrPlaces" id="nbrPlaces" class="form-control rounded-0" value="{{ $event->nbrPlaces }}">       
                                    <div class="invalid-feedback nbrPlaces-error"></div>                                                                   
                                </div><br>
                                
                                <div class="col-md-12">
                                    <label class="text-black" for="file">Image de l'évènement :</label> 
                                    <input class="form-control" type="file" name="image" id="image" value="{{ $event->image }}">  
                                    <div class="invalid-feedback image-error"></div>                                                                          
                                </div><br>
                                
                                <div class="col-md-12 mt-2">
                                    <label class="text-black" for="description">Description :</label> 
                                    <textarea class="form-control rounded-0" name="description" id="description" cols="30" rows="5">{{ $event->description }}</textarea>     
                                    <div class="invalid-feedback description-error"></div>                                                                   
                                </div><br>
                            
                                <!-- Submit button-->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block"><i class="fa fa-edit fa-x2"></i> Modifier l'évenement</button>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">

        function redirectToEventList() {
            var url = '{{ route("admin.event") }}';
            $(location).attr('href', url);
        }
</script>
    
@endsection