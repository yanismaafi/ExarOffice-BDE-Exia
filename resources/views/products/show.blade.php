@extends('layouts.app')

@section('content')


<div class="site-section bg-light">
    <div class="container">
      <div class="row mt-5 justify-content-center">
        <div class="col-md-6 text-center">
          <h2 class="section-title mb-3">Détail du produit</h2>
          <p> Vous pouvez commander le produit dès maintenant et le recevoir en quelques jours seulement, profitez-en ! </p>
        </div>
      </div>

  <div class="bg-white py-4 mb-4">
     <div class="row mx-4 my-4 product-item-2 align-items-start">
        <div class="col-md-6 mb-5 mb-md-0">
            <img src="{{ asset('images/products/'.$product->image)}}" alt="Image" class="img-fluid">
        </div>
     
        <div class="col-md-5 ml-auto product-title-wrap">
            <span class="number">01.</span>
            <h3 class="text-black mb-4 font-weight-bold">{{ ucfirst($product->title) }}</h3>
            <p class="mb-4 font-weight-bold"> <strong class="text-black">Catégorie : </strong> {{ ucfirst($product->category->name) }}</p>
            <p class="mb-4">{{ $product->description }}</p>

           

            <div class="mb-4"> 
              <h3 class="price font-weight-bold h5"> 
                <strong class="text-black"> Quantité :</strong>           
                <input type="number" name="qty" value="1" min="1" max="20" step="1" style="width:60px">
              </h3> 
            </div>


            <div class="mb-4"> 
              <h3 class="price font-weight-bold h5"> 
                <strong class="text-black"> Prix :</strong> {{ $product->price }} DA
              </h3> 
            </div>

            <form action="{{ route('cart.store') }}" method="POST">
            @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button id="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block">Ajouter au panier</button>
            </form>
        </div>
    </div>
  </div>


  <script type="text/javascript">

      $("#submit").on('click',function(e){
    
          e.preventDefault();

          var product_id = $("input[name=product_id]").val();
          var qty = $("input[name=qty]").val();
          var countCart = parseInt($(".badge").html());

          $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
          });

          $.ajax({

            type:'POST',
            url: "{{ route('cart.store') }}",
            typeData:'JSON',
            data:{ product_id:product_id, qty:qty },

              success:function(data)
              {
                  if(data == "added")
                  {
                        const Toast = Swal.mixin({
                          toast: true,
                          position: 'bottom-end',
                          showConfirmButton: false,
                          timer: 3000
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Produit ajouté au panier'
                        }),
                      
                        countCart=countCart+ parseInt(qty);
                        $(".badge").html(countCart);

                  }else if( data == "duplicated")
                         {
                              const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000
                              });

                            Toast.fire({
                                icon: 'info',
                                title: 'Le produit a déja été ajouté au panier'
                            })

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
                      title: 'Erreur lors de l\'ajout'
                  })
              },
             
          });
    
      });
    
    </script>

@endsection



