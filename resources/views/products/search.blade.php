@extends('layouts.app')

@section('content')

 
<div class="site-section" id="products-section">
    <div class="container">

      <div class="row mt-4 mb-2 justify-content-center">
        <div class="col-md-6 text-center">
          <h2 class="section-title mb-3">Boutique du BDE</h2>
          <p>Le bureau des éleves du centre d'Alger "ExarOffice" met à disposition un ensemble de Goodies et d'accéssoirs à prix raisonable, profitez-en !</p>
        </div>
      </div>


      @if ($products->count() > 0)
      
          <div class="row">

            <div class="col-md-12 mt-2">
              <form action="{{ route('product.search') }}" method="POST">
                 @include('includes.search')
              </form>
            </div>

            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 mb-5">
                  <div class="product-item">
                    <figure>
                    <img src="{{asset('images/products/'. $product->image) }}" alt="Image" style="height:250px" class="img-fluid">
                    </figure>
                    <div class="px-4">
                      <h3><a href="{{ route('product.show',$product->slug) }}">{{ $product->title }}</a></h3>
                      <p class="mb-4"> <strong> Catégorie :</strong> {{ $product->category->name }}</p>                
                      <div class="mb-4"> 
                      <div class="price"><strong class="text-black">{{ $product->price }} </strong> DA.</div>
                      </div>
                      <div>
                        <a href="{{ route('product.show',$product->slug) }}" class="btn btn-black mr-1 rounded-0">Voir l'article</a>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
          </div>

          <div class="row d-flex justify-content-center">
            {{ $products->links() }}
          </div>

      @else

          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <div class="clearfix">
                <img src="{{asset('images/error_content/icon_Sad.png')}}" class="img-fluid pull-left mr-3 ml-2" alt="Icon" style="height:150px">
                <h3 class="display-5"> Désolé, il n'y a aucun produit correspondant à votre recherche en vente.</h3>
                <p class="lead"> Rester connecté pour être infromé sur un éventuel arrivage.</p>
              </div>
            </div>
          </div>      

          
      @endif

    </div>
  </div>


 
    
@endsection