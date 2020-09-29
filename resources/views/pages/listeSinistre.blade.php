@extends('shared.layout')
@section('listeSinistre')
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
                            <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">SINISTRES</a>

                        </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">Sinistre en attente de validation



                                    </p>

                                    <hr>
                                </div>
                                <table id="listsinisters" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th >Contrat</th>
                                        <th >Nom & prénoms</th>
                                        <th >Type sinistre</th>
                                        <th >Date déclaration</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                            @foreach ($liste as $item)
                                    <tbody>
                                        <td>{{ $item->folder }}  </td>
                                        <td>{{ $item->name }}  {{ $item->subscription->customer->first_name}}</td>
                                        <td>{{ $item->type1 }}, {{ $item->type2 }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <center>

                                            @switch($item->state)
                                                @case(0)
                                                    <p>EN ATTENTE</p>
                                                    @break
                                                @case(1)
                                                <a {{ ($item->state != 1) ? 'disabled' :'' }} href={{ route('sinister.bon',$item->id) }}  class="btn btn-primary btn-sm ">
                                                    <i class="fa fa-eye"> VOIR </i>
                                                </a>
                                                <span style="color: green"><i class="far fa-check-square"></i></span>

                                                    @break
                                                @default
                                                <p></p>
                                                <span style="color: red">REFUSE<i class="far fa-times-circle"></i></span>

                                        @endswitch
                                            </center>

                                        </td>

                                    </tbody>
                            @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
