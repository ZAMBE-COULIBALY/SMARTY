<html style="margin: 0">
    <head>
        <TItle></TItle>

    </head>
 <body  style="padding: 0; background-image: url('{{ asset('dist/img/FicheNSIA1.jpg') }}') ;  background-repeat: no-repeat; background-size: 100% 100%; margin:0%">

<div style="margin-top:10 %; font-size:14px; font-family: Arial;margin-left:3%; ">
    <table style="border: solid 2px;width: 97%;">
        <tbody style="font-size:14px; font-family: Arial; border-collapse: collapse;">
            <tr><td colspan="10"><b> RESERVE A NSIA ASSRANCES </b></td></tr>
            <tr>
                <td colspan="2">Numéro de police</td>
                <td colspan="3"><b>{{$newsubscription->code}} </b></td>
                <td colspan="2">Numéro du client</td>
                <td colspan="3"><b>{{$newsubscription->customer->id}}</b></td>
            </tr>
            <tr>
                <td colspan="2">Nom du conseiller</td>
                <td colspan="3"><b>{{$newsubscription->agent->firstname.' '.$newsubscription->agent->lastname}}</b></td>
                <td colspan="1">Code</td>
                <td colspan="1"><b>{{ $newsubscription->agent->agency->partner->code }}</b></td>
                <td colspan="1">Revendeur</td>
                <td colspan="2"><b>{{ $newsubscription->agent->agency->label }}</b></td>
            </tr>
        </tbody>

    </table>
</div>
<div style="position: absolute; top: 1%; right: 3%; height:100px; width: 100px; display: inline-block">
           <img src="{{ asset('storage/logo/'.$newsubscription->agent->agency->partner->code.'/'.$newsubscription->agent->agency->partner->logo) }}" style="max-width: 100px; max-height: 100px; image-orientation: from-image;" alt="SMARTY"  onerror="if (this.src != '{{ asset('') }}') this.src = '{{ asset('') }}';" >

</div>

<div style="margin-top : 0.2cm; position: relative; width: 94%; left:3%">
<table  style="width: 100%;  border-collapse: collapse; border: 1px solid black; font-size:13px; font-family: Arial;">
    <tr>
        <td style=" width: 30%; background-color:#cbcbcb; ">
            Souscripteur
        </td>
        <td style="width: 64%;">

        </td>
    </tr>
</table>
</div>

<div style="position: relative;  margin:0% ;width: 94%; left:3% ;">
<p style="border: solid 1px; padding: 1%;  font-size:14px;  font-family: Arial; line-height:25px; margin-left:0%; ">
 <b>  2. ASSURE      </b>               {{ $newsubscription->customer->gender }} <br>

 <b> Nom </b> {{ $newsubscription->customer->name }} <b>Prénoms</b> {{ $newsubscription->customer->first_name }} <br>

 <b>Date de Naissance</b> {{ $newsubscription->customer->birth_date }}  <b>Lieu de Naissance</b>  {{ $newsubscription->customer->place_birth }} <br>

 <b>Situation Matrimoniale:</b>		{{  $newsubscription->customer->marital_status }}<br>

 <b>Lieu de Résidence :</b>    {{ $newsubscription->customer->place_residence }} <br>

 <b>Adresse Postale Personnelle</b>   {{ $newsubscription->customer->mailing_address }}  <b>Cellulaire</b> {{ $newsubscription->customer->phone1}} / {{ $newsubscription->customer->phone2 }}<br>

 <b>Email</b> {{ $newsubscription->customer->mail }}<br>

</p>
</p>
</div>

<div style="border: solid 1px; padding: 0.5% ; position: relative; margin:0% ;width: 93%; left:3% ;font-size:14px; font-family: Arial;">
  <b>  3. CARACTERISTIQUES </b> <br>
  <table  border="0.5px" style="width: 800px; margin-left:15%; border-collapse: collapse; font-size:14px; font-family: Arial;">
        <thead>
            <tr style="background-color:rgba(190, 190, 190, 0.267) ">
                <th>Type d’Appareil</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Numéro identifiant</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
            </tr>
        </thead>
    <tbody>
            <tr>
                <td> {{ $newsubscription->pack->first()->product->type->label}}</td>
                <td> {{ $newsubscription->pack->first()->product->label->label }}</td>
                <td> {{ $newsubscription->pack->first()->product->model->label }}</td>
                <td> {{ $newsubscription->numberIMEI }}</td>
                <td> {{ round( $newsubscription->price )}}</td>
                <td> {{ round( $newsubscription->price )}}</td>
            </tr>
    </tbody>
    </table>

</div>

<div style="top: 1%; border: solid 1px;  padding: 0.5% ; position: relative; margin:0% ;width: 93%; left:3% ;font-size:14px; font-family: Arial;">
    <table border="0.5px" style="width: 800px; margin-left:15%; border-collapse: collapse; font-size:14px; font-family: Arial;" >
            <tr>
                <td colspan="4">
                 <b>   4. FORMULE </b>
                </td>
              </tr>
              <tr>
                <td colspan="4" style="background-color:rgba(190, 190, 190, 0.267) ">
                    <center>
                    <b>  Formule
                         @switch($newsubscription->formula)
                        @case(1)
                            STANDARD
                            @break
                            @case(2)
                            ECO
                            @break
                            @case(3)
                            PREMIUM
                            @break
                        @default
                        PREMIUM
                    @endswitch </b>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                 <b>  5. GARANTIE  </b>
                </td>
            </tr>

            <tr>
                    <td style="background-color:rgba(190, 190, 190, 0.267) ">
                        <center>
                     <b>   Date d’effet de la garantie</b>
                         </center>
                    </td>
                    <td >
                        {{ $newsubscription->date_subscription }}
                    </td>
                    <td style="background-color:rgba(190, 190, 190, 0.267) ">
                        <center>
                     <b>   Date de fin de la garantie</b>
                         </center>
                    </td>
                    <td >
                        {{ $newsubscription->subscription_enddate }}
                    </td>
            </tr>
            <tr >
                <td colspan="4">
                 <b>   6. PRIMES   </b>
                </td>
            <tr>
                <td style="background-color:rgba(190, 190, 190, 0.267) ">
                   <b> Coût Total équipement(s)</b>

            </td>
                <td>
                    {{ round( $newsubscription->price) }}
                </td>
                <td style="background-color:rgba(190, 190, 190, 0.267) ">
                  <p>  Prime  Total TTC </p>
                </td>
                <td>
                    {{  round( $newsubscription->premium) }}
                </td>
            </tr>

        </table>
</div>
    <p style="margin-top:2%; font-size:14px; font-family: Arial; text-align: justify; line-height:20px; margin-left:3%;margin-right:3%; ">
      <b>  La police est constituée par :</b> <br>
<i>
     Les Conventions spéciales  extraites des Conditions Générales n°217 du 02 Avril 2001 et  Les présentes Conditions Particulières
</i>
<i>
    Ensemble de documents dont le Souscripteur reconnaît avoir reçu un exemplaire préalablement à la signature de son contrat. Conformément aux dispositions de l&#039article 13
    du Code CIMA, la prise d&#039effet de la police est subordonnée au paiement préalable de la prime. Le défaut de paiement de la prime emporte la résiliation de plein droit du contrat sans autre formalité.
    </i>
    </p>

    <p style="margin-top:1%; font-size:14px; font-family: Arial; margin-left:3%; ">
        Fait à Abidjan  le {{ $newsubscription->date_subscription }} <br>
    </p>
<p style="height: 1050px; width: 21cm; margin: 0">
    <img src="{{ asset('dist/img/FicheNSIA2-a.jpg') }}" width="100%" height="100%" alt="">
</p>
            </body>
</html>

