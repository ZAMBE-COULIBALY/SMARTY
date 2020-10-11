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
                <div class="card card-primary  shadow-sm ">
                    <div class="card-header p-0 pt-1" style="background-color:#120d74; ">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ ($errors->any()) ? '' : 'active'}}" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="false">HISTORIQUE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{ (($errors->any())) ? 'active' : ''}}  " id="custom-content-above-other-tab" data-toggle="pill" href="#custom-content-above-other" role="tab" aria-controls="custom-content-above-other" aria-selected="true" disabled >NOUVELLE SOUSCRIPTION</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">

                          <div class="tab-pane fade show {{ ($errors->any()) ? '' : 'show active'}}" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">Liste des souscriptions



                                    </p>

                                    <hr>
                                </div>

                                <table id="customerslist" class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th >CODE</th>
                                            <th >CLIENT</th>
                                            <th >IDENTIFIANT EQUIPEMENT</th>
                                            <th >{{ __("PERIODE D'EFFET")}}</th>
                                            {{--  <th >ACTION</th>  --}}
                                        </tr>
                                    </thead>
                                    <tbody >

                                    @foreach($hsubscription as $subscription)
                                    @switch($subscription->currentState())
                                        @case(3)
                                        <tr class="p-3 mb-2 bg-danger text-white">

                                            @break
                                        @case(2)
                                        <tr class="p-3 mb-2 bg-warning text-white">

                                            @break
                                        @case(1)
                                        <tr class="p-3 mb-2 bg-success text-white">

                                            @break
                                        @default
                                        <tr class="p-3 mb-2 bg-secondary text-white">

                                    @endswitch


                                        <td> {{ $subscription->code }} </td>
                                        <td>{{ $subscription->customer->name }} {{ $subscription->customer->first_name }} </td>
                                        <td>{{ $subscription->numberIMEI }} </td>
                                        <td>{{ $subscription->date_subscription }} / {{ $subscription->subscription_enddate }} </td>
                                        {{--  <td>
                                            <center>
                                                <a href="#"  class="btn btn-info btn-sm ">
                                                    <i class="fa fa-pencil-alt"> VOIR</i>
                                                </a>
                                 </center>
                                        </td>  --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>



                            </div>

                            <div class="tab-pane {{ (($errors->any())) ? 'show active' : ''}}" id="custom-content-above-other" role="tabpanel" aria-labelledby="custom-content-above-other-tab">
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
