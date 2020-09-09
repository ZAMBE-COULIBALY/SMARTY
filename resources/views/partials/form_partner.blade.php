

<form class="form" method="POST"  action="{{ isset($partner) ? route('partners.update',$partner->slug) : route('partners.add')}}">
    @csrf
    <div class="row form-group">
          <div class="form-group col-md-4">
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




        <div class="form-group col-md-6">
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

         <div class="form-group col-md-6">
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

        <div class="form-group col-md-6">
            <label for="state" >Actif</label>
            <div class="input-group">
                <input type="checkbox" name="state" id="state" {{ (isset($partner) && $partner->state) ? 'checked' : ''}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        </div>


    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
