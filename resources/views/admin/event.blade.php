@extends('layouts.app')

@section('content')

<div class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                <a href="{{ route('event.create') }}" class="emptyCart btn btn-primary mb-3"><i class="fa fa-plus fa-lg mr-1"></i>  Ajouter un évenement</a>

                @if ($events->count() > 0)
                    <!-- Event table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Evenement</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Places</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Description</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Action</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($events as $event)
                                    <tr id="info_row_{{ $event->id }}">
                                        <th scope="row" class="border-0">
                                            <div class="p-2">
                                            <img src="{{ asset('storage/'. $event->image) }}" alt="event image" width="70" class="img-fluid rounded shadow-sm" title="{{ $event->name }}">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> 
                                                    <a href="{{ route('event.show',$event->id) }}">{{ $event->name }}</a>
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Date: <strong class="font-weight-bold"> {{ $event->date }}</strong> </span>
                                            </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle"><strong>{{ $event->nbrPlaces }}</strong> <b>Place(s)</b></td>
                                        <td class="border-0 align-middle"><strong>{{ Str::words($event->description, 7, ' ...') }}</strong></td>
                                        <td class="border-0 align-middle">

                                            <div class="d-flex flex-row">
                                              
                                                <a href="{{ route('event.edit',$event->id) }}" class="btn btn-primary fa-lg"><i class="fa fa-edit"></i></a>

                                                <form action="{{ route('event.destroy',$event->id) }}" method="delete" is-dynamic-form>
                                                @csrf
                                                  <button href="{{ route('event.destroy',$event->id) }}" class="btn btn-danger fa-lg ml-1"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> <!-- End Table-->

                        <div class="row d-flex justify-content-center">
                            {{ $events->links() }}
                        </div>

                    </div>
                     <!-- End -->
                @else
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <div class="clearfix">
                            <img src="{{ asset('images/error_content/icon_Sad.png') }}" class="img-fluid pull-left mr-3 ml-2" alt="Icon" style="height:150px">
                            <h3 class="display-5"> Désolé, il n'y a aucun évenement prévu pour le moment.</h3>
                            <h5> Voulez-vous ajouter un évènement ? --> <a href="{{ route('event.create') }}">Ajouter un évenement</a></h5>
                        </div>
                        </div>
                    </div>    
                @endif
            </div>
        </div>
    </div>
</div>

@endsection