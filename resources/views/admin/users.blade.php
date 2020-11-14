@extends('layouts.app')

@section('content')

    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5" style="margin-top:100px">
                    <a href="" class="btn btn-primary mb-3"><i class="fa fa-users fa-lg"></i> Listes des utilisateurs :</a>
   
                    <!-- Users table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Utilisateur</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">E-mail</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Statut</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Action</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($users as $user)
                                    
                                    <tr id="info_row_{{ $user->id }}">

                                        <th scope="row" class="border-0">
                                            <div class="p-2">
                                                @if (empty($user->profile_picture))
                                                  <img src="{{ asset('images/users/default_picture.png') }}" alt="user image" width="70" class="img-fluid rounded shadow-sm" title="{{ $user->name }}">
                                                @else
                                                  <img src="{{ asset('images/users/'.$user->profile_picture) }}" alt="user image" width="70" class="img-fluid rounded shadow-sm" title="{{ $user->name }}">
                                                @endif
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"> 
                                                        <a href="{{ route('user.edit',$user->id) }}">{{ $user->name }}</a>
                                                    </h5>
                                                    <span class="text-muted font-weight-normal font-italic d-block">Cycle: <strong class="font-weight-bold"> {{ $user->cycle }}</strong> </span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle"><strong>{{ $user->email }}</strong> <b></b></td>
                                        <td class="border-0 align-middle"><strong>@if ($user->role == 'Admin') <i class="fa fa-star" style="color:gold"></i> @endif {{ $user->role }}</strong></td>
                                        <td class="border-0 align-middle">

                                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-primary fa-lg"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="delete btn btn-danger fa-lg" value="{{ $user->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table><!-- End Users Table-->

                        <div class="row d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div> 
                    <!-- End -->

                </div>
            </div> 
        </div>
    </div>

@endsection
