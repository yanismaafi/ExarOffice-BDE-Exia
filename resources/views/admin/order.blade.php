@extends('layouts.app')

@section('content')

    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5" style="margin-top:100px">
                    <a href="" class="btn btn-primary mb-3"><i class="fa fa-list fa-lg"></i>  Listes des commandes :</a>
   
                    <!-- Order table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Client</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Date de commande</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Produit</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantité</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Prix</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($orders as $order)
                                   
                                     @php $products = unserialize($order->products) @endphp
                                      
                                     @foreach ($products as $product)

                                        <tr id="info_row_{{ $order->id }}">

                                            <th scope="row" class="border-0">
                                                <div class="p-2">
                                                    @if (empty($order->user->profile_picture))
                                                    <img src="{{ asset('images/users/default_picture.png') }}" alt="user image" width="70" class="img-fluid rounded shadow-sm" title="{{ $order->user->name }}">
                                                    @else
                                                    <img src="{{ asset('images/users/'.$order->user->profile_picture) }}" alt="user image" width="70" class="img-fluid rounded shadow-sm" title="{{ $order->user->name }}">
                                                    @endif
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0"> 
                                                            <a href="{{ route('user.edit',$order->user->id) }}">{{ $order->user->name }}</a>
                                                        </h5>
                                                        <span class="text-muted font-weight-normal font-italic d-block">Cycle: <strong class="font-weight-bold"> {{ $order->user->cycle }}</strong> </span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="border-0 align-middle"> <strong> {{ $order->created_at }}</strong><b></b></td>
                                            <td class="border-0 align-middle"><strong>{{ $product[0] }}</strong></td>
                                            <td class="border-0 align-middle"><strong>{{ $product[2] }}</strong></td>
                                            <td class="border-0 align-middle"><strong>{{ $product[1] }} DA.</strong></td>

                                        </tr>
                                         
                                     @endforeach
                                    
                                  
                                @endforeach

                            </tbody>
                        </table><!-- End Order Table-->

                        <div class="row d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div> 
                    <!-- End -->

                </div>
            </div> 
        </div>
    </div>

@endsection
