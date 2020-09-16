@extends('shared.layout')
@section('listcustomers')
    active
@endsection
@section('administration')
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
                            <a class="nav-link active" id="custom-content-above-history-tab" data-toggle="pill" href="#custom-content-above-history" role="tab" aria-controls="custom-content-above-history" aria-selected="true">CLIENTS</a>

                        </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-history" role="tabpanel" aria-labelledby="custom-content-above-history-tab">
                                <div class="tab-custom-content">
                                    <p class="lead mb-0">Liste des clients |

                                        <a href="{{ route('subscription.customer') }}"  class="btn btn-success btn-sm">
                                            NOUVEAU
                                            <i class=" fa fa-edit"></i>
                                        </a>

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
                                        {{--  <th >Actions</th>  --}}

                                    </tr>
                                    </thead>
                                    @foreach($customer as $customers)
                                    <tbody>

                                        <td>{{ $customers->name }}  {{ $customers->first_name }} </td>
                                        <td>{{ $customers->place_residence }}</td>
                                        <td>{{ $customers->mail }}</td>
                                        <td>{{ $customers->phone1 }}</td>
                                        <td>{{ $customers->phone2 }}</td>
                                        <td>{{ $customers->gender }}</td>
                                        <td>{{ $customers->created_at }}</td>
                                        <td>
                            <center>
                                            {{--  <a href="{{ route('customers.create') }}"  class="btn btn-info btn-sm ">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>  --}}
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
