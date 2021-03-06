

<form class="form" method="POST"  action="{{isset($intermediary) ? route('businessman.update',$intermediary->id)  : route('businessman.add') }}">
    @csrf
    <div class="row form-group">

        <div class="form-group col-xs-4 col-sm-4 col-lg-4 col-md-4">
            <label for="lastname">Nom</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('Nom') is-invalid @enderror" name="lastname" id="lastname" maxlength="30" value="{{ isset($intermediary) ? $intermediary->lastname : '' }}" placeholder="Saisir le nom du commercial" required autocomplete="lastname" autofocus>

            </div>
            @error('Nom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>




        <div class="form-group col-xs-6 col-sm-6 col-lg-6 col-md-6">
            <label for="firstname">Prenoms</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" maxlength="50" id="firstname" value="{{ isset($intermediary) ? $intermediary->firstname : '' }}" placeholder="Saisir le(s) prenom(s) du commercial" required autocomplete="firstname" >

            </div>
            @error('Prenoms')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group col-xs-4 col-sm-4 col-lg-4 col-md-4">
            <label for="email">Email</label>
            <div class="input-group">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" maxlength="45" name="email" id="email" value="{{ isset($intermediary) ? $intermediary->email : '' }}" placeholder="Saisir le l'email du commercial" autocomplete="email" >

            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-xs-3 col-sm-3 col-lg-3 col-md-3">
            <label for="contact">Contact</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                <input type="text"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ isset($intermediary) ? $intermediary->contact : '' }}" required data-mask>

            </div>
            @error('contact')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
    <button type="submit" class="btn btn-warning text-white" ><b>ENREGISTRER </b></button>
</form>
