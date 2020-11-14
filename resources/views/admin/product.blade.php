@extends('layouts.app')

@section('content')

    <div class="pb-5">
          <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5" style="margin-top:100px">
                    <a href="{{ route('product.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus fa-sm"></i>  Ajouter un produit</a>
                  
                  @if ($products->count() > 0)
                      <!-- Products cart table -->
                      <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Produit</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Stock</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Prix (Unitaire)</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Action</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($products as $product)
                                    
                                    <tr id="info_row_{{ $product->id }}">

                                        <th scope="row" class="border-0">
                                            <div class="p-2">
                                            <img src="{{ asset('images/products/'.$product->image) }}" alt="image event" width="70" class="img-fluid rounded shadow-sm" title="{{ $product->title }}">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> 
                                                    <a href="{{ route('product.show',$product->slug) }}">{{ $product->title }}</a>
                                                </h5>
                                                <span class="text-muted font-weight-normal font-italic d-block">Catégorie: <strong class="font-weight-bold"> {{ $product->category->name }}</strong> </span>
                                            </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle"><strong>{{ $product->stock }}</strong><b></b></td>
                                        <td class="border-0 align-middle"><strong>{{ $product->price }} DA.</strong></td>
                                        <td class="border-0 align-middle">

                                          <a href="{{ route('product.edit',$product->slug) }}" class="btn btn-primary fa-lg"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="delete btn btn-danger fa-lg" value="{{ $product->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="row d-flex justify-content-center">
                          {{ $products->links() }}
                        </div>
                    </div>
                    <!-- End -->

                  @else
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <div class="clearfix">
                            <img src="{{asset('images/error_content/icon_Sad.png')}}" class="img-fluid pull-left mr-3 ml-2" alt="Icon" style="height:150px">
                            <h3 class="display-5"> Il n'y a aucun produit en la base de donnée.</h3>
                            <h5> Voulez-vous ajouter un produit ? --> <a href="{{ route('product.create') }}">Ajouter un produit</a></h5>

                        </div>
                        </div>
                    </div>          
                  @endif
                </div>
            </div>
          </div>
    </div>



<script type="text/javascript">
  
  $(".delete").on('click',function(e){
    
    var id = $(this).val();
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({

      type: 'DELETE',
      url: "/admin/produit/"+ id,
      typeData: 'JSON',

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
                  title: 'Produit supprimé'
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
              title: 'Erreur lors de la suppréssion'
          })
      }

   });
   
  });
  
  
</script>


@endsection