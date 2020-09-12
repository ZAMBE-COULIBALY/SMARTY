@extends('shared.layout')
@section('subscription')
    active
@endsection
@section('operation')
    menu-open
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
                                    <p class="lead mb-0">INFORMATION EQUIPEMENT
                                    </p>

                                    <hr>
                                </div>

                                <form  method="POST" action="{{ route('subscription.postequipment') }}">
                                    @csrf
                            <div class="row form-group">
                                <div class="row">
                                </div>
                                    <div class="form-group col-md-12">
                                        <div class="form-group">
                                           <label>Selectionnez votre équipement</label>
                                           <select name="equipment" class="form-control select2bs4" style="width: 100%;">
                                                    <option value="SMARTPHONE"> SMARTPHONE/TABLETTE</option>
                                                    <option value="MODEM">MODEM WIFI</option>
                                                    <option value="TELEVISSEUR">TELEVISSEUR</option>
                                                    <option value="TELEVISSEUR">AUTRES</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                       <label>Marque</label>
                                       <select name="mark" class="form-control select2bs4" style="width: 100%;">
                                                <option value="-1">..Choisir une marque..</option>
                                                <option value="Huawei"> Huawei</option>
                                                <option value="Samsung">Samsung</option>
                                                <option value="Nokia">Nokia</option>
                                                <option value="Motorola">Motorola</option>
                                                <option value="Tecno">Tecno</option>
                                        </select>
                                    </div>
                                </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                   <label>Modèle</label>
                                   <select name="model" class="form-control select2bs4" style="width: 100%;">
                                            <option value="-1">..Choisir un modèle..</option>
                                            <option value="GalaxyZ"> Galaxy Z</option>
                                            <option value="GalaxyS">Galaxy S</option>
                                            <option value="GalaxyNote">Galaxy Note</option>
                                            <option value="GalaxyA">Galaxy A</option>
                                            <option value="GalaxyZFold25G">Galaxy Z Fold2 5G</option>
                                            <option value="GalaxyS20Ultra5G">Galaxy S20 Ultra 5G</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="numberIMEI">Numéro Identifiant (IMEI) </label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control " name="numberIMEI" id="numberIMEI" value="" placeholder="Saisir le numéro identifiant (IMEI)" required autocomplete="numberIMEI" >
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price">Prix Achat </label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control " name="price" id="price" value="" placeholder="Saisir le prix d'achat" required autocomplete="price" >
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="date_subscription">Date effet de la garantie</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control" name="date_subscription" id="date_subscription"  required autocomplete="date_subscription" >
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="picture">Photo équipement</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-edit"></span>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control " name="picture" id="picture"  required autocomplete="picture" >
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <a class="btn btn-success" href="{{ route('subscription.getequipment') }}">Ajouter un autre équipement</a>
                            </div>
                            <div class="form-group col-md-9"></div>
                            <div class="form-group col-md-12">
                                <hr>
                                <div class="form-group">


                                    <label style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Prime à payer  :  </label>

                                    <label name="price" id="output" style="color: red">   </label> <label for="FCFA">FCFA</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">

                                <div class="form-group col-md-6 ">
                                    <a class="btn btn-primary" href="{{ route('subscription.precedent') }}">PRECEDENT</a>

                                </div>

                            <div class="form-group col-md-6 ">
                                <button type="submit" class="btn btn-primary" >SUIVANT</button>
                            </div>
                        </div>


                                </P>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
@section('script')
<script>
    $(document).ready(function(){
      $("#price").on("input", function(){
        $("#output").text($(this).val()*0.10);
      });
    });
  </script>

@endsection
