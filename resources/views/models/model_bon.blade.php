<html>
    <head>
        <TItle></TItle>
    </head>
    <body  style=" background-image: url('{{ asset('dist/img/models.jpg') }}'); margin:0%">

        <table  style=" width:850px;margin-left:35% color:#120d74">
            <tr>
                <td >

                </td>
                <td style="margin-left: 80%">
                    <center> <span style="font-family: Arial, Helvetica, sans-serif; color: #120d74;; font-size:16px"><H1> BON D&#039INDEMNISATION SMARTY</H1></span></center>
                </td>

            </tr>
            //info client
            <tr >
                <td colspan="2" style="text-align: center">
                    <h3 style="color: #120d74">   <span>INFORMATION CLIENT</span> </h3>
                </td>
            </tr>
            <tr style="text-align: left";>
            <td>FORMULE PREMIUM : </td>
            <td>REMPLACEMENT</td>
            <tr>
                <td>Nom & Prénoms :</td>
                <td> {{$sinister->subscription->customer->name}} {{$sinister->subscription->customer->first_name}} </td>
            </tr>
            <tr>
                <td>Téléphone :</td>
                <td> {{$sinister->subscription->customer->phone1}}</td>
            </tr>
            <tr>
                <td>Mail :</td>
                <td>{{$sinister->subscription->customer->mail}}</td>
            </tr>
            <tr>
                <td>Date & lieu de naissance :</td>
                <td>Né le  {{$sinister->subscription->customer->birth_date}} à {{$sinister->subscription->customer->place_birth}}</td>
            </tr>
            <tr>
                <td>Situation Matrimoniale :</td>
                <td>{{$sinister->subscription->customer->marital_status}}</td>
            </tr>
            <tr>
                <td>Lieu de résidence :</td>
                <td>{{$sinister->subscription->customer->place_residence}}</td>
            </tr>
            //info equipement

            <tr>
                <td colspan="2" style="text-align: center">
                    <h3 style="color: #120d74">   <span>INFORMATION EQUIPEMENT</span> </h3>
                </td>
            </tr>
            <tr>
            <td>Nature : </td>
            <td> {{$sinister->subscription->equipment}}</td>
            <tr>
                <td>Marque :</td>
                <td>{{$sinister->subscription->mark}}</td>
            </tr>
            <tr>
                <td>Numéro identifiant (IMEI) :</td>
                <td> {{ $sinister->subscription->numberIMEI}}</td>
            </tr>
            <tr>
                <td>VALEUR DE SOUSCRIPTION :</td>
                <td>{{$sinister->subscription->price}}</td>
            </tr>

            <tr>
                <td>BON D&#039INDEMNISATION SMARTY D&#039UNE VALEUR DE :</td>
                <td>{{$sinister->subscription->premium}}</td>
            </tr>
            <tr>
                <td colspan="2" style="color: red; ">
                <b> NB: CE BON VALABLE NE PEUT ETRE ECHANGE CONTRE DE L&#039ESPECES </b>
                </td>
            </tr>

            <tr>
                <td> BON N°: </td>
                <td></td>
            </tr>
            <tr>
                <td> Emis par:
                </td>
                <td> Pour NSIA ASSURANCES
                </td>
            </tr>
            <tr>
                <td>Le  </td>
                <td> à </td>
            </tr>
        </table>
    </body>
</html>

