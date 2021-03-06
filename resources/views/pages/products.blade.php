@extends('shared.layout')
@section('product')
    active
@endsection
@section('administration')
menu-open active
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>
                PRODUITS
                <small></small>
            </h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Administration</li>
                <li class="breadcrumb-item active"><a href={{ route('products.list') }}>PRODUITS</a></li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
  </section>
  <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    @if (isset($pass))
                        echo $pass;
                    @endif
                    <div class="card card-warning  shadow-sm ">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ ((isset($product))||([] != $errors->all()))  ? '' : 'active'}}" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">MAGASIN</a>
                            </li>
                               <li class="nav-item">
                                    <a class="nav-link {{ ((isset($product))||([] != $errors->all())) ? 'active' : ''}}" id="custom-content-above-other-tab" data-toggle="pill" href="#custom-content-above-other" role="tab" aria-controls="custom-content-above-other" aria-selected="false" disabled >{{ Str::contains(Route::current()->getName(), 'edit') ? 'MODIFIER' : 'NOUVEAU' }}  </a>
                                </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-settings-tab" data-toggle="pill" href="#custom-content-above-settings" role="tab" aria-controls="custom-content-above-settings" aria-selected="false">Settings</a>
                            </li> --}}
                            </ul>

                        </div>

                        <div class="card-body">

                            <div class="tab-content" id="custom-content-above-tabContent">

                                <div class="tab-pane fade show {{ ((isset($product))||([] != $errors->all())) ? '' : 'active'}}" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                    <div class="tab-custom-content">
                                        <p class="lead mb-0">Liste des produits</p>
                                        <hr>
                                    </div><table id="productlist" class="table table-bordered ">
                                        <thead>
                                        <tr>
                                        <th>CODE</th>
                                        <th>NAME</th>
                                        <th>PRODUIT</th>
                                        <th>MARQUE</th>
                                        <th>MODELE</th>
                                        <th>ETAT</th>
                                        {{--  <th>ACTIONS</th>  --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $item->code }}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->type->label}}</td>
                                                <td>{{$item->label->label}}</td>
                                                <td>{{$item->model->label}}</td>
                                                <td>{{  ($item->state == 1) ? 'Actif' : 'Inactif'}}</td>
                                                {{--  <td>
                                                    <a href="{{route('products.delete',$item->id) }}"  class="btn btn-danger btn-sm">
                                                        <i class=" fa fa-trash"></i>
                                                    </a>
                                                    <a href="{{route('products.edit',$item->id) }}"  class="btn btn-info btn-sm ">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                </td>  --}}
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>
                                    <div class="tab-pane fade {{  ((isset($product))||([] != $errors->all()))  ? 'show active' : ''}}" id="custom-content-above-other" role="tabpanel" aria-labelledby="custom-content-above-other-tab">
                                       @include('partials.form_product')

                                </div>







                                {{-- <div class="tab-pane fade" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
                                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                </div>
                                <div class="tab-pane fade" id="custom-content-above-settings" role="tabpanel" aria-labelledby="custom-content-above-settings-tab">
                                    Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                </div> --}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script>



        $(function () {
            loadvocabularies = function (parent,sons,next = null) {
                $.get("../api/vocabulary/allVocbularySons/"+parent,function(data){
                    // console.log(data);
                     var lesOptions;
                     $.each(data, function( index, value ) {
                         lesOptions+="<option value="+value.id+">"+value.label+"</option>" ;
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
                            var selectedCategory = $("#category").children("option:selected").val();
                           /* $.get("../api/vocabulary/allVocbularySons/"+selectedCategory,function(data){
                                // console.log(data);
                                var lesOptions;
                                $.each(data, function( index, value ) {
                                    lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                                });
                                $("#type").empty();
                                $("#type").append(lesOptions);*/
                            /*   loadLabel();
                                loadModel();
                            })*/
                            loadvocabularies(selectedCategory,$("#type"),loadtype);

                        }
                    });

                    loadtype = function () {
                        var selectedCategory = $("#category").children("option:selected").val();
                        console.log("chargement type de "+selectedCategory);

                       /* $.get("../api/vocabulary/allVocbularySons/"+selectedCategory,function(data){
                            // console.log(data);
                            var lesOptions;
                            $.each(data, function( index, value ) {
                                lesOptions+="<option value='"+value.id+"'>"+value.label+"</option>" ;
                            });
                            $("#type").empty();
                            $("#type").append(lesOptions);
                        });
                                                  */
                        if(selectedCategory !== undefined)
                        {
                            loadvocabularies(selectedCategory,$("#type"),loadLabel);

                        }
                        else
                        {
                            $("#type").empty();
                            loadLabel();
                        }


                    }

                    loadLabel = function () {
                        var selectedType = $("#type").children("option:selected").val();
                        var selectedTypetext = $("#type").children("option:selected").text();

                        console.log("chargement label");
                        if(selectedType !== undefined && selectedType !== selectedTypetext)
                        {
                            loadvocabularies(selectedType,$("#label"),loadModel);

                        }
                        else
                        {
                            $("#label").empty();
                            loadModel();
                        }
                    }

                    loadModel = function () {
                        console.log("chargement model");
                        var selectedLabel = $("#label").children("option:selected").val();
                        var selectedLabeltext = $("#label").children("option:selected").text();
                        console.log("chargement texte marque de "+selectedLabeltext);
                        if(selectedLabel !== undefined && selectedLabel !== selectedLabeltext)
                        {
                            loadvocabularies(selectedLabel,$("#model"));
                        }
                        else
                        {
                            $("#model").empty();
                        }
                    }

                    $("#category").change(function (e) {
                        {{-- appelle ws liste agences --}}
                        console.log("changement category");

                        loadtype();

                        //  alert("ddd");
                    })




                    $("#type").change(function (e) {
                        {{-- appelle ws liste agences --}}

                        loadLabel();

                        //  alert("ddd");
                    })

                    $("#label").change(function (e) {
                        {{-- appelle ws liste agences --}}

                        loadModel();
                        //  alert("ddd");
                    })

            })

    </script>
@endsection
