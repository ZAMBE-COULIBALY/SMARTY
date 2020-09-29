@extends('shared.layout')
@section('sinister_manage')
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
                    <div class="card-header p-0 pt-1" style="background-color:#120d74; ">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">GESTION DES SINISTRES</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                   @switch($step)
                                       @case("DL")
                                            @include('partials.sinister_demand_list')
                                           @break
                                       @case("DD")
                                            @include('partials.sinister_demand_details')

                                           @break
                                       @default

                                   @endswitch


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
@section('script')
<script>
    $(document).ready(function(){

    });
  </script>

@endsection
