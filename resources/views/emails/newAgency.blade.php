
    <h2>Nouveau PDV</h2>
<p>Votre Point de vente a été créé avec les informations suivantes :</p>

<span ><strong>Code :</strong>  </span> {{ $agency->code }} <br>
<span ><strong>Nom : </strong> </span> {{ $agency->label }} <br>
<span ><strong>Email  : </strong></span> {{ $agency->email }} <br>
<span ><strong>Adresse  : </strong></span> {{ $agency->address }} <br>
<span ><strong>Contact : </strong> </span> {{ $agency->contact }} <br>

<p>Trouvez ci après les accès concernant le compte utilisateur pour la gestion de votre PDV. </p>
<span > Partenaire : </span> {{ $agency->partner->label }} <br>
<span > Login : </span> {{ $agencyChief->username }} <br>
<span > Mot de passe : </span> {{ $agencyChiefUserPass }}
<p>N.B.: Le mot de passe pourra être modifié dès la première connexion</p>
