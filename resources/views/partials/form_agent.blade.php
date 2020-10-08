

<form class="form" method="POST"  action="{{isset($agent) ? route('agents.update',$agent->slug)  : route('agents.add') }}">
    @csrf
    <div class="row form-group">
        <div class="form-group  col-md-6">
            <div class="form-group">
                <label for="code">Code</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <input type="text" {{ isset($agent) ? 'readonly' : '' }} class="form-control @error('Code') is-invalid @enderror" name="code" id="code" value="{{ isset($agent) ? $agent->code : '' }}" placeholder="Saisir le code de l'agent" required autocomplete="code" autofocus>

                </div>
                @error('Code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="username">Login</label>
            <div class="input-group">
                <div class="input-group-append">
                <div class="input-group-text">
                    <strong> @</strong>
                </div>
                </div>
                <input type="text" {{ isset($agent) ? 'readonly' : '' }} class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ isset($agent) ? $agent->username : '' }}" placeholder="Saisir le login de l'agent" required autocomplete="username" autofocus>

            </div>
            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="lastname">Nom</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('Nom') is-invalid @enderror" name="lastname" id="lastname" value="{{ isset($agent) ? $agent->lastname : '' }}" placeholder="Saisir le nom de l'agent" required autocomplete="lastname" autofocus>

            </div>
            @error('Nom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>




        <div class="form-group col-md-8">
            <label for="firstname">Prenoms</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" value="{{ isset($agent) ? $agent->firstname : '' }}" placeholder="Saisir le prenom de l'agent" required autocomplete="firstname" >

            </div>
            @error('Prenoms')
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
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ isset($agent) ? $agent->user->email : '' }}" placeholder="Saisir le l'email de l'agent" autocomplete="email" >

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
                <input type="text"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ isset($agent) ? $agent->contact : '' }}" required data-mask>

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
                <input type="checkbox" name="state" id="state" {{ isset($agent) ? (($agent->state) ? 'checked' : '') : 'checked'}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
