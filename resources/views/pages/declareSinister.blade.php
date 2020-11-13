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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
                        <div class="card-body">
                                <div class="tab-content" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                        <div class="tab-custom-content">
                                            <p class="lead mb-0">DECLARATION |  <button class="btn btn-sm btn-flat btn-outline-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                <H8><strong>SOUSCRIPTION N°</strong><strong style="color: brown">{{$subscription->code}}</strong></H6>
                                            </button></p>
                                                        <hr>
                                        </div>
                                        <div class="row">
                                            <div class="row col-md 4">
                                                <form method="POST" enctype="multipart/form-data" action="{{ route('sinister.store',['subscription' => $subscription->id]) }}" >
                                                    @csrf
                                                    

                                                     <div class="collapse" id="collapseExample">
                                                         <div class="card card-body">
                                                             <div class="row">
                                                                 <div class="col-md-6">
                                                                    <table class="table table-sm table-striped">
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
                                                                            <td>FORMULE  @switch($subscription->formula)
                                                                                @case("1")
                                                                                    ECO
                                                                                    @break
                                                                                    @case("2")
                                                                                    STANDARD
                                                                                    @break
                                                                                    @case("3")
                                                                                    PREMIUM
                                                                                    @break
                                                                                @default
                                                                                STANDARD
                                                                            @endswitch  : </td>
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
                                                                    </table>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <table  class="table table-striped">

                                                                        <tr>
                                                                            <td colspan="2" style="text-align: center">
                                                                                <h3 style="color: #120d74">   <span>INFORMATION EQUIPEMENT</span> </h3>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Nature : </td>
                                                                            <td>  {{$subscription->pack->first()->product->type->label }} </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Marque :</td>
                                                                            <td>{{$subscription->pack->first()->product->label->label." ".$subscription->pack->first()->product->model->label }}</td>
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
                                                                 </div>

                                                             </div>

                                                         </div>
                                                    </div>
                                                     <div class="row">
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <textarea class="form-control @error('description') is-invalid @enderror" cols="50" rows="14" id="description" name="description" placeholder="Ecrivez ici votre déclaration">{{ old('description') }}</textarea>
                                                                         @error('description')
                                                                         <span class="invalid-feedback" role="alert">
                                                                             <strong>{{ $message }}</strong>
                                                                         </span>
                                                                     @enderror
                                                                 </div>
                                                                 <button type="submit" class="btn btn-primary" style="width: 200px"><b>TRANSMETTRE</b> </button>
                                                                </div>

                                                             <div class="row col-md-6">
                                                                 <div class="form-group">
                                                                     <label for="contract">Justificatif (Documents/Contrat)</label>

                                                                     <div class="custom-file">
                                                                         <input type="file" class="custom-file-input form-control @error('contract') is-invalid @enderror" value="{{ old('contract') }}" name="contract" id="contract" >
                                                                         <label class="custom-file-label" for="contract">Charger contrat</label>
                                                                       @error('contract')
                                                                                             <span class="invalid-feedback" role="alert">
                                                                                                 <strong>{{ $message }}</strong>
                                                                                             </span>
                                                                                         @enderror
                                                                     </div>

                                                                 </div>

                                                                 <div class="form-group ">
                                                                     <label for="vouchers">Justificatif (Photo équipement)</label>

                                                                     <div class="custom-file">
                                                                         <input type="file" class="custom-file-input form-control @error('vouchers') is-invalid @enderror"  value="{{ old('vouchers') }}" name="vouchers" id="vouchers" >
                                                                         <label class="custom-file-label" for="vouchers">Charger photo</label>
                                                                     @error('vouchers')
                                                                                             <span class="invalid-feedback" role="alert">
                                                                                                 <strong>{{ $message }}</strong>
                                                                                             </span>
                                                                                         @enderror
                                                                                     </div>

                                                                 </div>
                                                                 <div class="form-group">

                                                                     <div class="icheck-danger">
                                                                        <label for="choix1">SINISTRE {{$subscription->pack->first()->product->category->label}}</label><br/>
                                                                        @foreach ($clmtypes as $item)
                                                                            @if ($subscription->pack->first()->product->category->hasAttribute($item->code,'CLM-TYP'))
                                                                            <div class="icheck-danger">
                                                                                <input class="checkbox @error('choix1') is-invalid @enderror" {{ (old('choix1') && (in_array($item->code, old('choix1'))) ) ? 'checked' : '' }} type="checkbox" name="choix1[]" id="{{$item->code}}" value={{$item->code}}>
                                                                                <label for={{$item->code}}>
                                                                                    {{$item->label}}
                                                                                </label>
                                                                              </div>
                                                                            @endif
                                                                        @endforeach

                                                                    </div> <br>

 @error('choix1')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                    @enderror


                                                            </div>
                                                             </div>
                                                     </div>

                                                    <div class="form-group">
                                                        <img id="preview" class="img-fluid" src="#" alt="" style="height:400px; ">

                                                    </div>





                                                    <div class="form-group col-md-12 " style="text-align: right; ">
                                                        <hr>
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


