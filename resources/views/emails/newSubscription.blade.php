<p style="margin-top:1%">
    <p style="border: 5px; margin-top:8%; font-size:14px; font-family: Arial, Helvetica, sans-serif; line-height:25px; margin-left:3%; ">
     <b>  2. ASSURE      </b>               {{ $subscription->gender }} <br>

     <b> Nom </b>{{ $subscription->name }} <b>Prénoms</b> {{ $subscription->first_name }} <br>

     <b>Date de Naissance</b> {{ $subscription->birth_date }}  <b>Lieu de Naissance</b>  {{ $subscription->place_birth }} <br>

     <b>Situation Matrimoniale:</b>		{{  $subscription->marital_status }}<br>

     <b>Lieu de Résidence :</b>    {{ $subscription->place_residence }} <br>

     <b>Adresse Postale Personnelle</b>   {{ $subscription->mailing_address }}  <b>Cellulaire</b> {{ $subscription->phone1}} / {{ $subscription->phone2 }}<br>

     <b>Email</b> {{ $subscription->mail }}<br>

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
                    <td> {{ $subscription->pack->first()->product->type->label}}</td>
                    <td> {{ $subscription->pack->first()->product->label->label }}</td>
                    <td> {{ $subscription->pack->first()->product->model->label }}</td>
                    <td> {{ $subscription->numberIMEI }}</td>
                    <td> {{ $subscription->price }}</td>
                    <td> {{ $subscription->price }}</td>
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
                            {{ $subscription->date_subscription }}
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
                        {{ $subscription->price }}
                    </td>
                    <td style="background-color:rgba(190, 190, 190, 0.267) ">
                      <p>  Prime  Total TTC </p>
                    </td>
                    <td>
                        {{ $subscription->price*0.10 }}
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
            Fait à Abidjan  le {{ $subscription->date_subscription }} <br>

                  Visa du Souscripteur	       		   		                                                                              Visa de l’Assureur


        </p>
    <p style="height: 950px">
        <img src="{{ asset('dist/img/FicheNSIA2.jpg') }}"alt="">
    </p>
