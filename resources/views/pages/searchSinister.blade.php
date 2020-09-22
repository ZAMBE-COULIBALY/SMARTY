@extends('shared.layout')
@section('sinister_decla')
    active
@endsection
@section('sinister_menu')
    menu-open active
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row" >

            <div class="col-6 col-sm-6" style=" margin:10% 0 0 25%" >
                <div class="card card-primary  shadow-sm ">
                    <div class="card-header p-0 pt-1" style="background-color:#120d74; ">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-above-other-tab" data-toggle="pill" href="#custom-content-above-other" role="tab" aria-controls="custom-content-above-other" aria-selected="false">DECLARATION DE SINISTRE</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">

                            <div class="tab-pane fade show active " id="custom-content-above-other" role="tabpanel" aria-labelledby="custom-content-above-other-tab">

                                @include('partials.form_searchSinister')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection

