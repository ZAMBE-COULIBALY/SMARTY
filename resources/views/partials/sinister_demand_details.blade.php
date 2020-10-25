<p class="lead mb-0">TRAITEMENT DE DEMANDE   <button class="btn" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <label for=""> Souscription N°</label><strong style="color: brown">{{$sinister->subscription->code}}</strong>
    </button>
</p>

<hr>
  

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
                            <td>  {{$sinister->subscription->pack->first()->product->type->label }} </td>
                        </tr>
                        <tr>
                            <td>Marque :</td>
                            <td>{{$sinister->subscription->pack->first()->product->label->label." ".$sinister->subscription->pack->first()->product->model->label }}</td>
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
                        <tr style="color: green; ">
                            <td ><b>Valeur Achat :</b></td>
                            <td><b>{{ $sinister->subscription->price}}  FCFA </b></td>
                        </tr>
                        <tr style="color: green; ">
                            <td> <b> PRIME PAYEE :</b> </td>
                            <td><b>{{$sinister->subscription->premium}}  FCFA  </b></td>
                        </tr>
                        <tr style="color: red; ">
                            <td> <b> VALEUR INDEMNISATION :</b> </td>
                            <td><b>{{$sinister->subscription->currentValue()}}  FCFA  </b></td>
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
                    <div class="checkbox">
                        <label readonly for="choix1">SINISTRE {{$sinister->subscription->pack->first()->product->category->label}}</label><br/>
                    @foreach ($clmtypes as $item)
                        @if ($sinister->subscription->pack->first()->product->category->hasAttribute($item->code,'CLM-TYP'))
                        <div class="icheck-danger">
                            <input disabled {{ ((in_array($item->code, explode("-",$sinister->type1))) ) ? 'checked' : '' }} type="checkbox" name="choix1[]" id={{$item->code}} value={{$item->code}} >
                            <label for={{$item->code}}>
                                {{$item->label}}
                            </label>
                          </div>
                        @endif
                     @endforeach
                    </div> <br>

            </div>

            <div class="col-md-6">
               <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-contract">
                            <img class="img-fluid" style="width: 100%; height: 200px" src="{{ asset('storage/sinisters/'.$sinister->folder.'/'.$sinister->contract) }}" alt="">
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-flat" data-toggle="modal" data-target="#modal-vouchers">
                            <img class="img-fluid" style="width: 100%; height: 200px" src="{{ asset('storage/sinisters/'.$sinister->folder.'/'.$sinister->vouchers) }}" alt="">
                        </button>
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
    <div class="modal fade" id="modal-contract">
        <div class="modal-lg modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">CONTRAT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" style="width: 100%; height: 100%" src="{{ asset('storage/sinisters/'.$sinister->folder.'/'.$sinister->contract) }}" alt="">
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-vouchers">
        <div class="modal-lg modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">PIECES</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" style="width: 100%; height: 100%" src="{{ asset('storage/sinisters/'.$sinister->folder.'/'.$sinister->vouchers) }}" alt="">

            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
