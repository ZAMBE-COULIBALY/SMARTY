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
  <script>



    $(function () {
        loadvocabularies = function (parent,sons) {
            $.get("../api/vocabulary/allVocbularySons/"+parent,function(data){
                // console.log(data);
                 var lesOptions;
                 $.each(data, function( index, value ) {
                     lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                 });
                sons.empty();
                sons.append(lesOptions);
                 {{--  loadagent($("#agency").children("option:selected").val());  --}}

                 //  $("#id_categorie").trigger("chosen:updated");

             });
        }
                $(document).ready(function() {
                    if(!(isEmptyObject('{{$products}}')))
                    {
                        var selectedProduct = $("#equipment").children("option:selected").val();
                        $.get("../api/vocabulary/allVocbularySons/"+selectedProduct,function(data){
                            // console.log(data);
                            var lesOptions;
                            $.each(data, function( index, value ) {
                                lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                            });
                            $("#mark").empty();
                            $("#mark").append(lesOptions);
                            loadModel();
                        })
                    }
                });



                loadLabel = function () {
                    var selectedType = $("#equipment").children("option:selected").val();
                    console.log("chargement marque");


                    $.get("../api/vocabulary/allVocbularySons/"+selectedType,function(data){
                        // console.log(data);
                        var lesOptions;
                        $.each(data, function( index, value ) {
                            lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                        });
                        $("#mark").empty();
                        $("#mark").append(lesOptions);
                        loadModel();
                    });
                }

                loadModel = function () {
                    console.log("chargement model");
                    var selectedLabel = $("#mark").children("option:selected").val();
                    $.get("../api/vocabulary/allVocbularySons/"+selectedLabel,function(data){
                        // console.log(data);
                        var lesOptions;
                        $.each(data, function( index, value ) {
                            lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                        });
                        $("#model").empty();
                        $("#model").append(lesOptions);
                    });
                }





                $("#equipment").change(function (e) {
                    {{-- appelle ws liste agences --}}

                    loadLabel();

                    //  alert("ddd");
                })

                $("#mark").change(function (e) {
                    {{-- appelle ws liste agences --}}

                    loadModel();
                    //  alert("ddd");
                })

        })

</script>
@endsection
