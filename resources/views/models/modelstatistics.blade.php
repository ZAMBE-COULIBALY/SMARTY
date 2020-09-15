<html>
    <head>
        <TItle></TItle>

    </head>
 <body >
    <div class="row">
        <div class="col-md-3">
            <img src="{{ asset('dist/img/NSIA.PNG') }}" alt="" >
        </div>
        <div class="col-md-3">
            <center style="margin-top:-20% ">
                    <span style="font-family: Arial, Helvetica, sans-serif; color: #120d74;; font-size:16px;"> <H1> NSIA SMARTY</H1></span>
            </center>
            <center style="margin-top:-5% ">
                <span style="font-family: Arial, Helvetica, sans-serif; color: #120d74;; font-size:16px;"> <h4> TABLEAU DE BORD DES SOUSCRIPTIONS </h4> </span>
            </center>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
    <table  style="width: 1050px; font-size:10px; font-family: Arial, Helvetica, sans-serif;" >
        <thead>
            <tr >
                <th>Contrat N°</th>
                <th>Civilité</th>
                <th>Noms & Prénoms</th>
                <th>Date de naissances</th>
                <th>Contact 1</th>
                <th>Contact 2</th>
                <th>Lieu résidence</th>
                <th>Equipement</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>IMEI</th>
                <th>Date d&#039effet</th>
                <th>Date de fin</th>
                <th>Prix d&#039achat</th>
                <th>SMARTY</th>
            </tr>
        </thead>
        @foreach ($users as $item)


            <tr>
            <td> {{ $item->folder }}</td>
            <td> {{ $item->gender }} </td>
            <td> {{ $item->name }} {{ $item->first_name }} </td>
            <td> {{ $item->birth_date }} </td>
            <td> {{ $item->phone1 }} </td>
            <td> {{ $item->phone2 }} </td>
            <td> {{ $item->place_residence }}</td>
            <td> {{ $item->equipment }} </td>
            <td> {{ $item->mark }} </td>
            <td> {{ $item->model}} </td>
            <td> {{ $item->numberIMEI }} </td>
            <td> {{ $item->date_subscription }}</td>
            <td> </td>
            <td> {{ $item->price }} </td>
            <td> {{ $item->price* 0.10}} </td>

        </tr>

        @endforeach
    </table>
</div>
</div>


</body>
</html>

