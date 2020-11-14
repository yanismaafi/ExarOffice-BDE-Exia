@extends('layouts.app')

@section('content')

    <div class="site-section bg-light">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-6 text-center">
                <h2 class="section-title mb-3">Modifier le produit :</h2>
                </div>
            </div>

                <div class="bg-white py-4 mb-4">
                    <div class="row mx-4 my-4 product-item-2 align-items-start">
                        <div class="col-md-6 mb-0 mb-md-0">
                            <img src="{{ asset('images/products/'.$product->image) }}" alt="Image" class="img-fluid">
                        </div>
                
                        <div class="col-md-6 ml-auto product-title-wrap">
                        
                            <form action="{{ route('product.update',$product->slug) }}" method="POST" enctype="multipart/form-data">
                            
                                @include('products.form')

                                <div class="col-md-12">
                                   <button type="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block"><i class="fa fa-edit"></i> Modifier le produit</button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

