@extends('shared.layout')
@section('subscription')
    active
@endsection
@section('operation')
    menu-open active
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary  shadow-sm ">
                    <div class="card-header p-0 pt-1" style="background-color:#120d74; ">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">NOUVELLE SOUSCRIPTION</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">INFORMATION CLIENT
                                    </p>

                                    <hr>
                                </div>
                                <form   method="POST" action="{{ route('subscription.postcustomer') }}">

                                    @csrf
                                    <div class="row form-group">
                                        <div class="row">

                                        </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-group">
                                                    <label>N° Dossier : </label>
                                                    <label style="color: red"> </label>

                                                </div>
                                            </div>
                                <div class="form-group col-md-2">

                                     <div class="form-group">
                                        <label>Civilité</label>
                                        <select name="gender" class="form-control select2bs4" style="width: 100%;">
                                                            <option value="1" >Monsieur</option>
                                                            <option value="2" >Madame</option>
                                                            <option value="3" >Mademoiselle</option>
                                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="name">Nom</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control " name="name" id="name" value="" placeholder="Saisir le nom du client" required autocomplete="name" autofocus>

                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="first_name">Prénoms</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control " name="first_name" id="first_name" value="" placeholder="Saisir le libelle du client" required autocomplete="first_name" >

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
                                                <input type="date" class="form-control " name="birth_date" id="birth_date"  required autocomplete="birth_date" >

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
                                            <input type="text" class="form-control " name="place_birth" id="place_birth" value="" placeholder="Saisir le lieu de naissance du client" required autocomplete="place_birth" >

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
                                            <input type="text" class="form-control " name="place_residence" id="place_residence" value="" placeholder="Saisir le lieu de résidence du client" required autocomplete="place_residence" >

                                         </div>
                                    </div>

                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                       <label>Situation matrimoniale</label>
                                       <select name="marital_status" class="form-control select2bs4" style="width: 100%;">
                                            <option value="C"> Célibataire</option>
                                            <option value="M">Marié(e)</option>
                                            <option value="D">Divorcé(e)</option>
                                            <option value="V">Veuf(ve)</option>

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
                                    <input type="email" class="form-control " name="mail" id="mail" value="" placeholder="Saisir le libelle du client" autocomplete="mail" >

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
                                    <input type="text"  data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']"  class="form-control " name="phone1" id="phone1" value="" required data-mask>

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
                                    <input type="text" data-inputmask="'mask': ['99-99-99-99', '+999 99-99-99-99']" class="form-control " name="phone2" id="phone2" value="" data-mask>

                                </div>
                            </div>

                                    <P style="margin-left:90%">
                                        <hr>
                                        <button type="submit" class="btn btn-primary" >SUIVANT</button>
                                    </P>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
