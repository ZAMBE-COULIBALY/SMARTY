@extends('shared.layout')
@section('sinister_decla')
    active
@endsection
@section('sinister_menu')
    menu-open active
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>
            SINISTRES
            <small></small>
        </h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">SINISTRES</li>
            <li class="breadcrumb-item active"><a href={{ route('sinister.list') }}>DECLARATION</a></li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-12 col-sm-12">

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
                                <hr>
<div>

                                @isset($subscriptions)
                                     <table id="customerslist" class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th >CODE</th>
                                            <th >CLIENT</th>
                                            <th >IDENTIFIANT EQUIPEMENT</th>
                                            <th >{{ __("PERIODE D'EFFET")}}</th>
                                            <th >ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody >

                                    @foreach($subscriptions as $subscription)
                                 
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


                                        <td>{{  $subscription->code }} </td>
                                        <td>{{ $subscription->customer->name }} {{ $subscription->customer->first_name }} </td>
                                        <td>{{ $subscription->numberIMEI }}</td>
                                        <td>{{ $subscription->date_subscription }} / {{ $subscription->subscription_enddate }}</td>
                                        <td>
                                            <center>
                                               @if ($subscription->currentState() >=1)
                                                   
                                                   <a href={{ route('sinister.create',$subscription->id) }}  class="btn btn-info btn-sm ">
                                                    <i class="fa fa-pencil-alt"> DECLARER</i>
                                                </a>
                                            @endif
     
                                 </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                @endisset
                               
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

@section('script')
    <script>
        $(function () {
         if($("#ckeckedFirstname").is(":checked")) {
            $( "#firstname" ).prop( "disabled", false );
            return;
        } else {
                    $( "#firstname" ).prop( "disabled", true );

        }

        if($("#ckeckedCode").is(":checked")) {
            $( "#folder" ).prop( "disabled", false );
            return;
        } else {
                    $( "#folder" ).prop( "disabled", true );

        }
        if($("#ckeckedLastname").is(":checked")) {
            $( "#lastname" ).prop( "disabled", false );
            return;
        } else {
                    $( "#lastname" ).prop( "disabled", true );

        }
        if($("#ckeckedContact").is(":checked")) {
            $( "#contact" ).prop( "disabled", false );
            return;
        } else {
                    $( "#contact" ).prop( "disabled", true );

        }
        })
       

        $('#ckeckedCode').change(function() {
            if($(this).is(":checked")) {
                $( "#folder" ).prop( "disabled", false );
                
                $( "#firstname" ).prop( "disabled", true );
                $('#ckeckedFirstname').prop("checked",false)

                $( "#lastname" ).prop( "disabled", true );
                $('#ckeckedLastname').prop("checked",false)

                $( "#contact" ).prop( "disabled", true );
                $('#ckeckedContact').prop("checked",false)
                return;
            }
            $( "#folder" ).prop( "disabled", true );
            $( "#lastname" ).prop( "disabled", false );
            $('#ckeckedLastname').prop("checked",true)
        });
         $('#ckeckedFirstname').change(function() {
            if($(this).is(":checked")) {
                $( "#firstname" ).prop( "disabled", false );
                $( "#folder" ).prop( "disabled", true );
                $('#ckeckedCode').prop("checked",false)
                return;
            } else {
                $( "#firstname" ).prop( "disabled", true );
            if(!($('#ckeckedLastname').is(":checked")) && !($('#ckeckedContact').is(":checked")))
            {
                $('#ckeckedCode').prop("checked",true);
                $( "#folder" ).prop( "disabled", false );

            }
            }
            

        });
         $('#ckeckedLastname').change(function() {
            if($(this).is(":checked")) {
                $( "#lastname" ).prop( "disabled", false );
                $('#ckeckedCode').prop("checked",false);
                $( "#folder" ).prop( "disabled", true );

               return;
            }
            $( "#lastname" ).prop( "disabled", true );
            if(!($('#ckeckedContact').is(":checked")) && !($('#ckeckedFirstname').is(":checked")))
            {
                $('#ckeckedCode').prop("checked",true);
                $( "#folder" ).prop( "disabled", false );

            }
        });
         $('#ckeckedContact').change(function() {
            if($(this).is(":checked")) {
                $( "#contact" ).prop( "disabled", false );
                $( "#folder" ).prop( "disabled", true );
                $('#ckeckedCode').prop("checked",false)
               return;
            }
            $( "#contact" ).prop( "disabled", true );
            if(!($('#ckeckedLastname').is(":checked")) && !($('#ckeckedFirstname').is(":checked")))
            {
                $('#ckeckedCode').prop("checked",true);
                $( "#folder" ).prop( "disabled", false );

            }
        });
    </script>
@endsection