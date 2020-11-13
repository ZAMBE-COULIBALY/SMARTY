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



    $(function () { 
        var rate = "{{$usr->partner->rate}}";

        calculRate = function() {
          if($("#formula3").is(":checked")){
            console.log($("#formula3").val());
             rate ="{{$usr->partner->rate3}}"
          } else if($("#formula").is(":checked")){
            console.log($("#formula").val());
            rate = "{{$usr->partner->rate2}}"
          }  else if($("#formula2").is(":checked")){
            console.log($("#formula2").val());
            rate = "{{$usr->partner->rate}}"
          } 
          $("#output").text($("#price").val()* rate / 100);

        }
        $("#price").on("change", function(){
            calculRate();
        });

        loadvocabularies = function (parent,sons,next = null,level) {
            var partner = "{{$usr->partner_id}}";
            $.get("../api/vocabulary/allForOneVocabularyFromPartner/"+parent+"/"+level+"/"+partner,function(data){
                // console.log(data);
                 var lesOptions;
                 $.each(data, function( index, value ) {
                     lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                 });
                 sons.empty();
                 sons.append(lesOptions);
                 if(null !== next){
                     next();
                 }
                 //  $("#id_categorie").trigger("chosen:updated");

             });
        }
                $(document).ready(function() {
                    if(!(('{{$categories}}').length === 0))
                    {
                        var selectedProduct = $("#equipment").children("option:selected").val();
                        loadvocabularies(selectedProduct,$("#mark"),loadLabel);

                    }
                });



                loadLabel = function () {
                    var selectedType = $("#equipment").children("option:selected").val();
                    console.log("chargement marque");
                    if(selectedType !== undefined)
                    {
                        loadvocabularies(selectedType,$("#mark"),loadModel,2);

                    }
                    else
                    {
                        $("#label").empty();
                        loadModel();
                    }
                }

                loadModel = function () {
                    console.log("chargement model");
                    var selectedLabel = $("#mark").children("option:selected").val();
                    if(selectedLabel !== undefined )
                    {
                        loadvocabularies(selectedLabel,$("#model"),null,3);
                    }
                    else
                    {
                        $("#model").empty();
                    }
                }





                $("#equipment").change(function (e) {
                    {{-- appelle ws liste agences --}}

                    loadLabel();

                    //  alert("ddd");
                })

                unchecked2_3 = function () {
                    {{-- appelle ws liste agences --}}
                    console.log($("#formula").val());

                    rate = "{{$usr->partner->rate2}}"
                    $("#output").text($("#price").val()* rate / 100);

                    $("#formula2").prop( "checked", false );
                    $("#formula3").prop( "checked", false );
                    //  alert("ddd");
                }
                unchecked1_3 = function () {
                    {{-- appelle ws liste agences --}}
                    console.log($("#formula2").val());
                    rate = "{{$usr->partner->rate}}"

                    $("#output").text($("#price").val()* rate / 100);

                    $("#formula").prop( "checked", false );
                    $("#formula3").prop( "checked", false );
                    //  alert("ddd");
                }
                unchecked1_2 =  function () {
                    {{-- appelle ws liste agences --}}
                    console.log($("#formula3").val());
                    rate = "{{$usr->partner->rate3}}"

                    $("#output").text($("#price").val()* rate / 100);

                    $("#formula2").prop( "checked", false );
                    $("#formula").prop( "checked", false );
                    //  alert("ddd");
                }
                $("#mark").change(function (e) {
                    {{-- appelle ws liste agences --}}

                    loadModel();
                    //  alert("ddd");
                })

        })

</script>
@endsection
