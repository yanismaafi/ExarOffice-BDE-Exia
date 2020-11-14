@extends('layouts.app')

@section('content')

    <div class="site-section bg-light">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-6 text-center">
                <h2 class="section-title mb-3">Ajouter un évenement :</h2>
                </div>
            </div>

                <div class="bg-white py-4 mb-4">
                    <div class="row mx-4 my-4 product-item-2 align-items-start">
                        <div class="col-md-6 mb-0 mb-md-0">
                            <img src="{{ asset('images/events/event.png') }}" alt="Image" class="img-fluid">
                        </div>
                
                        <div class="col-md-6 ml-auto product-title-wrap">
                        
                            <form method="POST" enctype="multipart/form-data" id="eventForm">
                            
                                @include('events.form')

                                <div class="col-md-12">
                                   <button id="submit" class="btn btn-black rounded-0 d-block d-lg-inline-block"><i class="fa fa-plus"></i> Ajouter l'évenement</button>
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
    
            var name = $("input[name=name]").val();
            var date = $("input[name=date]").val();
            var nbrPlaces = $("input[name=nbrPlaces]").val();
            var description = $("textarea[name=description]").val();
            var image = $('input[name=image]')[0].files[0];
    
            var Data = new FormData($("#eventForm")[0]);
     
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
           $.ajax({
        
                type:'POST',
                url: "{{ route('event.store') }}",
                typeData:'JSON',
                data:Data,
                processData: false,
                contentType: false,
                cache: false,
                
               success:function(data)
                {
                    if(data == 'added')
                    {
                        Swal.fire({             
                            icon: 'success',
                            title: 'Evènement ajouté',
                            text: 'L\'évènement a été ajouté avec succèss !',
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
                            $("#eventForm")
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

