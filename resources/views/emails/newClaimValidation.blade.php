<h2>Status de votre déclaration de Sinistre</h2>
<p>{{__("Bonjour")}}</p> <span >  </span> <strong>{{ $sinister->agent->firstname.' '.  $sinister->agent->lastname }}</strong> . 
{{__("Votre déclaration de sinistre ")}} <span ><strong>N° : </strong> </span> {{ $sinister->code }}<br>
{{__("a été correctement traitée par le gestionnaire des sinistres NSIA SMARTY.")}}
<{{__("Le statut de votre déclaration est le suivant : ")}} <span ><strong>Statut Sinistre : </strong> </span> @switch($sinister->state)
    @case(1)
            VALIDE
            <p>{{__("Veuillez-vous connecter pour éditer le bon d’indemnisation.")}}</p>
        @break
    @case(-1)
            REFUSE
        @break
    @default
        EN ATTENTE
@endswitch <br>
<span > {{ _("Lien d'accès à l'application :") }} </span> <a href="{{ route("login") }}">  NSIA SMARTY </a> <br>
{{__("NSIA SMARTY VOUS REMERCIE.")}}</p>
