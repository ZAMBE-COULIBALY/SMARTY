@extends('shared.layout')
@section('subscription')
    active
@endsection
@section('operation')
    menu-open active
@endsection
@section('content')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>
                SOUSCRIPTION
                <small></small>
            </h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Administration</li>
                <li class="breadcrumb-item active"><a href={{ route('subscription.list') }}>Souscriptions</a></li>
            </ol>
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card   shadow-sm " >
                        <div class="card-header bg-nsia-blue p-0 pt-1" >
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-above-demands-tab" data-toggle="pill" href="#custom-content-above-demands" role="tab" aria-controls="custom-content-above-demands" aria-selected="true">DEMANDES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">SOUSCRIPTIONS</a>
                            </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-content-above-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-above-demands" role="tabpanel" aria-labelledby="custom-content-above-demands-tab">
                                    <div class="tab-custom-content">
                                        <p class="lead mb-0">Liste des Demandes en cours |

                                            <a href="{{ route('subscription.customer') }}"  class="btn btn-success btn-sm">
                                                NOUVEAU
                                                <i class=" fa fa-edit"></i>
                                            </a>
                                        </p>

                                        <hr>
                                    </div>
                                    <table id="demandslist" class="table table-bordered list ">
                                        <thead>
                                            <tr>
                                                <th >NUMERO</th>
                                                <th >CLIENT</th>
                                                <th >DATE</th>
                                                <th >STATUT</th>
                                                 <th >ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($demands as $item)
                                            <tr>

                                                <td> {{ $item->number }} </td>
                                                <td>  {{ $item->detail("name") }} </td>
                                                <td>  {{  $item->detail("dat") }}</td>
                                                <td>
                                                    @switch($item->state)
                                                        @case(0)
                                                            EN ATTENTE
                                                            @break
                                                        @case(1)
                                                            VALIDE
                                                            @break
                                                        @default
                                                            REJETE
                                                    @endswitch

                                                </td>
                                                 <td>
                                                    @switch($item->state)
                                                    @case(0)

                                                        @break
                                                    @case(1)
                                                    <center>
                                                        <a href={{ route('subscription.recapitulatif', ['demand'=>$item->number]) }} class="btn btn-primary btn-sm ">
                                                            <i class="fa fa-pencil-alt"> REGLER</i>
                                                        </a>
                                                    </center>
                                                        @break
                                                    @default

                                                @endswitch

                                                </td>
                                            </tr>
                                            @endforeach


                                                    </tbody>
                                                </table>
                                </div>
                                <div class="tab-pane fade" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                    <div class="tab-custom-content">
                                        <p class="lead mb-0">Liste des souscriptions |

                                            <a href={{ route('subscription.customer') }}  class="btn btn-success btn-sm">
                                                NOUVEAU
                                                <i class=" fa fa-edit"></i>
                                            </a>
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
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

