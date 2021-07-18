@extends('layouts.app')

@section('content')

<div class="site-section bg-light">
    <div class="container">
        
        <div class="row">
            
            <!-- Post Content Column -->
            <div class="col-lg-8">
                
                <!-- Title -->
                <h2 class="mt-4">{{ $post->title }}</h2>
                
                <!-- Author -->
                <p> Auteur : <a href="#">{{ $post->author }}</a> </p>
                <hr>
                
                <!-- Date/Time -->
                <p>Posté le : {{ \Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</p>
                <hr>
                
                <!-- Preview Image -->
                <img class="img-fluid rounded" src="{{ asset('storage/'. $post->image) }}" alt="Image">
                <hr>
                
                <!-- Post Content -->
                <h4><span class="badge badge-secondary">{{ $post->theme }}</span></h4>
                
                <blockquote class="blockquote">
                    <p class="mb-0">{{ $post->content }}</p><br>
                    <footer class="blockquote-footer">Auteur de l'article
                        <cite title="Source Title">{{$post->author}}</cite>
                    </footer>
                </blockquote><br>
                <hr>
                <p class="lead"> Commentaires &nbsp;
                    <span id="count"> {{ $post->comments->count() }}</span>
                </p>
                
                <!-- Comments -->
                <div class="comments">
                    
                    @foreach ($post->comments as $comment)
                    
                    <!-- Single Comment -->
                    <div class="media mb-4">
                        @if (empty($comment->user->profile_picture))
                        <img class="d-flex mr-3 rounded-circle" src="{{ asset('images/users/default_picture.png') }}" height="50px" alt="Commenter_Image" title="{{ $comment->user->name }}">
                        @else
                        <img class="d-flex mr-3 rounded-circle" src="{{ asset('images/users/'. $comment->user->profile_picture) }}" height="50px" alt="Commenter_Image">
                        @endif
                        <div class="media-body">
                            <h5 class="mt-0">{{ $comment->user->name  }}</h5>
                            {{ $comment->content }}
                        </div>
                    </div> <!-- End Single Comment -->
                    @endforeach
                    
                </div><!-- End Comments -->
                
                
                
                <!-- Comments Form -->
                
                <div class="card my-4">
                    <h5 class="card-header">Laissez un commentaire :</h5>
                    <div class="card-body">
                        <form method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="content" rows="3" ></textarea>
                                <span id="error_msg" class="invalid-feedback"></span>
                            </div>
                            <button data-post="{{ $post->id }}" class="comment btn btn-primary">Envoyer</button>   
                        </form>    
                        
                    </div>
                </div> <!-- End Comments Form -->
                    
                
            </div> <!-- End Post -->
            
            
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                
                <!-- Add Post Button -->
                <div class="my-4">
                    <a href="{{ route('blog.create') }}" class="btn btn-black mt-3 rounded-0 "><i class="fa fa-plus"></i> Publier un post</a>
                </div>
                
                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Etudes</a>
                                    </li>
                                    <li>
                                        <a href="#">Loisirs</a>
                                    </li>
                                    <li>
                                        <a href="#">Sorties</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Formations</a>
                                    </li>
                                    <li>
                                        <a href="#">Hackathons</a>
                                    </li>
                                    <li>
                                        <a href="#">Evenements</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header"> Boutique du BDE </h5>
                    <div class="card-body">
                        Le bureau des éleves du centre d'Alger "ExarOffice" met à disposition un ensemble de Goodies et d'accéssoirs à prix raisonable, profitez-en !            
                        <a href="{{ route('product.index') }}" class="btn btn-black mt-3 rounded-4 d-block"> Voir les produits </a>
                    </div>
                </div> <!-- End Side Widget -->
                
            </div><!-- End Sidebar Widgets Column -->
            
        </div>
        <!-- /.row -->
        
    </div>
    <!-- /.container -->
</div>



<script type="text/javascript">
    
    $(".comment").on('click',function(e) {
        
        e.preventDefault();
        
        var content = $("textarea[name=content]").val();
        var post_id = $(this).data('post');
        var profile_picture = $("#profile_picture").attr('src')
        var sendEffect= $(this);
        var countComment = parseInt($("#count").html());


        $('textarea[name=content]').removeClass('is-invalid'); 
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            
            type:'POST',
            url:"{{ route('blog.comment') }}",
            dataType:'JSON',
            data:{ content: content, post_id: post_id },
            
            beforeSend:function(){
                sendEffect.text('Envoi...').addClass('disabled');
            },
            
            success:function(data) {
                
                if(data == 'sent') {

                    $('textarea').val('');
                    
                    var html = '<div class="media mb-4">\
                                  <img id="picture" class="d-flex mr-3 rounded-circle" src="{{ asset('images/users/default_picture.png') }}" height="50px"  alt="Commenter">\
                                  <div class="media-body">\
                                  <h5 class="mt-0"> {{ auth::user()->name }}</h5>'+ strip_tags(content) +'<div>\
                                <div>';
                                    
                    $(".comments").prepend(html);
                    $("#picture").prop("src", profile_picture); 
                    $(".content").val('');
                    sendEffect.text('Envoyer').removeClass('disabled');    
                    
                    countComment++;   //increase nbr of comment
                    $("#count").html(countComment);                                    
                 }                          
            },
                            
            error:function (data) {
                if(data.status == 422) {
                    $('textarea[name=content]').addClass("is-invalid"); 
                    $('#error_msg').text(data.responseJSON.errors.content); 
                    sendEffect.text('Envoyer').removeClass('disabled');      
 
                }
            },                            
        });                      
    });

    function strip_tags(str) {
        str = str.toString();
        return str.replace(/<\/?[^>]+(>|$)/g, "");
    }

</script>
                
                
@endsection