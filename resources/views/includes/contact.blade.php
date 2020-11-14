
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
                    
                    
                    
                    <form action="{{ route('home.contact') }}" method="POST" id="contactForm" class="p-5">
                        @csrf 
                        <h2 class="section-title text-white font-weight-bold mb-5"> <u> Votre message :</u></h2> 
                        
                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-white font-weight-bold" for="fname">Nom :</label>
                                <input type="text" id="lname" name="lname"  class="form-control rounded-0">
                            </div>
                            <div class="col-md-6">
                                <label class="text-white font-weight-bold" for="lname">Prenom :</label>
                                <input type="text" id="fname" name="fname" class="form-control rounded-0">
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            
                            <div class="col-md-12">
                                <label class="text-white font-weight-bold" for="email">Email :</label> 
                                <input type="email" id="email" name="email" class="form-control rounded-0">
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            
                            <div class="col-md-12">
                                <label class="text-white font-weight-bold" for="subject">Sujet :</label> 
                                <input type="subject" id="subject" name="subject" class="form-control rounded-0">
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-white font-weight-bold" for="message">Message :</label> 
                                <textarea name="message" id="message" cols="30" rows="7" class="form-control rounded-0" placeholder="Tapez votre message ou votre question ..."></textarea>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-white py-3 px-5 rounded-2 mb-lg-0 mb-2 d-block noHover" style="">
                                    <i class="fa fa-send"></i> Envoyer
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                
            </div>
            
        </div>
    </div>
    
    <script>

        const form = document.getElementById('contactForm');
       
        form.addEventListener('submit',function(e){
            e.preventDefault();

            const token = document.querySelector('meta[name="csrf-token"]').content;
            const url = this.getAttribute('action');

            fetch(url, {

                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": token
                },
                method: 'POST',

                body: JSON.stringify({

                    lname: document.querySelector('#lname').value,
                    fname: document.querySelector('#fname').value,
                    email: document.querySelector('#email').value,
                    subject: document.querySelector('#subject').value,
                    message: document.querySelector('#message').value
                })

            })
            .then(response => {
                  
                if(response.ok)
                {
                  
                  clearErrors()
                  this.reset()
                  
                  this.insertAdjacentHTML('afterend', '<div class="alert alert-success" id="success"><i class="fa fa-check"></i> Votre message a été envoyé avec succès.</div>')
                  document.getElementById('success').scrollIntoView()

                }else if (response.status == 422)
                {
                    response.json().then(errors =>{
                    
                         const firstItem = Object.keys(errors.errors)[0];
                         const firstItemDom = document.getElementById(firstItem);
                         const errorMessage = errors.errors[firstItem][0];
                         
                         firstItemDom.scrollIntoView();
                         clearErrors();

                         document.querySelector('[name="' + firstItem + '"]').classList.add('is-invalid');
                         firstItemDom.insertAdjacentHTML('afterend', `<span class="invalid-feedback" role="alert"> <strong>${errorMessage}</strong>`);

                         console.log(errorMessage);
                    })
                }

            });

            function clearErrors() {
                // remove all error messages
                const errorMessages = document.querySelectorAll('.invalid-feedback')
                errorMessages.forEach((element) => element.textContent = '')
                // remove all form controls with highlighted error text box
                const formControls = document.querySelectorAll('.form-control')
                formControls.forEach((element) => element.classList.remove('border', 'is-invalid'))
            }

        });

    </script>