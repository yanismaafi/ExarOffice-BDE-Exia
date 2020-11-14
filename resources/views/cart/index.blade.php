@extends('layouts.app')

@section('content')

@if (session()->has('success'))
   <div class="alert alert-success" role="alert">
     <i class="fa fa-check"> </i>  {{ session()->get('success') }}
   </div>
@endif

@if (Cart::count() > 0)
    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5" style="margin-top:100px">
                
                <button class="emptyCart btn btn-danger mb-3"><i class="fa fa-trash fa-lg"></i> Vider le panier</button>

                <!-- Shopping cart table -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Produit</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Prix</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Quantité</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 text-uppercase">Supprimer</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach (Cart::content() as $product)
                                
                                <tr id="info_row_{{ $product->rowId }}">

                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                        <img src="{{ asset('images/products/'.$product->model->image) }}" alt="image" width="70" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0"> 
                                                <a href="{{ route('product.show',$product->model->slug) }}">{{ $product->model->title }}</a>
                                            </h5>
                                            <span class="text-muted font-weight-normal font-italic d-block">Catégorie: <strong class="font-weight-bold"> {{ $product->model->category->name }}</strong> </span>
                                        </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>{{ $product->model->price }}</strong> <b>DA</b></td>
                                    <td class="border-0 align-middle"><strong>{{ $product->qty }}</strong></td>
                                    <td class="border-0 align-middle">

                                        <form action="{{ route('cart.destroy',$product->rowId) }}" method="POST">
                                            @csrf  

                                            <input type="hidden" name="cart_id" value="{{ $product->rowId }}">
                                            <input type="hidden" name="qty" value="{{ $product->qty }}">
                                            <button type="submit" class="delete btn btn-dark" value="{{ $product->rowId }}"><i class="fa fa-trash fa-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- End -->
                </div>
            </div>

            <div class="row py-5 p-4 bg-white rounded shadow-sm">
                <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Code Promo</div>
                <div class="p-4">
                    <p class="font-italic mb-4">Si vous avez un code promo, veuillez le saisir dans la case ci-dessous</p>
                    <div class="input-group mb-4 border rounded-pill p-2">
                    <input type="text" placeholder="Tapez le code promo" aria-describedby="button-addon3" class="form-control border-0">
                    <div class="input-group-append border-0">
                        <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer mon code</button>
                    </div>
                    </div>
                </div>
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
                <div class="p-4">
                    <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
                    <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détails de la commande </div>
                <div class="p-4">
                    <p class="font-italic mb-4">Le payement s'effectuera à la livraison.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total </strong><strong>{{ Cart::subtotal()}} DA.</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>20 %</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                            <h5 class="font-weight-bold">{{ Cart::total() }}  DA.</h5>
                        </li>
                    </ul>
                
                    <form action="{{ route('cart.order') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary rounded-pill py-2 btn-block">Je valide ma commande !</button>
                    </form>
                </div>
                </div>
            </div>

            </div>
        </div>
    </div>
@else
 
    <div class="site-section bg-light">
        <div class="jumbotron jumbotron-fluid" style="height:520px">
            <div class="container">
                <div class="clearfix mt-5">
                    <img src="{{asset('images/error_content/empty_cart.png')}}" class="img-fluid pull-left mr-3 ml-2" alt="Icon" style="height:150px">
                    <h3 class="display-4">Votre panier est vide ...</h3>
                </div>
            </div>
        </div>  
    </div>    
@endif

<script type="text/javascript">

     $(".delete").on('click',function(e){

        e.preventDefault();

        var id = $(this).val();
        var qty = $("input[name=qty]").val();
        var countCart = parseInt($(".badge").html());
       

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            type: 'DELETE',
            url: '/panier/'+id,
            typeData:'JSON',

            success:function(data)
            {
               if(data == 'deleted')
               {
                    $('#info_row_' + id).fadeOut(300, function() { $(this).remove(); });

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'produit supprimé du panier'
                    })

                    countCart-=qty;
                    $(".badge").html(countCart);
               }
            },

            error:function(data)
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                
                Toast.fire({
                    icon: 'error',
                    title: 'Erreur lors de la suppréssion'
                })
            }   

        });

     });

</script>
  
@endsection