@extends('shared.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary  shadow-sm ">

                        <div class="card-body">
                                <div class="tab-content" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                        <div class="tab-custom-content">
                                            <p class="lead mb-0">TABLEAU DE BORD DES SOUSCRIPTIONS</p>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <object data="{{ asset('storage/statistics/statistics.pdf') }}"  type="application/pdf" width="100%" height="875">
                                                </object>
                                            </div>

                                        </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <a class="btn btn-warning" href="{{ route('statistics.etat') }}">IMPRIMER</a>

                                        </div>
                                        <div class="col-md-3">
                                            <a class="btn btn-secondary" href="{{ route('statistics.excel') }}">Exporter en Excel</a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
        </div>

</section>


@endsection
