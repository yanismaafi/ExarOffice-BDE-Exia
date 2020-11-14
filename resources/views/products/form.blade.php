
        @csrf
        <div class="col-md-12 mb-3 mb-md-0">
            <label class="text-black" for="title">Nom du produit :</label>
            <input type="text" name="title" class="form-control rounded-0" value="{{ old('title',$product->title ?? '') }}">    
                <div  class="invalid-feedback"></div>  
        </div>

        <div class="col-md-12">
            <label class="text-black" for="subtitle">Sous-titre :</label>
            <input type="text" name="subtitle" class="form-control rounded-0" value="{{ old('subtitle',$product->subtitle ?? '') }}">
                <div class="invalid-feedback"> </div>  
        </div>

        <div class="col-md-12">
            <label class="text-black" for="stock">Quantité :</label> 
            <input type="text" name="stock" class="form-control rounded-0" value="{{ old('stock',$product->stock ?? '') }}">       
                <div class="invalid-feedback"> </div>  
        </div><br>

        <div class="col-md-12">
            <label class="text-black" for="price">Prix (unitaire) :</label> 
            <input type="text" name="price" placeholder="DA." class="form-control rounded-0" value="{{ old('price',$product->price ?? '') }}">
                <div class="invalid-feedback"></div>  
        </div><br>
    
        <div class="col-md-12">
            <label class="text-black" for="category_id">Catégorie :</label> 
            <select name="category_id" id="category_id" class="form-control rounded-0">
                <option selected>Séléctionner une catégorie</option>  
                @foreach ($categories as $category)                 
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach    
            </select>
                <div class="invalid-feedback"></div>  
        </div><br>

        <div class="col-md-12">
            <label class="text-black" >Séléctionner une image :</label> 
            <input type="file" name="image" class="btn btn-dark rounded-0 d-block d-lg-inline-block">
                <div class="invalid-feedback"></div>  
        </div><br>
        

        <div class="col-md-12">
            <label class="text-black" for="description">Description :</label> 
            <textarea class="form-control rounded-0" name="description" cols="30" rows="5">{{ old('description',$product->description ?? '') }}</textarea>   
                <div class="invalid-feedback"></div>     
        </div><br>
