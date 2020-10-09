
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form   method="POST" action="{{ route('subscription.postcustomer') }}">

            @csrf
            <div class="row form-group">
                <div class="row">

                </div>
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label>N° Dossier : </label>
                            <label style="color: red">{{$numdossier}} </label>

                        </div>
                    </div>
        <div class="form-group col-md-2">

                <div class="form-group">
                <label>Civilité</label>
                <select name="gender" class="form-control select2bs4" style="width: 100%;">
                                    <option value="Monsieur" >Monsieur</option>
                                    <option value="Madame" >Madame</option>
                                    <option value="Mademoiselle" >Mademoiselle</option>
                                </select>
            </div>
        </div>


        <div class="form-group col-md-3">
            <label for="name">Nom</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control " name="name" id="name" value="{{ old('name') }}" placeholder="Saisir le nom du client" required autocomplete="name" autofocus>

            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="first_name">Prénoms</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control " name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Saisir le libelle du client" required autocomplete="first_name" >

            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="mailing_address">Adresse Postale</label>
            <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" class="form-control " name="mailing_address" id="mailing_address" autocomplete="address" value="{{ old('mailing_address') }}" placeholder="Adresse postale du client" >

            </div>
        </div>

            <div class="form-group col-md-3">
                    <label for="birth_date">Date de Naissance</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="date" max="{{$dat}}" value="{{ old('birth_date') }}"   class="form-control " name="birth_date" id="birth_date"  required autocomplete="birth_date" >

                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="place_birth">Lieu de naissance</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-home"></span>
                        </div>
                    </div>
                    <input type="text" class="form-control " name="place_birth" id="place_birth" value="{{ old('place_birth') }}" placeholder="Saisir le lieu de naissance du client" required autocomplete="place_birth" >

                    </div>
            </div>
            <div class="form-group col-md-3">
                <label for="place_residence">Lieu de residence</label>
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-home"></span>
                        </div>
                    </div>
                    <input type="text" class="form-control " value="{{ old('place_residence') }}"  name="place_residence" id="place_residence" value="" placeholder="Saisir le lieu de résidence du client" required autocomplete="place_residence" >

                    </div>
            </div>

        <div class="form-group col-md-3">
            <div class="form-group">
                <label>Situation matrimoniale</label>
                <select name="marital_status" class="form-control select2bs4" style="width: 100%;">
                    <option value="Celibataire"> Célibataire</option>
                    <option value="Marie(e)">Marié(e)</option>
                    <option value="Divorce(e)">Divorcé(e)</option>
                    <option value="Veuf(ve)">Veuf(ve)</option>

                </select>
            </div>
        </div>

        <div class="form-group col-md-6">
        <label for="mail">Email</label>
        <div class="input-group">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <input type="email" class="form-control " value="{{ old('mail') }}" name="mail" id="mail" value="" placeholder="Saisir le libelle du client" autocomplete="mail" >

        </div>
    </div>

    <div class="form-group col-md-3">
        <label for="phone1">Téléphone 1</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
            <input type="text" value="{{ old('phone1') }}"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control " name="phone1" id="phone1" value="" required data-mask>

        </div>
        </div>

    <div class="form-group col-md-3">
        <label for="phone2">Téléphone 2</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
            <input type="text" value="{{ old('phone2') }}" data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']" class="form-control " name="phone2" id="phone2" value="" data-mask>

        </div>
    </div>

            <P style="margin-left:90%">
                <hr>
                <button type="submit" class="btn btn-primary" >SUIVANT</button>
            </P>
</form>
