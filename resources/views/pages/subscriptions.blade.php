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
                            <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">NOUVELLE SOUSCRIPTION</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">INFORMATION EQUIPEMENT
                                    </p>

                                    <hr>
                                </div>
                                @include('partials.form_equipment')
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
      $("#price").on("input", function(){
        $("#output").text($(this).val()*0.10);
      });
    });
  </script>

@endsection
