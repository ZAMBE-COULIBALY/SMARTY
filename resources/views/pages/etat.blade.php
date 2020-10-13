@extends('shared.layout')
@section('statistiques')
    active
@endsection
@section('operation')
    menu-open active
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>
            STATISTIQUES -
        </h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Statistiques</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card  shadow-sm ">

                    <div class="card-body">

                        <div class="tab-content" id="custom-content-above-tabContent">

                           <div class="row">
                                @include('partials.form_etat')
                                @isset($collection)
                                <div class="col-md-12" id="details">
                                    <table class="table table-sm compact table-bordered table-striped table-responsive" id="detailslist" >

                                        <thead>
                                            <tr>
                                                <th>Contrat N°</th>
                                                <th>Civilité</th>
                                                <th>Noms & Prénoms</th>
                                                <th>Date de naissances</th>
                                                <th>Contact</th>
                                                <th>Lieu résidence</th>
                                                <th>Equipement</th>
                                                <th>Marque</th>
                                                <th>Modèle</th>
                                                <th>IMEI</th>
                                                <th>{{__("Date d'effet")}}</th>
                                                <th>Date de fin</th>
                                                <th>{{__("Prix d'achat")}}</th>
                                                <th>SMARTY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($collection as $item)
                                                <tr>
                                                    <td> {{ $item->code }}</td>
                                                    <td> {{ $item->customer->gender }} </td>
                                                    <td> {{ $item->customer->name }} {{ $item->customer->first_name }} </td>
                                                    <td> {{ $item->customer->birth_date }} </td>
                                                    <td> {{ $item->customer->phone1 }} </td>
                                                    <td> {{ $item->customer->place_residence }}</td>
                                                    <td> {{ $item->pack->first()->product->type->label }} </td>
                                                    <td> {{ $item->pack->first()->product->label->label }} </td>
                                                    <td> {{ $item->pack->first()->product->model->label}} </td>
                                                    <td> {{ $item->numberIMEI }} </td>
                                                    <td> {{ $item->date_subscription }}</td>
                                                    <td> {{ $item->subscription_enddate }}</td>
                                                    <td> {{ $item->price }} </td>
                                                    <td> {{ $item->premium}} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endisset
                                  

                            </div>
                        </div>

                    </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>

@endsection

