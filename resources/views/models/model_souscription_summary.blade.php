<html style=" padding: 0px; margin:0px">
    <head>
        <TItle></TItle>
<style>
    signature {
        position: fixed; 
        bottom: 3cm; 
        right: 1cm;
        height: 2.5cm;
        width:  7cm;
margin: 0cm;
        /** Extra personal styles **/
     
    }
</style>
    </head>
    
 <body  style=" background-image: url('{{ asset('dist/img/model3n.jpg') }}'); background-repeat: no-repeat; background-size: 100% 100%; padding: 0px; margin:0px">
    <div style=" position: relative; width:800px; padding:0px; margin-left:1.5cm; top:2cm">
    <table  >
            <tr>
                <td> </td>
                <td style="text-align: center">
                    CONTRAT N°:{{$Subscription['folder']}} <br>
                    PDV :{{$Subscription['libellepdv']}}
                </td>
            </tr>
                <tr>
                    <td colspan="2"  style="margin-left: 80%">
                    <center> <span style="font-family: Arial, Helvetica, sans-serif; color: #120d74;; font-size:16px"><H1>PROFORMA <br> NSIA SMARTY</H1></span></center>
                    </td>

                </tr>
                //info client
                <tr >
                    <td colspan="2" style="text-align: center">
                        <h3 style="color: #120d74">   <span>INFORMATION CLIENT</span> </h3>
                    </td>
                </tr>
                <tr style="text-align: left";>
                <td>FORMULE  @switch($Subscription['formula'])
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
                @endswitch : </td>
                <td>NOUVELLE SOUSCRIPTION</td>
                <tr>
                    <td>Nom & Prénoms :</td>
                    <td> <?php echo $Subscription['name'].' '.$Subscription['first_name']; ?> </td>
                </tr>
                <tr>
                    <td>Téléphone :</td>
                    <td> <?php echo $Subscription['phone1']?></td>
                </tr>
                <tr>
                    <td>Mail :</td>
                    <td><?php echo $Subscription['mail']?></td>
                </tr>
                <tr>
                    <td>Date & lieu de naissance :</td>
                    <td><?php echo "Né le " .$Subscription['birth_date'].'  à '.$Subscription['place_birth']?></td>
                </tr>
                <tr>
                    <td>Situation Matrimoniale :</td>
                    <td><?php echo $Subscription['marital_status']?></td>
                </tr>
                <tr>
                    <td>Lieu de résidence :</td>
                    <td><?php echo $Subscription['place_residence']?></td>
                </tr>
                //info equipement

                <tr>
                    <td colspan="2" style="text-align: center">
                        <h3 style="color: #120d74">   <span>INFORMATION EQUIPEMENT</span> </h3>
                    </td>
                </tr>
                <tr>
                <td>Nature : </td>
                <td> <?php echo $Subscription['equipmentLibelle'] ?></td>
                <tr>
                    <td>Marque :</td>
                    <td><?php echo $Subscription['marquelibelle']. " ".$Subscription['modellibelle']?></td>
                </tr>
                <tr>
                    <td>Numéro identifiant (IMEI) :</td>
                    <td> <?php echo $Subscription['numberIMEI']?></td>
                </tr>
                <tr>
                    <td>Date effet de garantie :</td>
                    <td><?php echo $Subscription['date_subscription']?></td>
                </tr>
                <?php
            $madate= $Subscription['date_subscription'];
            list($annee,$mois,$jour)=sscanf($madate,"%d-%d-%d");
            $annee+=1;

            if (strlen($mois)===1) {
                $mois ='0'.$mois;
            }else {
                $mois =$mois;
            }
            if (strlen($jour)===1){
                $jour ='0'.$jour;
            }else {
                $jour =$jour;
            }


            $new_date=$annee.'-'.$mois.'-'.$jour;



            ?>
                <tr>
                    <td>Date fin de garantie :</td>
                    <td><?php echo $Subscription['subscription_enddate'] ;?></td>
                </tr>
                <tr>
                    <td>Valeur Achat :</td>
                    <td><?php echo $Subscription['price'].' FCFA'?></td>
                </tr>
            <tr style="height: 25px">
                <td></td>
                <td></td>
            </tr>
                <tr    style=" color:#000000; font-size: 16px; ">
                    <td colspan="2"  style="padding: 3px; ">
            La police est constituée par : <br>
            <i> <b>
            Les Conventions spéciales extraites des Conditions Générales n°217 du 02 Avril 2001 et Les présentes  <br>ConditionsParticulières
            </b></i>  </td>
                </tr>
                <tr style="height: 25px">
                    <td></td>
                    <td></td>
                </tr>
                <tr style="width:75%; color:#000000; font-size: 13px">
                    <td colspan="2" >
                    <i>
            Ensemble de documents dont le Souscripteur reconnaît avoir reçu un exemplaire préalablement à la signature de son contrat.<br> Conformément aux dispositions de l&#039article 13
            du Code CIMA, la prise d&#039effet de la police est subordonnée au paiement préalable de la <br> prime. Le défaut de paiement de la prime emporte la résiliation de plein droit du contrat sans autre formalité.
                </i>  </td>
                </tr>

                <tr style="color: red; ">
                <td> <b>
                VOTRE PRIME :</b>
                    </td>
                    <td><b> <?php echo $Subscription['premium'].' FCFA' ;?> </b></td>

                </tr>


    </table>
</div>
            </body>
</html>

