
    <h2>Nouveau Partenaire</h2>
<p>Votre compte partenaire a été créé avec les informations suivantes :</p>

<span ><strong>Nom : </strong> </span> {{ $partner->label }} <br>
<span ><strong>Email  : </strong></span> {{ $partner->email }} <br>
<span ><strong>Contact : </strong> </span> {{ $partner->contact }} <br>

<span > {{ _("Lien d'accès à l'application :") }} </span> <a href="{{ route("login") }}">  NSIA SMARTY </a> 

<p>Trouvez ci après les accès concernant le compte utilisateur pour la gestion de vos PDV. </p>
<span > Partenaire : </span> {{ $partner->label }} <br>
<span > Login : </span> {{ $partnerManager->username }} <br>
<span > Mot de passe : </span> {{ $partnerManagerUserPass }}
<p>N.B.: Le mot de passe pourra être modifié dès la première connexion</p>
