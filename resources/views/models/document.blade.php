<html>
    <head>
        <TItle></TItle>

    </head>
 <body  style=" background-image: url('{{ asset('dist/img/FicheNSIA.jpg') }}'); margin:0%">

<p style="border: 5px; margin-top:8%; font-size:14px; font-family: Arial, Helvetica, sans-serif;margin-left:3%; ">
   <b> RESERVE A NSIA ASSRANCES </b><br>
   <b>Numéro de police</b>  {{$Subscription['folder']}}  <b>Numéro du client</b> _________________________________<br>

   <b>Nom du conseiller</b> __________________________ <b>Code</b>  ____________ <b>Revendeur</b>  __________________ <br>
</p>

<p style="margin-top:-3%">
<table  style="  border-collapse: collapse; border: 1px solid black; margin-left:20%; font-size:10px; font-family: Arial, Helvetica, sans-serif;">
    <tr>
        <td style="width: 220px; background-color:#cbcbcb; ">
            Souscripteur
        </td>
        <td style="width: 440px;">

        </td>
    </tr>
</table>
</p>

<p style="margin-top:1%">
<p style="border: 5px; margin-top:8%; font-size:14px; font-family: Arial, Helvetica, sans-serif; line-height:25px; margin-left:3%; ">
 <b>  2. ASSURE      </b>               {{ $Subscription['gender'] }} <br>

 <b> Nom </b>{{ $Subscription['name'] }} <b>Prénoms</b> {{ $Subscription['first_name'] }} <br>

 <b>Date de Naissance</b> {{ $Subscription['birth_date'] }}  <b>Lieu de Naissance</b>  {{ $Subscription['place_birth'] }} <br>

 <b>Situation Matrimoniale:</b>		{{  $Subscription['marital_status'] }}<br>

 <b>Lieu de Résidence :</b>    {{ $Subscription['place_residence'] }} <br>

 <b>Adresse Postale Personnelle</b>   {{ $Subscription['mailing_address'] }}  <b>Cellulaire</b> {{ $Subscription['phone1']}} / {{ $Subscription['phone2'] }}<br>

 <b>Email</b> {{ $Subscription['mail'] }}<br>

</p></p>
</b>

<p style="margin-top:1%; font-size:14px; font-family: Arial, Helvetica, sans-serif;">
  <b>  3. CARACTERISTIQUES </b> <br>
  <table  border="0.5px" style="width: 800px; margin-left:15%; font-size:14px; font-family: Arial, Helvetica, sans-serif;">
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
                <td> {{ $Subscription['equipmentLibelle'] }}</td>
                <td> {{ $Subscription['marquelibelle'] }}</td>
                <td> {{ $Subscription['modellibelle'] }}</td>
                <td> {{ $Subscription['numberIMEI'] }}</td>
                <td> {{ $Subscription['price'] }}</td>
                <td> {{ $Subscription['price'] }}</td>
            </tr>
    </tbody>
    </table>

    </p>

    <p style="margin-top:1%; font-size:14px; font-family: Arial, Helvetica, sans-serif;">
        <table border="0.5px" style="width: 800px; margin-left:15%; font-size:14px; font-family: Arial, Helvetica, sans-serif;" >
            <tr>
                <td colspan="4">
                 <b>   4. FORMULE </b>
                </td>
              </tr>
              <tr>
                <td colspan="4" style="background-color:rgba(190, 190, 190, 0.267) ">
                    <center>
                    <b>  Formule PREMIUM</b>
</center>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                 <b>  4. GARANTIE  </b>
                </td>
            </tr>

            <tr>
                    <td style="background-color:rgba(190, 190, 190, 0.267) ">
                        <center>
                     <b>   Date d’effet de la garantie</b>
                         </center>
                    </td>
                    <td colspan="3">
                        {{ $Subscription['date_subscription'] }}
                    </td>
            </tr>
            <tr >
                <td colspan="4">
                 <b>   5. PRIMES   </b>
                </td>
            <tr>
                <td style="background-color:rgba(190, 190, 190, 0.267) ">
                   <b> Coût Total équipement(s)</b>

            </td>
                <td>
                    {{ $Subscription['price'] }}
                </td>
                <td style="background-color:rgba(190, 190, 190, 0.267) ">
                  <p>  Prime  Total TTC </p>
                </td>
                <td>
                    {{ $Subscription['price']*0.10 }}
                </td>
            </tr>

        </table>
    </p>
    <p style="margin-top:1%; font-size:14px; font-family: Arial, Helvetica, sans-serif; line-height:20px; margin-left:3%; ">
      <b>  La police est constituée par :</b> <br>
<i>
     Les Conventions spéciales  extraites des Conditions Générales n°217 du 02 Avril 2001 et  Les présentes Conditions Particulières
</i>
<i>
    Ensemble de documents dont le Souscripteur reconnaît avoir reçu un exemplaire préalablement à la signature de son contrat. Conformément aux dispositions de l&#039article 13
    du Code CIMA, la prise d&#039effet de la police est subordonnée au paiement préalable de la prime. Le défaut de paiement de la prime emporte la résiliation de plein droit du contrat sans autre formalité.
    </i>
    </p>

    <p style="margin-top:1%; font-size:14px; font-family: Arial, Helvetica, sans-serif; margin-left:3%; ">
        Fait à Abidjan  le {{ $Subscription['date_subscription'] }} <br>

              Visa du Souscripteur	       		   		                                                                              Visa de l’Assureur


    </p>
<p style="height: 950px">
    <img src="{{ asset('dist/img/FicheNSIA2.jpg') }}"alt="">
</p>
            </body>
</html>

