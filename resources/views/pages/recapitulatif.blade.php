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
                        <div class="card-header p-0 pt-1 " style="background-color:#120d74; ">
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">NOUVELLE SOUSCRIPTION</a>
                                    </li>
                            </ul>
                        </div>
                        <div class="card-body">
                                <div class="tab-content" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                        <div class="tab-custom-content">
                                            <p class="lead mb-0">Porforma</p>
                                                        <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <object data="{{ asset('storage/invoices/'.$Subscription['first_name'].$Subscription['phone1'].'.pdf') }}"  type="application/pdf" width="100%" height="875">
                                                </object>
                                            </div>

                                            <div class="row col-md 4">
                                                <table style="width: 100%">
                                                <tr>
                                                    <td style="text-align: center">

                                                            <P style="font-size: 14; "><stong> MONTNAT PRIME :<?php echo $Subscription['premium']?> Francs CFA</strong></P> </div>
                                                    </td>
                                                <tr>
                                                    <td style="text-align: center">
                                                        <p>Moyen de paiement</p>
                                                        @switch($connectedagent->partner->paymode)
                                                            @case(1)
                                                            <input class="form-check-input" type="radio" value="2" checked id="paymenttype" name="paymenttype">Mobile<br>

                                                                @break
                                                            @case(2)
                                                            <input class="form-check-input" type="radio" value="1" checked id="paymenttype" name="paymenttype">Caisse<br>

                                                                @break
                                                            @default

                                                        @endswitch
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">

                                    <form id="form"  method="POST" action="{{ ($connectedagent->partner->paymode == 1 ) ? "https://secure.cinetpay.com" : route('subscription.storecustomer') }}">
                                        @csrf
                                            @foreach ($_POST as $item => $s)
                                                <input type="hidden" class="form-control" placeholder="{{ $item}}" id="{{ $item}}" name="{{ $item}}" value="{{$_POST[$item]}}">
                                            @endforeach
                                        <input type="hidden" class="form-control" placeholder="cpm_trans_date" id="cpm_trans_date" name="cpm_trans_date" value="{{$date}}">

                                                    <button type="submit" class="btn btn-success">PAYER LA PRIME</button>
                                                    <a class="btn btn-danger" href="{{ route('subscription.customer') }}">ANNULER SOUSCRIPTION</a>
                                                    {{--  <a class="btn btn-warning" href="#">IMPRIMER</a>  --}}
                                    </form>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
        </div>

</section>
@endsection
@section('script')
    <script>

        $('input[name="paymenttype"]').on('change', function(e) {
            console.log('change');

            var manageradiorel = e.target.value;
            console.log(manageradiorel);
            switch(manageradiorel){
                case "1":
                $('#form').attr("action", "{{ route('subscription.storecustomer') }}");
                console.log('case 1')
                    break;
                case "2":
                $('#form').attr("action", "https://secure.cinetpay.com");
                console.log('case 2')

                    break;

                default:
                console.log('case def')

                    break;

            }

        });

        $(document).ready(function() {
            var manageradiorel = "{{ $connectedagent->partner->paymode }}";
            console.log(manageradiorel);
            switch(manageradiorel){
                case "2":
                $('#form').attr("action", "{{ route('subscription.storecustomer') }}");
                console.log('case 2')
                    break;
                case "1":
                $('#form').attr("action", "https://secure.cinetpay.com");
                console.log('case 1')

                    break;

                default:
                console.log('case def')

                    break;
                }

        });

        </script>
@endsection
