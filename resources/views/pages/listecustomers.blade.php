@extends('shared.layout')
@section('content')
<script type="text/javascript">

    $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#departement tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary  shadow-sm ">
                    <div class="card-header p-0 pt-1" style="background-color:#120d74; ">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">CLIENTS</a>

                        </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">Liste des clients |

                                        <a href="{{ route('customers.create') }}"  class="btn btn-success btn-sm">
                                            NOUVEAU
                                            <i class=" fa fa-edit"></i>
                                        </a>

                                        <div class="col-lg-2 col-md-2 col-xs-2" style="margin-left: 50% ; margin-top:-3%">
                                               <input type="text" Name="NOMPRENOM" id="myInput" class="form-control" placeholder="Rechecher un client !">
                                        </div>
                                    </p>

                                    <hr>
                                </div>
                                <table id="customerslist" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th >NOM & PRENOMS</th>
                                        <th >RESIDENCE</th>
                                        <th >EMAIL</th>
                                        <th >TELEPHONE 1</th>
                                        <th >TELEPHONE 2 </th>
                                        <th >GENRE</th>
                                        <th >DATE CREATION</th>
                                        <th >Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                        <td>COULIBALY Zambé</td>
                                        <td>Abobo</td>
                                        <td>z@gmail.com</td>
                                        <td>224455</td>
                                        <td>478845</td>
                                        <td>M</td>
                                        <td>1552244</td>
                                        <td>
<center>
                                            <a href="{{ route('customers.create') }}"  class="btn btn-info btn-sm ">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
</center>
                                        </td>

                                    </tbody>
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
