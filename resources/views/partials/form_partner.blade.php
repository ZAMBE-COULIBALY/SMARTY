

<form class="form" method="POST" enctype="multipart/form-data"  action="{{ isset($partner) ? route('partners.update',$partner->slug) : route('partners.add')}}">
    @csrf

    <div class="row form-group">
        <div class="col-md-8">
            <div class="card ">

            <div class="card-body row">
                <div class="form-group col-md-6">
                    <label for="code">CODE</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input {{ isset($partner) ? "disabled" : ""}} type="text" class="form-control form-control-sm @error('Code') is-invalid @enderror" maxlength="8" name="code" id="code" value="{{ isset($partner) ? $partner->code : old('code') }}" placeholder="CODE DU PARTENAIRE" required autocomplete="code" autofocus>

                    </div>
                    @error('Code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">

                    <label for="logo">LOGO</label>

                    <div class="custom-file">

                        <input type="file" class="custom-file-input form-control-sm form-control @error('logo') is-invalid @enderror" value="{{ isset($partner) ? $partner->logo : '' }}" name="logo" id="logo" >
                        <label class="custom-file-label" for="logo">CHARGER LE LOGO (IMAGE png)</label>
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
                    <label for="label">LIBELLE</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control form-control-sm @error('label') is-invalid @enderror" maxlength="40" name="label" id="label" value="{{ isset($partner) ? $partner->label : '' }}" placeholder="LIBELLE DU PARTENAIRE" required autocomplete="label" >

                    </div>
                    @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="email">EMAIL</label>
                    <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        </div>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" maxlength="40" name="email" id="email" value="{{ isset($partner) ? $partner->email : '' }}" placeholder="LIBELLE DU PARTENAIRE" required autocomplete="email" autofocus>

                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="contact">CONTACT</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <input type="text"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control form-control-sm @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{ isset($partner) ? $partner->contact : '' }}" required data-mask>

                    </div>
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row offset-md-2 col-md-3 align-items-end align-items-middle">
                    <div class="col custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" {{ isset($partner) ? (($partner->state) ? 'checked' : '') : 'checked'}} name="state" id="state">
                        <label class="custom-control-label" for="state">ACTIF</label>
                    </div>
                    {{--  <label for="state" >ACTIF</label>
                    <div class="input-group">
                        <input type="checkbox" name="state" id="state" {{ isset($partner) ? (($partner->state) ? 'checked' : '') : 'checked'}}>
                    </div>  --}}
                </div>
                <div class="form-group row col-md-3 align-items-end align-items-middle">
                    {{--  <label for="formula" >MULTI FORMULE</label>
                    <div class="input-group">
                        <input type="checkbox" name="formula" id="formula" {{ isset($partner) ? (($partner->formula) ? 'checked' : '') : 'checked'}} >
                    </div>  --}}
                    <div class="col custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="formula" id="formula" {{ isset($partner) ? (($partner->formula) ? 'checked' : '') : 'checked'}}>
                        <label class="custom-control-label" for="formula" >MULTI FORMULE</label>
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
                            <select name="paymode" id="paymode" class="form-control form-control-sm  @error('paymode') is-invalid @enderror select2bs4NE" style="width: 100%;">
<<<<<<< HEAD

                                <option value=1 {{ (isset($partner) && $partner->paymode == 1)? 'selected' : '' }}>CAISSE</option>
                                <option value=2 {{ (isset($partner) && $partner->paymode == 2)? 'selected' : '' }}>MOBILE BANKING</option>
                                <option value=3 {{ (isset($partner) && $partner->paymode == 3)? 'selected' : '' }}>MIXTE</option>
=======
                                <option value=3 {{ (isset($partner) && $partner->paymode == 3)? 'selected' : '' }}>MIXTE</option>
                                <option value=1 {{ (isset($partner) && $partner->paymode == 1)? 'selected' : '' }}>MOBILE BANKING</option>
                                <option value=2 {{ (isset($partner) && $partner->paymode == 2)? 'selected' : '' }}>CAISSE</option>
>>>>>>> 794290092a8c7746e68fd4b89fc0e3a33981e7bb
                            </select>

                            @error('paymode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>


                    <div class="form-group col-md-12">
                        <label>CATEGORIES</label>
                        <div class="select2-primary">

                            <select name='category[]' class="form-control form-control-sm select2" multiple="multiple" data-dropdown-css-class="select2-primary" data-placeholder="SELECTIONNER LES CATEGORIES" style="width: 100%;" required>
                                @foreach ($categories as $item)
                                    <option value={{ $item->code }}  {{ (isset($partner) && $partner->hasCategory($item->code)) ? 'selected' : ''}}>{{$item->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                <div class="form-group col-md-12">
                    <label>TAUX DE SOUSCRIPTION</label>
                    <div class="row">
                        <div class="col-md-3 text-center justify-content-center align-self-center form-group">
                            <label>ECO</label>
                            <div class="input-group-sm">

                                 <input type="number" required max="{{ isset($partner) ? $partner->rate2 : '' }}" step="0.1" class="form-control form-control-sm" value="{{ isset($partner) ? $partner->rate2 : '' }}" name="rate2" id="rate2">

                                 @error('rate2')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-3 text-center justify-content-center align-self-center form-group">
                            <label>STANDARD</label>
                            <div class="input-group-sm">

                                 <input type="number" min="{{ isset($partner) ? $partner->rate : '' }}" required step="0.1" class="form-control form-control-sm" value="{{ isset($partner) ? $partner->rate : '' }}" name="rate" id="rate">

                                 @error('rate')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                         </div>
                         <div class="col-md-3 text-center justify-content-center align-self-center form-group">
                            <label>PREMIUM</label>
                            <div class="input-group-sm">

                                 <input type="number" required  step="0.1" min="{{ isset($partner) ? $partner->rate2 : '' }}" class="form-control form-control-sm" value="{{ isset($partner) ? $partner->rate : '' }}" name="rate3" id="rate3">

                                 @error('rate3')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                         </div>
                        <div class="col-md-2 text-center justify-content-center align-self-center">
                            <div class="input-group-text">
                                <span class="fa fa-percent"></span>
                            </div>
                        </div>
                    </div>



            </div>



                </div>
                <!-- /.card -->
            </div>
        </div>
        @if (!(isset($partner) ))
        <div class="col-md-6">
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
                        <input type="text" class="form-control form-control-sm" maxlength="30" name="lastnameM" id="lastnameM" value="{{ old('lastnameM')}}" placeholder="Saisir le nom du manager" required autocomplete="lastnameM" autofocus>

                    </div>
                    @error('lastnameM')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="firstnameM">Prenom(s) manager</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control form-control-sm" maxlength="50" name="firstnameM" id="firstnameM" value="{{ old('firstnameM')}}" placeholder="Saisir le(s) prenom(s) du manager" required autocomplete="firstnameM" autofocus>

                    </div>
                    @error('firstnameM')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            </div>
        </div>
        @endif
        <div class="col-md-6">
            <div class="card ">

            <div class="card-body row">

                <div class="form-group col-md-8">
                    <div class="input-group">
                        <label>COMMERCIAL</label>
                        <select name="intermediary" id="intermediary" class="form-control form-control-sm  @error('intermediary') is-invalid @enderror select2bs4NE"  style="width: 100%;">
                            <option value='0'>SELECTIONNER UN COMMERCIAL</option>
                           @foreach ($intermediaries as $item)
                          <option value={{$item->id}} {{ (isset($partner) && $partner->intermediary_id == $item->id)? 'selected' : '' }}>{{$item->code}}-{{$item->firstname}} {{$item->lastname}}</option>

                           @endforeach
                        </select>
                        @error('asstyp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group col-md-4">
                    <label>TAUX COMMISSION</label>
                            <div class="input-group-sm">

                                 <input type="number" min="0" required step="0.1" class="form-control form-control-sm" value="{{ isset($partner) ? $partner->intcomrate : '' }}" name="intcomrate" id="intcomrate">

                                 @error('intcomrate')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                             </div>
                </div>
            </div>
        </div>
        </div>
    </div>



    <button type="submit" class="btn btn-warning text-white" ><b>ENREGISTRER</b> </button>
</form>
