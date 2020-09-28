@extends('shared.layout')
@section('sinister_decla')
    active
@endsection
@section('sinister_menu')
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
                                            <p class="lead mb-0">Détails souscriptions</p>
                                                        <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if(isset($Subscription))

                                                    <table  class="table table-striped">
                                                        <tr>
                                                            <td> </td>
                                                            <td style="text-align: center">
                                                                CONTRAT N°:{{$Subscription->code}} <br>
                                                                PDV :{{$Subscription->agent->agency->label}}
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
                                                            <td>  {{$Subscription->customer->name}} {{$Subscription->customer->first_name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Téléphone :</td>
                                                            <td>  {{$Subscription->customer->phone1}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mail :</td>
                                                            <td>{{$Subscription->customer->mail}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date & lieu de naissance :</td>
                                                            <td>{{$Subscription->customer->birth_date}} {{$Subscription->customer->place_birth}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Situation Matrimoniale :</td>
                                                            <td> {{$Subscription->customer->marital_status}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lieu de résidence :</td>
                                                            <td> {{$Subscription->customer->place_residence}}</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2" style="text-align: center">
                                                                <h3 style="color: #120d74">   <span>INFORMATION EQUIPEMENT</span> </h3>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nature : </td>
                                                            <td>  {{$Subscription->equipment}} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Marque :</td>
                                                            <td>{{$Subscription->mark}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Numéro identifiant (IMEI) :</td>
                                                            <td>  {{$Subscription->numberIMEI}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date effet de garantie :</td>
                                                            <td>{{$Subscription->date_subscription}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Date fin de garantie :</td>
                                                            <td>{{$Subscription->subscription_enddate}} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Valeur Achat :</td>
                                                            <td>{{ $Subscription->price}}  FCFA </td>
                                                        </tr>
                                                        <tr style="color: red; ">
                                                            <td> <b> VOTRE PRIME :</b> </td>
                                                            <td><b>{{$Subscription->premium}}  FCFA  </b></td>
                                                        </tr>
                                                    </table>

                                                 @endif
                                            </div>

                                    </div>
                                    <a class="btn btn-primary" href="{{ route('sinister.create',['subscription' => $Subscription->id]) }}">SUIVANT</a>
                                </div>
                            </div>
                        </div>

            </div>
        </div>

</section>


@endsection


