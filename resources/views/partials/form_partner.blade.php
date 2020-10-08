

<form class="form" method="POST"  action="{{ isset($partner) ? route('partners.update',$partner->slug) : route('partners.add')}}">
    @csrf
    <div class="row form-group">
          <div class="form-group col-md-3">
            <label for="code">Code</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input {{ isset($partner) ? "disabled" : ""}} type="text" class="form-control @error('Code') is-invalid @enderror" name="code" id="code" value="{{ isset($partner) ? $partner->code : '' }}" placeholder="Saisir le code du partenaire" required autocomplete="code" autofocus>

            </div>
            @error('Code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>




        <div class="form-group col-md-5">
            <label for="label">libelle</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" value="{{ isset($partner) ? $partner->label : '' }}" placeholder="Saisir le libelle du partenaire" required autocomplete="label" >

            </div>
            @error('label')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

         <div class="form-group col-md-4">
            <label for="email">Email</label>
            <div class="input-group">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ isset($partner) ? $partner->email : '' }}" placeholder="Saisir le libelle du partenaire" required autocomplete="email" autofocus>

            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-md-3">
            <label for="contact">contact</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                <input type="text"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ isset($partner) ? $partner->contact : '' }}" required data-mask>

            </div>
            @error('contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <div class="input-group">
                <label>MODE DE PAIEMENT</label>
                <select name="paymode" id="paymode" class="form-control  @error('paymode') is-invalid @enderror select2bs4NE" style="width: 100%;">
                    <option value=1 {{ (isset($partner) && $partner->paymode == 1)? 'selected' : '' }}>MOBILE BANKING</option>
                    <option value=2 {{ (isset($partner) && $partner->paymode == 2)? 'selected' : '' }}>CAISSE</option>
                </select>
                @error('asstyp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="form-group col-md-6">
            <label>Categories</label>
            <div class="select2-primary">

                <select name='category[]' class="form-control select2" multiple="multiple" data-dropdown-css-class="select2-primary" data-placeholder="Sélectionner les categories" style="width: 100%;" required>
                    @foreach ($categories as $item)
                        <option value={{ $item->code }}  {{ (isset($partner) && $partner->hasCategory($item->code)) ? 'selected' : ''}}>{{$item->label}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group col-md-6">
            <label for="state" >Actif</label>
            <div class="input-group">
                <input type="checkbox" name="state" id="state" {{ isset($partner) ? (($partner->state) ? 'checked' : '') : 'checked'}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        </div>


    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
