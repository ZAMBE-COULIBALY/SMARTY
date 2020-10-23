
    <h2>Nouveau Gestionnaire sinistres</h2>
<p>{{__("Votre compte de gestionnaire sinistre a été créé avec les informations suivantes :")}}</p>

<span ><strong>Nom et prenom(s): </strong> </span> {{ $claimsManager->lastname.' '.$claimsManager->firstname  }} <br>
<span ><strong>Email  : </strong></span> {{ $claimsManagerUser->email }} <br>
<span ><strong>Contact : </strong> </span> {{ $claimsManager->contact }} <br>

<span > {{ _("Lien d'accès à l'application :") }} </span> <a href="{{ route("login") }}">  NSIA SMARTY </a> 

<p>Trouvez ci après les accès concernant le compte utilisateur. </p>
<span > Login : </span> {{ $claimsManager->username }} <br>
<span > Mot de passe : </span> {{ $claimsManagerUserPass }}
<p>N.B.: Le mot de passe pourra être modifié dès la première connexion</p>



