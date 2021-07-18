@extends('layouts.app')

@section('content')

    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                   <h2 class="section-title mb-3">Ajouter un post :</h2>
                </div>
            </div>

                <div class="bg-white py-4 mb-4">
                    <div class="row mx-4 my-4 product-item-2 align-items-start">
                        <div class="col-md-6 mb-0 mb-md-0">
                            <h3 class="section-title mb-3"> Exprimez-vous !</h3>
                            <img src="{{ asset('images/bde/Publish_Button.png') }}" alt="Image" class="img-fluid">
                        </div>
                
                        <div class="col-md-6 ml-auto product-title-wrap">
                        
                            <form action="{{ route('blog.store') }}" method="POST" autocomplete="off" is-dynamic-form>
                            @csrf

                                <div class="col-md-12 mb-3 mb-md-0">
                                    <label class="text-black" for="title">Titre du post :</label>
                                    <input type="text" name="title" id="title" class="form-control rounded-0 ">   
                                    <div class="invalid-feedback title-error"></div>                                                                   
                                </div>
                        
                                <div class="col-md-12">
                                    <label class="text-black" for="theme">Thème de votre poste :</label>
                                    <input type="text" name="theme" id="theme" class="form-control rounded-0">
                                    <div class="invalid-feedback theme-error"></div>                                                                   
                                </div>
                        
                                <div class="col-md-12">
                                    <label class="text-black" for="file">Séléctionner une image :</label> 
                                    <input type="file" name="image" id="image" class="btn btn-dark rounded-0 d-block d-lg-inline-block">
                                    <div class="invalid-feedback image-error"></div>                                                                   
                                </div><br>
                                
                                <div class="col-md-12">
                                    <label class="text-black" for="content">Contenu :</label> 
                                    <textarea name="content" id="content" class="form-control rounded-0 " cols="30" rows="5"></textarea> 
                                    <div class="invalid-feedback content-error"></div>                                                                   
                                </div><br>
                    
                                <div class="col-md-12">
                                   <button type="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block"><i class="fa fa-send"></i> Publier</button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

