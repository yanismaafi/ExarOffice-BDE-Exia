
        @csrf
        <div class="col-md-12 mb-3 mb-md-0">
            <label class="text-black" for="name">Nom de l'évenement</label>
            <input type="text" name="name" class="form-control rounded-0" value="{{ old('name',$event->name ?? '') }}">     
                <div id="name" class="invalid-feedback"></div>  
        </div>

        <div class="col-md-12">
            <label class="text-black" for="date">Date de l'évenement</label>
            <input type="date" name="date" class="form-control rounded-0" value="{{ old('date',$event->date ?? '') }}"> 
                <div id="date" class="invalid-feedback"></div>  

        </div>

        <div class="col-md-12">
            <label class="text-black" for="nbrPlaces">Nombre de place</label> 
            <input type="text" name="nbrPlaces" class="form-control rounded-0" value="{{ old('nbrPlaces',$event->nbrPlaces ?? '') }}">       
                <div id="nbrPlaces" class="invalid-feedback"></div>  
        </div><br>
        
        
        <div class="col-md-12">
            <label class="text-black" for="file">Séléctionner une image :</label> 
            <input type="file" name="image" class="btn btn-dark rounded-0 d-block d-lg-inline-block">
                <div id="file" class="invalid-feedback"></div>  
        </div><br>
        

        <div class="col-md-12">
            <label class="text-black" for="description">Description</label> 
            <textarea class="form-control rounded-0" name="description"  cols="30" rows="5">{{ old('description',$event->description ?? '') }}</textarea>     
                <div id="description" class="invalid-feedback"></div>  
        </div><br>
