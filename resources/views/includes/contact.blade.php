
<div class="site-section bg-light" id="contact-section" style="background-image: url({{ asset('images/bde/CESI_Corporate_Presentation-1312x711.jpg')}}); background-attachment: fixed;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h3 class="text-black section-sub-title">Contacter le BDE</h3>
                <h2 class="section-title font-weight-bold mb-2">Écrivez-nous</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 mb-5">
                
                
                
                <form action="{{ route('home.contact') }}" method="POST" class="p-5" autocomplete="off" is-dynamic-form>
                @csrf 
                    <h2 class="section-title text-white font-weight-bold mb-5"> <u> Votre message :</u></h2> 
                    
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-white font-weight-bold" for="fname">Nom :</label>
                            <input type="text" id="lname" name="lname"  class="form-control rounded-0" required>
                            <div class="invalid-feedback lname-error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-white font-weight-bold" for="lname">Prenom :</label>
                            <input type="text" id="fname" name="fname" class="form-control rounded-0" required>
                            <div class="invalid-feedback fname-error"></div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        
                        <div class="col-md-12">
                            <label class="text-white font-weight-bold" for="email">Email :</label> 
                            <input type="email" id="email" name="email" class="form-control rounded-0" required>
                            <div class="invalid-feedback email-error"></div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        
                        <div class="col-md-12">
                            <label class="text-white font-weight-bold" for="subject">Sujet :</label> 
                            <input type="subject" id="subject" name="subject" class="form-control rounded-0" required>
                            <div class="invalid-feedback subject-error"></div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-white font-weight-bold" for="message">Message :</label> 
                            <textarea name="message" id="message" cols="30" rows="7" class="form-control rounded-0" placeholder="Tapez votre message ou votre question ..." required></textarea>
                            <div class="invalid-feedback message-error"></div>
                        </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" >
                                <i class="fa fa-send"></i> Envoyer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
        
    </div>
</div>



<script type="text/javascript">
    
    $("#submit").on('click',function(e){

        e.preventDefault();
        
        var fname = $("input[name=fname]").val();
        var lname = $("input[name=lname]").val();
        var email = $("input[name=email]").val();
        var subject = $("input[name=subject]").val();
        var message = $("textarea[name=message]").val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            
            type:'POST',
            url: "{{ route('home.contact') }}",
            typeData:'JSON',
            data:{ fname:fname, lname,lname, email:email, subject:subject, message:message },
            
            success:function(data)
            {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                
                if(data == "success")
                {
                    Toast.fire({
                        icon: 'success',
                        title: 'Votre message a été envoyé avec succès ! '
                    });   
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
                
                if(data.status == 422)
                {
                    Toast.fire({
                        icon: 'error',
                        title: 'Erreur lors de l\'envoie du message, veuillez réesayer.'
                     });
                }
            },
        });
           
    });
    
</script> 