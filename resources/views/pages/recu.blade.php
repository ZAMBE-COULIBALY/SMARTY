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
                        <div class="card-header p-0 pt-1 " >
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">NOUVELLE SOUSCRIPTION</a>
                                    </li>
                            </ul>
                        </div>


                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success')}}</div>
                            @endif

                        <div class="card-body">
                                <div class="tab-content" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                        <div class="tab-custom-content">
                                            <p class="lead mb-0">RECU</p>
                                                        <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-9">
                                                <object  data="{{ asset('storage/received/'.$subscription->customer->first_name.$subscription->customer->phone1.'.pdf') }}"  type="application/pdf" width="100%" height="875">
                                                </object>
                                            </div>
                                            <div class="col-md-3">


                                                <center>

                                                {{--  <a class="btn btn-warning" href="#">IMPRIMER</a>  --}}
                                                <a class="btn btn-success" href="{{ route('subscription.customer') }}">TERMINER</a>
                                               </center>
                                               <P style="margin-top: 50%">
                                                    <center> <span style="font-family: Arial, Helvetica, sans-serif; color: #120d74;; font-size:16px"><b>  <H1> NSIA SMARTY VOUS REMERCIE !</H1></b></span></center>
                                                </P>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                        </div>
                    </div>
                </div>
        </div>

</section>



@endsection
