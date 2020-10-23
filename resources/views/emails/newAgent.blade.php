
    <h2>Nouvel Agent</h2>
<p>{{__("Votre compte agent a été créé pour l'agence avec les informations suivantes :")}}</p>

<span ><strong>Nom : </strong> </span> {{ $agentAgency->label }} <br>
<span ><strong>Email  : </strong></span> {{ $agentAgency->email }} <br>
<span ><strong>Adresse  : </strong></span> {{ $agentAgency->address }} <br>
<span ><strong>Contact : </strong> </span> {{ $agentAgency->contact }} <br>

<span > {{ _("Lien d'accès à l'application :") }} </span> <a href="{{ route("login") }}">  NSIA SMARTY </a> 

<p>Trouvez ci après les accès concernant le compte utilisateur. </p>
<span > Partenaire : </span> {{ $agentAgency->partner->label }} <br>
<span > Login : </span> {{ $agent->username }} <br>
<span > Mot de passe : </span> {{ $agentUserPass }}
<p>N.B.: Le mot de passe pourra être modifié dès la première connexion</p>
