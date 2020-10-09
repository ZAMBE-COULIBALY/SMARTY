<form class="form" method="POST"  action="{{ isset($category) ? route('category.update',$category->id) : route('category.add')}}">
    @csrf

    <div class="row form-group">
        <div class="row form-group  col-md-12">
            <div class="form-group">
                <label for="code">Code</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <input type="text" {{ isset($category) ? 'readonly' : '' }} class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ isset($category) ? $category->code : old('code') }}" placeholder="Saisir le code de la categorie" required autocomplete="code" autofocus>
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>
        </div>




        <div class="form-group col-md-4">
            <label for="label">Libelle</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" value="{{ isset($category) ? $category->label : old('label') }}" placeholder="Saisir le libelle de la categorie" required autocomplete="label" >
                @error('label')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>


        <div class="form-group col-md-3">
            <div class="input-group">
                <label>TYPE INDEMNISATION</label>
                <select name="asstyp" id="asstyp" class="form-control  @error('asstyp') is-invalid @enderror select2bs4NE" style="width: 100%;">
                  @foreach ($asstypes as $item)
                    <option value="{{$item->code}}" {{ (isset($category) && $item->code == $category->attribute("ASS-TYP"))? 'selected' : '' }}>{{$item->label}}</option>
                  @endforeach
                </select>
                @error('asstyp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="form-group col-md-5">
            <div class="input-group">
                <label>TYPE DE DEGATS</label>
                <select name="clmtyp[]" id="clmtyp[]" multiple class="form-control  @error('clmtyp') is-invalid @enderror select2bs4NE" style="width: 100%;">
                  @foreach ($clmtypes as $item)
                    <option value="{{$item->code}}" {{ (isset($type) && $type->hasAttribute($item->code,"CLM-TYP"))? 'selected' : '' }}>{{$item->label}}</option>
                  @endforeach
                </select>
                @error('clmtyp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
