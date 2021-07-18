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
                            <img src="{{ asset('storage/'.$product->image) }}" alt="Image" class="img-fluid">
                        </div>
                
                        <div class="col-md-6 ml-auto product-title-wrap">
                        
                            <form action="{{ route('product.update', $product->id) }}" method="POST" is-dynamic-form>
                            @csrf
                            @method('PUT')
                                
                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black" for="title">Nom du produit :</label>
                                    <input type="text" name="title" class="form-control rounded-0" value="{{ $product->title }}">    
                                        <div  class="invalid-feedback title-error"></div>  
                                </div>
                            
                                <div class="col-md-12">
                                    <label class="text-black" for="subtitle">Sous-titre :</label>
                                    <input type="text" name="subtitle" class="form-control rounded-0" value="{{ $product->subtitle }}">
                                        <div class="invalid-feedback subtitle-error"> </div>  
                                </div>
                            
                                <div class="col-md-12">
                                    <label class="text-black" for="stock">Quantité :</label> 
                                    <input type="text" name="stock" id="stock" class="form-control rounded-0" value="{{ $product->stock }}">       
                                        <div class="invalid-feedback stock-error"> </div>  
                                </div><br>
                            
                                <div class="col-md-12">
                                    <label class="text-black" for="price">Prix (unitaire) :</label> 
                                    <input type="text" name="price" placeholder="DA." class="form-control rounded-0" value="{{ $product->price }}">
                                        <div class="invalid-feedback price-error"></div>  
                                </div><br>
                            
                                <div class="col-md-12">
                                    <label class="text-black" for="category_id">Catégorie :</label> 
                                    <select name="category_id" id="category_id" class="form-control rounded-0">
                                        <option selected>Séléctionner une catégorie</option>  
                                        
                                        @foreach ($categories as $category)  
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach    
                            
                                    </select>
                                        <div class="invalid-feedback category_id-error"></div>  
                                </div><br>
                            
                                <div class="col-md-12">
                                    <label class="text-black" >Séléctionner une image :</label> 
                                    <input type="file" name="image" id="image" class="btn btn-dark rounded-0 d-block d-lg-inline-block">
                                        <div class="invalid-feedback image-error"></div>  
                                </div><br>
                                
                            
                                <div class="col-md-12">
                                    <label class="text-black" for="description">Description :</label> 
                                    <textarea class="form-control rounded-0" name="description" cols="30" rows="5">{{ old('description',$product->description ?? '') }}</textarea>   
                                        <div class="invalid-feedback description-error"></div>     
                                </div><br>
                            
                                <div class="col-md-12">
                                    <button id="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block"><i class="fa fa-edit"></i> Modifier le produit</button>
                                </div>
                            
                            </form>
                                
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

<script type="text/javascript">

    function redirectToProductList() {
        var url = '{{ route("admin.product") }}';
        $(location).attr('href', url);
    }

</script>

@endsection

