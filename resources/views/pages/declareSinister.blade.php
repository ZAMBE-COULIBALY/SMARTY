@extends('shared.layout')
@section('sinister')
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
                        <div class="card-header p-0 pt-1 " style="background-color:#120d74; ">
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">DECLARATION DE SINISTRE</a>
                                    </li>
                            </ul>
                        </div>
                        @if (Session::has('error'))
                                <div class="alert alert-success">{{ Session::get('error')}}</div>
                            @endif
                        <div class="card-body">
                                <div class="tab-content" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                        <div class="tab-custom-content">
                                            <p class="lead mb-0">DECLARATION</p>
                                                        <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if(isset($subscription))

                                                    <table  class="table table-striped">
                                                        <tr>
                                                            <td> </td>
                                                            <td style="text-align: center">
                                                                CONTRAT N°:{{$subscription->code}} <br>
                                                                PDV :{{$subscription->agent->agency->label}}
                                                            </td>
                                                        </tr>
                                                        <tr >
                                                            <td colspan="2" style="text-align: center">
                                                                <h3 style="color: #120d74">   <span>INFORMATION CLIENT</span> </h3>
                                                            </td>
                                                        </tr>
                                                        <tr style="text-align: left";>
                                                            <td>FORMULE PREMIUM : </td>
                                                            <td>NOUVELLE SOUSCRIPTION</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nom & Prénoms :</td>
                                                            <td>  {{$subscription->customer->name}} {{$subscription->customer->first_name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Téléphone :</td>
                                                            <td>  {{$subscription->customer->phone1}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mail :</td>
                                                            <td>{{$subscription->customer->mail}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date & lieu de naissance :</td>
                                                            <td>{{$subscription->customer->birth_date}} {{$subscription->customer->place_birth}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Situation Matrimoniale :</td>
                                                            <td> {{$subscription->customer->marital_status}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lieu de résidence :</td>
                                                            <td> {{$subscription->customer->place_residence}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="text-align: center">
                                                                <h3 style="color: #120d74">   <span>INFORMATION EQUIPEMENT</span> </h3>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nature : </td>
                                                            <td>  {{$subscription->equipment}} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Marque :</td>
                                                            <td>{{$subscription->mark}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Numéro identifiant (IMEI) :</td>
                                                            <td>  {{$subscription->numberIMEI}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date effet de garantie :</td>
                                                            <td>{{$subscription->date_subscription}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date fin de garantie :</td>
                                                            <td>{{$subscription->subscription_enddate}} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Valeur Achat :</td>
                                                            <td>{{ $subscription->price}}  FCFA </td>
                                                        </tr>
                                                        <tr style="color: red; ">
                                                            <td> <b> VOTRE PRIME :</b> </td>
                                                            <td><b>{{$subscription->premium}}  FCFA  </b></td>
                                                        </tr>
                                                    </table>

                                                 @endif
                                               </div>

                                            <div class="row col-md 4">
                                                <form method="POST" action="{{ route('sinister.store',['subscription' => $subscription->id]) }}" >
                                                    @csrf

                                                    <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                                        <div class="form-control">

                                                            <input type="file" id="contract" name="contract" >
                                                            <label class="custom-file-label" for="contract"></label>

                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <img id="preview" class="img-fluid" src="#" alt="" style="height:400px; ">

                                                    </div>


                                                    <div class="form-group">
                                                        <label for="vouchers">Justificatifs</label> <br>
                                                        <input type="file" name="vouchers" id="vouchers"  >
                                                    </div>
                                                    <div>
                                                        <textarea name="description" cols="100" rows="10" placeholder="Ecrivez ici votre déclaration " class="form-control"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                            <div class="checkbox">
                                                                <label for="SMARTPHONES">SMARTPHONES TABLETTES & WIFI</label><br/>

                                                                <input type="checkbox" name="choix1[]" id="bris_ecran" value="1" > Bris d’Ecran <br/>
                                                                <input type="checkbox" name="choix1[]" id="oxydation" value="2"> Oxydation <br/>
                                                                <input type="checkbox" name="choix1[]" id="pannes_mecaniques" value="3"> Pannes mécaniques et logicielles <br/>
                                                                <input type="checkbox" name="choix1[]"id="panne_electrique" value="4"> Panne électrique (uniquement pour les wifi)  <br/>
                                                            </div> <br>
                                                            <div class="checkbox">
                                                                <label for="ELECTROMENAGERS">APPAREILS ELECTROMENAGERS</label><br/>

                                                                <input type="checkbox" name="choix2[]" id="incendie" value="1" > Incendie <br/>
                                                                <input type="checkbox" name="choix2[]" id="dommages" value="2"> Dommages électriques <br/>
                                                                <input type="checkbox" name="choix2[]" id="degats" value="3"> Dégâts des eaux <br/>
                                                                <input type="checkbox" name="choix2[]" id="accidentels" value="3"> Bris accidentels <br/>
                                                                <input type="checkbox" name="choix2[]" id="vol" value="4"> Vol à domicile avec effraction et/ou holdup <br/>
                                                            </div>
                                                    </div>


                                                    <div class="form-group col-md-12 " style="text-align: right; ">
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary" style="width: 200px"><b>TRANSMETTRE</b> </button>
                                                    </div>
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

@section('script')
    <script>
        $(() => {
            $('input[type="file"]').on('change', (e) => {
                let that = e.currentTarget
                if (that.files && that.files[0]) {
                    $(that).next('.custom-file-label').html(that.files[0].name)
                    let reader = new FileReader()
                    reader.onload = (e) => {
                        $('#preview').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(that.files[0])
                }
            })
        })
    </script>


@endsection


