
<h2>Nouvelle Proforma</h2>
<p>Bonjour {{$subscription['gender'] }} {{$subscription['name'] }} {{$subscription['first_name'] }}, <br>
Veuillez trouver ci joint la proforma de votre souscription à NSIA SMARTY.
</p>
<p>{{ __("Veuillez s'il vous plait valider ou rejeter la demande de souscription à NSIA SMARTY.") }}
</p>
<table style="width: 100%">
    <tr>
        <td style="text-align: right">
            <a href={{ route('subscription.demand.validate', ['demand'=>"D-".$subscription['folder']]) }} style="background-color: green; color: white;padding: 3px">VALIDER</a>
        </td>
        <td style="text-align: left">
            <a href={{ route('subscription.demand.cancel', ['demand'=>"D-".$subscription['folder']]) }} style="background-color: red; color: white;padding: 3px">REJETER</a>

        </td>
    </tr>
</table>
<p>NSIA ASSURANCES VOUS REMERCIE.</p>
