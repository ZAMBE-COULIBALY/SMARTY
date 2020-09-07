
    <h2>Nouvel Agent</h2>
<p>{{__("Votre compte agent a été créé pour l'agence avec les informations suivantes :")}}</p>

<span ><strong>Code :</strong>  </span> {{ $agentAgency->code }} <br>
<span ><strong>Nom : </strong> </span> {{ $agentAgency->label }} <br>
<span ><strong>Email  : </strong></span> {{ $agentAgency->email }} <br>
<span ><strong>Adresse  : </strong></span> {{ $agentAgency->address }} <br>
<span ><strong>Contact : </strong> </span> {{ $agentAgency->contact }} <br>

<p>Trouvez ci après les accès concernant le compte utilisateur. </p>
<span > Login : </span> {{ $agent->username }} <br>
<span > Mot de passe : </span> {{ $agentUserPass }}
<p>N.B.: Le mot de passe pourra être modifié dès la première connexion</p>
