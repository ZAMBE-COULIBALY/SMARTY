@extends('shared.layout')
@section('subscription')
    active
@endsection
@section('sinister_menu')
menu-open active
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary  shadow-sm ">
                        <div class="card-header p-0 pt-1 " style="background-color:#120d74; ">
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">DOCUMENT </a>
                                    </li>
                            </ul>
                        </div>
                        <div class="card-body">
                                <div class="tab-content" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                        <div class="tab-custom-content">
                                            <p class="lead mb-0" >{{ __("BON D'INDEMNISATION")}}</p>
                                                        <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <object data="{{ asset('storage/voucher/'.$sinister->folder.$sinister->id.'.pdf') }}"  type="application/pdf" width="100%" height="500">
                                                </object>
                                            </div>

                                            <div class="row col-md 4">

                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
        </div>

</section>


@endsection
