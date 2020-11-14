@extends('layouts.app')

@section('content')

    <div class="site-section bg-light">
        <div class="container">
            <div class="row mt-5 justify-content-center">
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
                        
                            <form method="POST" id="postForm" enctype="multipart/form-data">
                            
                                @include('blog.form')

                                <div class="col-md-12">
                                   <button id="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block"><i class="fa fa-send"></i> Publier</button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>


<script type="text/javascript">   

    $("#submit").on('click',function(e){

        e.preventDefault();

        var title = $("input[name=title]").val();
        var theme = $("input[name=theme]").val();
        var content = $("textarea[name=content]").val();
        var image = $('input[name=image]')[0].files[0];

        var Data = new FormData($("#postForm")[0]);


       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $.ajax({
    
            type:'POST',
            url: "{{ route('blog.store') }}",
            typeData:'JSON',
            data:Data,
            processData: false,
            contentType: false,
            cache: false,
            
           success:function(data)
            {
                if(data == 'posted')
                {
                    Swal.fire({             
                        icon: 'success',
                        title: 'Contenu créé',
                        text: 'Votre contenu a été ajouté avec success !',
                    }),
                    
                /* Reset the input after success post */
                    $("input").val('');
                    $("textarea").val('');  

                }
            },
            
            error:function(data)
            {

                if(data.status == 422)
                {
                    $.each(data.responseJSON.errors, function (i, error) {
                        $("#postForm")
                            .find('*[name="' + i + '"]')
                            .addClass('is-invalid')
                            .next()
                            .append(error[0])
                    });  
                }
            },
        });
        
    });

</script>


@endsection

