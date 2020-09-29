<p class="lead mb-0">TRAITEMENT DE DEMANDE
</p>

<hr>
    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <label for=""> Souscription N°</label><strong style="color: brown">{{$sinister->subscription->code}}</strong>
    </button>

     <div class="collapse" id="collapseExample">
         <div class="card card-body">
             <div class="row">
                 <div class="col-md-6">
                    <table  class="table table-sm table-striped">
                        <tr>
                            <td> </td>
                            <td style="text-align: center">
                                CONTRAT N°:{{$sinister->subscription->code}} <br>
                                PDV :{{$sinister->subscription->agent->agency->label}}
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
                            <td>  {{$sinister->subscription->customer->name}} {{$sinister->subscription->customer->first_name }} </td>
                        </tr>
                        <tr>
                            <td>Téléphone :</td>
                            <td>  {{$sinister->subscription->customer->phone1}}</td>
                        </tr>
                        <tr>
                            <td>Mail :</td>
                            <td>{{$sinister->subscription->customer->mail}}</td>
                        </tr>
                        <tr>
                            <td>Date & lieu de naissance :</td>
                            <td>{{$sinister->subscription->customer->birth_date}} {{$sinister->subscription->customer->place_birth}}</td>
                        </tr>
                        <tr>
                            <td>Situation Matrimoniale :</td>
                            <td> {{$sinister->subscription->customer->marital_status}}</td>
                        </tr>
                        <tr>
                            <td>Lieu de résidence :</td>
                            <td> {{$sinister->subscription->customer->place_residence}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table  class="table table-sm table-striped">

                        <tr>
                            <td colspan="2" style="text-align: center">
                                <h3 style="color: #120d74">   <span>INFORMATION EQUIPEMENT</span> </h3>
                            </td>
                        </tr>
                        <tr>
                            <td>Nature : </td>
                            <td>  {{$sinister->subscription->equipment}} </td>
                        </tr>
                        <tr>
                            <td>Marque :</td>
                            <td>{{$sinister->subscription->mark}}</td>
                        </tr>
                        <tr>
                            <td>Numéro identifiant (IMEI) :</td>
                            <td>  {{$sinister->subscription->numberIMEI}}</td>
                        </tr>
                        <tr>
                            <td>Date effet de garantie :</td>
                            <td>{{$sinister->subscription->date_subscription}}</td>
                        </tr>
                        <tr>
                            <td>Date fin de garantie :</td>
                            <td>{{$sinister->subscription->subscription_enddate}} </td>
                        </tr>
                        <tr>
                            <td>Valeur Achat :</td>
                            <td>{{ $sinister->subscription->price}}  FCFA </td>
                        </tr>
                        <tr style="color: red; ">
                            <td> <b> VOTRE PRIME :</b> </td>
                            <td><b>{{$sinister->subscription->premium}}  FCFA  </b></td>
                        </tr>
                    </table>
                 </div>

             </div>

         </div>
    </div>
     <div class="row">
            <div class="col-md-6">
                     <div class="form-group">
                         <textarea style=" resize: none;" readonly class="form-control" cols="50" rows="7" id="description" name="description">{{ $sinister->description }}</textarea>
                         @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @if ($sinister->subscription->equipment == 1)
                        <div class="checkbox">
                            <label for="SMARTPHONES">SMARTPHONES TABLETTES & WIFI</label><br/>

                            <input disabled {{ (in_array(1,explode(",",$sinister->type1))) ? "checked" : "" }} type="checkbox" name="choix1[]" id="bris_ecran" value="1" > Bris d’Ecran <br/>
                            <input disabled {{ (in_array(2,explode(",",$sinister->type1))) ? "checked" : "" }}type="checkbox" name="choix1[]" id="oxydation" value="2"> Oxydation <br/>
                            <input disabled {{ (in_array(3,explode(",",$sinister->type1))) ? "checked" : "" }}type="checkbox" name="choix1[]" id="pannes_mecaniques" value="3"> Pannes mécaniques et logicielles <br/>
                            <input disabled {{ (in_array(4,explode(",",$sinister->type1))) ? "checked" : "" }}type="checkbox" name="choix1[]"id="panne_electrique" value="4"> Panne électrique (uniquement pour les wifi)  <br/>
                        </div> <br>
                    @else
                        <div class="checkbox">
                            <label for="ELECTROMENAGERS">APPAREILS ELECTROMENAGERS</label><br/>

                            <input disabled {{ (in_array(1,explode(",",$sinister->type2))) ? "checked" : "" }} type="checkbox" name="choix2[]" id="incendie" value="1" > Incendie <br/>
                            <input disabled {{ (in_array(2,explode(",",$sinister->type2))) ? "checked" : "" }} type="checkbox" name="choix2[]" id="dommages" value="2"> Dommages électriques <br/>
                            <input disabled {{ (in_array(3,explode(",",$sinister->type2))) ? "checked" : "" }} type="checkbox" name="choix2[]" id="degats" value="3"> Dégâts des eaux <br/>
                            <input disabled {{ (in_array(4,explode(",",$sinister->type2))) ? "checked" : "" }} type="checkbox" name="choix2[]" id="accidentels" value="3"> Bris accidentels <br/>
                            <input disabled {{ (in_array(4,explode(",",$sinister->type2))) ? "checked" : "" }} type="checkbox" name="choix2[]" id="vol" value="4"> Vol à domicile avec effraction et/ou holdup <br/>
                        </div>
                    @endif
            </div>

            <div class="col-md-6">
               <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid" style="width: 100%; height: 200px" src="{{ asset('storage/sinisters/'.$sinister->folder.'/'.$sinister->contract) }}" alt="">
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" style="width: 100%; height: 200px" src="{{ asset('storage/sinisters/'.$sinister->folder.'/'.$sinister->vouchers) }}" alt="">
                    </div>
                </div>

               <div class="row">
                <div class="col-md-4">


                <a class="btn btn-danger btn-lg" href="{{ route('sinister.manage.demandstate', ['sinister'=> $sinister->id , 'state' => -1 ]) }}">DECLINER</a>
            </div>
                <div class="col-md-4">

                <a class="btn btn-success btn-lg" href="{{ route('sinister.manage.demandstate',['sinister'=> $sinister->id , 'state' => 1 ]) }}">VALIDER</a>                    </div>

            </div>

            </div>



        </div>
             </div>
     </div>

    <div class="form-group col-md-12 " style="text-align: right; ">
        <hr>
    </div>
