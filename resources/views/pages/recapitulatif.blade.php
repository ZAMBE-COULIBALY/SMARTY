@extends('shared.layout')

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
                                            <div class="col-md-7">
                                                <object data="{{ asset('storage/invoices/'.$Subscription['first_name'].'.pdf') }}"  type="application/pdf" width="100%" height="875">
                                                </object>
                                            </div>

                                            <div class="row col-md 4">
                                                <table style="width: 100%">
                                                <tr>
                                                    <td style="text-align: center">

                                                            <P style="font-size: 14; "><stong> MONTNAT PRIME :<?php echo $Subscription['price']*0.10 ;?> Francs CFA</strong></P> </div>
                                                    </td>
                                                <tr>
                                                <td style="text-align: center">
                                                    <p>Moyen de paiement</p>
                                                    <input type="radio" value="1" checked id="paymenttype" name="paymenttype">Caisse<br>
                                                    <input type="radio" value="2" id="paymenttype" name="paymenttype">Mobile<br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">

                                    <form  method="POST" action="{{ route('subscription.storecustomer') }}">
                                        @csrf


                                                    <button type="submit" class="btn btn-success">PAYER LA PRIME</button>
                                                    <a class="btn btn-danger" href="{{ route('subscription.customer') }}">ANNULE SOUSCRIPTION</a>
                                                    <a class="btn btn-warning" href="{{ route('subscription.proforma') }}">IMPRIMER</a>
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
