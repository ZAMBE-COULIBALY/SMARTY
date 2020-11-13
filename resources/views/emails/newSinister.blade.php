
    <h2>Nouvelle déclaration de Sinistre</h2>
    <p>{{__("Les informations afférentes au sinistre sont les suivantes :")}}</p>

    <span ><strong>Partenaire :</strong>  </span> {{ $agent->agency->partner->label }} <br>
    <span ><strong>Agence Emettrice : </strong> </span> {{$agent->agency->label }} <br>
    <span ><strong>Emetteur : </strong> </span> {{ $agent->firstname.' '.  $agent->lastname }} <br>
    <span ><strong>Email  : </strong></span> {{ $agent->user->email }} <br>
    <span ><strong>Adresse  : </strong></span> {{ $agent->agency->address }} <br>
    <span ><strong>Contact : </strong> </span> {{ $agent->agency->contact }} <br>
    <span ><strong>N° Sinistre : </strong> </span> {{ $sinister->code }} <br>
    <span ><strong>Nom et Prenom souscripteur : </strong> </span> {{$sinister->subscription->customer->name}} {{$sinister->subscription->customer->first_name}} <br>
    <span ><strong>Contact souscripteur : </strong> </span> {{$sinister->subscription->customer->phone1}} <br>
    <span ><strong>Date declaration sinistre : </strong> </span> {{ date_format($sinister->created_at,"d/m/Y") }} <br>
    <span ><strong>Reference equipement : </strong> </span> {{ $sinister->subscription->numberIMEI}} <br>

    <span > {{ _("Lien d'accès à l'application :") }} </span> <a href="{{ route("login") }}">  NSIA SMARTY </a> 

    <P> <h5>DESCRIPTION</h5> <br>
        {{ $sinister->description }}
    </P>

    