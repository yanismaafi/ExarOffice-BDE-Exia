@extends('layouts.app')

@section('content')

<div class="site-section" id="product-section">
    <div class="container">
        <div class="container emp-profile mt-5">

            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                <i class="fa fa-check"> </i>  {{ session()->get('success') }}
                </div>
            @endif
            
            <form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            @if ( Empty($user->profile_picture) )
                              <img src="{{ asset('images/users/default_picture.png') }}" alt="Default picture"/>
                            @else
                              <img src="{{ asset('images/users/'.$user->profile_picture) }}" alt="Photo de profile"/>
                            @endif
                            <div class="file btn btn-lg btn-primary">
                                Changer la photo
                                <input type="file" name="image"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{ $user->name }}
                            </h5>
                            <h6>
                                Etudiant au Cesi centre d'Alger
                            </h6>
                            <p class="badge badge-primary"> Status : <span>{{ $user->role }}</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">A propos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Editer </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Ma Bio :</p>
                          <textarea name="bio" id="" cols="30" rows="4">{{ $user->bio }}</textarea>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>ID utilisateur :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $user->id }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nom :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="profile-input"  value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>E-mail :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="email" class="profile-input" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Cycle :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="cycle" class="profile-input"  value="{{ $user->cycle }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date de création :</label>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $user->created_at }}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>           
        </div>
        
    </div>
</div>
@endsection