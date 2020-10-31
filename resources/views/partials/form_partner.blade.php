

<form class="form" method="POST" enctype="multipart/form-data"  action="{{ isset($partner) ? route('partners.update',$partner->slug) : route('partners.add')}}">
    @csrf

    <div class="row form-group">
        <div class="col-md-8">
            <div class="card ">

            <div class="card-body row">
                <div class="form-group col-md-6">
                    <label for="code">Code</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input {{ isset($partner) ? "disabled" : ""}} type="text" class="form-control @error('Code') is-invalid @enderror" name="code" id="code" value="{{ isset($partner) ? $partner->code : old('code') }}" placeholder="Saisir le code du partenaire" required autocomplete="code" autofocus>

                    </div>
                    @error('Code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">

                    <label for="logo">Logo</label>

                    <div class="custom-file">
                      
                        <input type="file" class="custom-file-input form-control @error('logo') is-invalid @enderror" value="{{ isset($partner) ? $partner->logo : '' }}" name="logo" id="logo" >
                        <label class="custom-file-label" for="logo">Charger le logo (image png)</label>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                        @if (isset($partner) && isset($partner->logo))
                        <span class="">
                        <strong>{{ isset($partner) ? $partner->logo : '' }}</strong>
                    </span>
                    @endif
                    </div>
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

                <div class="form-group col-md-4">
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
                        <input type="checkbox" name="state" id="state" {{ isset($partner) ? (($partner->state) ? 'checked' : '') : 'checked'}} data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                </div>
            </div>
            <!-- /.card -->
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">

                <div class="card-body row">
                    <div class="form-group col-md-12">
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


                    <div class="form-group col-md-12">
                        <label>Categories</label>
                        <div class="select2-primary">

                            <select name='category[]' class="form-control select2" multiple="multiple" data-dropdown-css-class="select2-primary" data-placeholder="Sélectionner les categories" style="width: 100%;" required>
                                @foreach ($categories as $item)
                                    <option value={{ $item->code }}  {{ (isset($partner) && $partner->hasCategory($item->code)) ? 'selected' : ''}}>{{$item->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                            <label>TAUX DE SOUSCRIPTION</label>
                        <div class="input-group">
                            <input type="number" required step="0.1" value="{{ isset($partner) ? $partner->rate : '' }}" name="rate" id="rate">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span>%</span>
                                </div>
                            </div>
                            @error('rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>


                </div>
                <!-- /.card -->
            </div>
        </div>
        @if (!(isset($partner) ))
        <div class="col-md-12">
            <div class="card ">

            <div class="card-body row">

                <div class="form-group col-md-4">
                    <label for="lastnameM">Nom manager</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control " name="lastnameM" id="lastnameM" value="{{ old('lastnameM')}}" placeholder="Saisir le nom du manager" required autocomplete="lastnameM" autofocus>

                    </div>
                    @error('lastnameM')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="firstnameM">Prenom(s) manager</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control " name="firstnameM" id="firstnameM" value="{{ old('firstnameM')}}" placeholder="Saisir le(s) prenom(s) du manager" required autocomplete="firstnameM" autofocus>

                    </div>
                    @error('firstnameM')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        @endif

    </div>





    </div>
    <button type="submit" class="btn btn-primary">ENREGISTRER</button>
</form>
