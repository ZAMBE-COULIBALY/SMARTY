<form  method="POST" class="form form-horizontal" role="search" action="{{ route('sinister.statment') }}">
@csrf

    <div class="row">


            <div class="col-md-3">

                <div class="input-group" >
                    <label for="folder">CODE</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <input type="checkbox" checked id="ckeckedCode">
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-sm @error('folder') is-invalid @enderror" name="folder" id="folder" value="{{ old('subscription') }}" placeholder="Rechercher la souscription" required autofocus>
                    @error('folder')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>


                </div>
            </div>
        <div class="col-md-3">

            <div class="input-group" >
                <label for="lastname">NOM</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <input type="checkbox" id="ckeckedLastname">
                        </span>
                    </div>
                    <input type="text" disabled class="form-control form-control-sm @error('lastname') is-invalid @enderror" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="NOM DU SOUSCRIPTEUR" required autofocus>
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


            </div>
        </div>
            <div class="col-md-3">

                <div class="input-group" >
                    <label for="firstname">PRENOM(S)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <input type="checkbox" id="ckeckedFirstname">
                            </span>
                        </div>
                        <input type="text" disabled class="form-control form-control-sm @error('firstname') is-invalid @enderror" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="PRENOM(S) DU SOUSCRIPTEUR" required autofocus>
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>


                </div>
        </div>
        <div class="col-md-3">

            <div class="input-group" >
                <label for="contact">CONTACT</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <input type="checkbox" id="ckeckedContact">
                        </span>
                    </div>
                    <input type="text" disabled  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control form-control-sm @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ old('contact')}}" required data-mask>
                    @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>


            </div>
        </div>
    
    </div>

    <div class="row">
        <div class="Form-group col-md-4">

            <button type="submit" class="btn btn-default">
                <span>Rechercher</span>
            </button>

        </div>
    </div>
</form>
