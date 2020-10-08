<form class="form" method="POST"  action="{{ isset($agency) ? route('agencies.update',$agency->slug) : route('agencies.add')}}">
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
                    <input type="text" {{ isset($agency) ? 'readonly' : '' }} class="form-control @error('Code') is-invalid @enderror" name="code" id="code" value="{{ isset($agency) ? $agency->code : '' }}" placeholder="Saisir le code du PDV" required autocomplete="code" autofocus>

                </div>
                @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>




        <div class="form-group col-md-6">
            <label for="label">Libelle</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label" value="{{ isset($agency) ? $agency->label : '' }}" placeholder="Saisir le libelle du PDV" required autocomplete="label" >

            </div>
            @error('label')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="address">Adresse</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ isset($agency) ? $agency->address : '' }}" placeholder="Saisir l'adresse du PDV" required autocomplete="address" >

            </div>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

         <div class="form-group col-md-6">
            <label for="email">Email</label>
            <div class="input-group">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ isset($agency) ? $agency->email : '' }}" placeholder="Saisir le libelle du PDV" autocomplete="email" autofocus>

            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-md-3">
            <label for="contact">Contact</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                <input type="text"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ isset($agency) ? $agency->contact : '' }}" required data-mask>

            </div>
            @error('contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="state" >Actif</label>
            <div class="input-group">
                <input type="checkbox" name="state" id="state" {{ (isset($agency) && $agency->state) ? 'checked' : ''}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        </div>


    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
