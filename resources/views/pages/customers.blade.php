@extends('shared.layout')
@section('subscription')
active
@endsection
@section('operation')
menu-open active
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-warning  shadow-sm ">
                    <div class="card-header p-0 pt-1" >
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link  {{ (($errors->any())) ? 'active' : 'active'}}  " id="custom-content-above-other-tab" data-toggle="pill" href="#custom-content-above-other" role="tab" aria-controls="custom-content-above-other" aria-selected="true" disabled >NOUVELLE SOUSCRIPTION</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">



                                        <div class="tab-pane {{ (($errors->any())) ? 'show active' : 'show active'}}" id="custom-content-above-other" role="tabpanel" aria-labelledby="custom-content-above-other-tab">
                                            <div class="tab-custom-content">
                                                <p class="lead mb-0">INFORMATION CLIENT
                                                </p>

                                                <hr>
                                            </div>
                                            @include('partials.form_customer')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            @endsection
