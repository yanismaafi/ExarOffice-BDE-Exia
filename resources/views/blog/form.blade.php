        @csrf
        <div class="col-md-12 mb-3 mb-md-0">
            <label class="text-black" for="title">Titre du post :</label>
            <input type="text" name="title" class="form-control rounded-0 ">   
                <small name="error_title" class="text-danger"></small> 
        </div>

        <div class="col-md-12">
            <label class="text-black" for="theme">Thème de votre poste :</label>
            <input type="text" name="theme" class="form-control rounded-0">
                <small name="error_theme" class="text-danger"></small>  
        </div>


        <div class="col-md-12">
            <label class="text-black" for="file">Séléctionner une image :</label> 
            <input type="file" name="image" class="btn btn-dark rounded-0 d-block d-lg-inline-block">
            <small name="error_image" class="text-danger"></small>     
        </div><br>
        

        <div class="col-md-12">
            <label class="text-black" for="content">Contenu :</label> 
            <textarea name="content" class="form-control rounded-0 " cols="30" rows="5"></textarea> 
                <small name="error_content" class="text-danger"></small>  
        </div><br>
