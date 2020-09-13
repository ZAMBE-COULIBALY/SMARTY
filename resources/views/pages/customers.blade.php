@extends('shared.layout')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary  shadow-sm ">
                    <div class="card-header p-0 pt-1" style="background-color:#120d74; ">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ isset($histosubcription) ? '' : 'active'}}" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="false">HISTORIQUE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link   {{ isset($histosubcription) ? 'active' : ''}} " id="custom-content-above-other-tab" data-toggle="pill" href="#custom-content-above-other" role="tab" aria-controls="custom-content-above-other" aria-selected="true" disabled >NOUVELLE SOUSCRIPTION</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">

                          <div class="tab-pane fade show  {{ isset($histosubcription) ? '' : 'active'}}" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">Liste des souscriptions |

                                        <a href="{{ route('subscription.customer') }}"  class="btn btn-success btn-sm">
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
                                            <th >ENGIN</th>
                                            <th >PERIODE D&#039EFFET</th>
                                            <th >ACTION</th>
                                        </tr>
                                    </thead>
                                    @foreach($hsubscription as $subscription)
                                    @php
                                    $date= date_format(date_create(now()),'d-m-Y');
                                    $jour= date_format(date_create($subscription->date_subscription),'d-m-Y') ;
                                    $date1=strtotime($date);
                                    $date2 =strtotime($jour);
                                    $resultat=$date1 - $date2;
                                    $nbJours = ($resultat/86400);
                                        if ($nbJours <= 90) {
                                        $color ="p-3 mb-2 bg-success text-white";
                                        }elseif ($nbJours >= 91 && $nbJours <=180) {
                                                $color ="p-3 mb-2 bg-warning text-dark";
                                        }elseif ($nbJours >= 181 && $nbJours <365) {
                                                        $color= "p-3 mb-2 bg-danger text-white";
                                        }else {
                                                            $color = "p-3 mb-2 bg-secondary text-white";
                                          };

                                    @endphp

                                    <tbody class="{{$color}}";>
                                        <td> {{ $subscription->code }} </td>
                                        <td>{{ $subscription->customer_id }} </td>
                                        <td>{{ $subscription->numberIMEI }} </td>
                                        <td>{{ $subscription->date_subscription }} </td>
                                        <td>
                                            <center>
                                                <a href="#"  class="btn btn-info btn-sm ">
                                                    <i class="fa fa-pencil-alt"> VOIR</i>
                                                </a>
                                 </center>
                                        </td>
                                    </tbody>
                                    @endforeach
                                </table>



                            </div>

                            <div class="tab-pane fade  " id="custom-content-above-other" role="tabpanel" aria-labelledby="custom-content-above-other-tab">
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
