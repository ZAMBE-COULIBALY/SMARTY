

<form class="form" method="POST"  action="{{ isset($product) ? route('products.update',$product->slug) : route('products.add')}}">
    @csrf
    <div class="row form-group">
        <div class="form-group col-md-3">
            <div class="form-group">
                <label>Categorie</label>
                <select name="category" class="form-control select2bs4" style="width: 100%;">
                  @foreach ($categories as $item)
                    <option value={{$item->id}} {{ (isset($product) && $product->category->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                  @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-3">
            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control select2bs4" style="width: 100%;">
                  @foreach ($types as $item)
                    <option value="{{$item->id}}" {{ (isset($product) && $product->type->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                  @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-3">
            <div class="form-group">
                <label>Marque</label>
                <select name="label" class="form-control select2bs4" style="width: 100%;">
                  @foreach ($labels as $item)
                    <option value="{{$item->id}}" {{ (isset($product) && $product->label->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                  @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-3">
            <div class="form-group">
                <label>Modèle</label>
                <select name="model" class="form-control select2bs4" style="width: 100%;">
                  @foreach ($models as $item)
                    <option value="{{$item->id}}" {{ (isset($product) && $product->model->id == $item->id)? 'selected' : '' }}>{{$item->label}}</option>
                  @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="code">Code</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input {{ isset($product) ? "disabled" : ""}} type="text" class="form-control @error('Code') is-invalid @enderror" name="code" id="code" value="{{ isset($product) ? $product->code : '' }}" placeholder="Saisir le code du partenaire" required autocomplete="code" autofocus>

            </div>
            @error('Code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>




        <div class="form-group col-md-3">
            <label for="label">libelle</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ isset($product) ? $product->label : '' }}" placeholder="Saisir le libelle du partenaire" required autocomplete="name" >

            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="state" >Actif</label>
            <div class="input-group">
                <input type="checkbox" name="state" id="state" {{ (isset($product) && $product->state) ? 'checked' : ''}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        </div>


    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
