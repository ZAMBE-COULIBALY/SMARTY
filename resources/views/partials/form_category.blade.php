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
<<<<<<< HEAD
                    <input type="text" readonly class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ isset($category) ? $category->code : $code_category }}"  required autocomplete="code" autofocus>
=======
                    <input type="text" readonly class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ isset($category) ? $category->code : ([] != $errors->all()) ? old('code') : $code}}" placeholder="Saisir le code de la categorie" required autocomplete="code" autofocus>
>>>>>>> 794290092a8c7746e68fd4b89fc0e3a33981e7bb
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
                <input type="text" class="form-control @error('label') is-invalid @enderror" maxlength="30" name="label" id="label" value="{{ isset($category) ? $category->label : old('label') }}" placeholder="Saisir le libelle de la categorie" required autocomplete="label" >
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
                <select name="asstyp" id="asstyp" class="form-control  @error('asstyp') is-invalid @enderror select2bs4NE"  style="width: 100%;">
                <option value="0">Selectionnez</option>
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
<<<<<<< HEAD
                <label>TYPE DE DEGATS</label>
                <select name="clmtyp[]" id="clmtyp[]" multiple data-placeholder="Selectionnez un type de dégat" class="form-control  @error('clmtyp') is-invalid @enderror select2bs4NE" style="width: 100%;" >

                  @foreach ($clmtypes as $item)
=======
                <label>TYPE DE DEGATS </label> <span>. (Cliquez dans la zone pour sélectionner)</span>
                <select name="clmtyp[]" id="clmtyp[]" required placeholder="Sélectionner les dégâts" multiple class="form-control form-control-sm  @error('clmtyp') is-invalid @enderror select2bs4NE" style="width: 100%;">
                    <option disabled>Sélectionner les dégâts</option>

                    @foreach ($clmtypes as $item)
>>>>>>> 794290092a8c7746e68fd4b89fc0e3a33981e7bb
                    <option value="{{$item->code}}" {{ (isset($category) && $category->hasAttribute($item->code,"CLM-TYP"))? 'selected' : '' }}>{{$item->label}}</option>
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
    <button type="submit" class="btn btn-warning text-white" ><b>ENREGISTRER </b></button>
</form>
