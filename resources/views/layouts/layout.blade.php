<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SMARTY</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Tell the browser to be responsive to screen width -->
  @include('panels.styles')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('panels.navbar')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('/')}}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SMARTY</span>
    </a>

    <!-- Sidebar -->
   {{--  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      @include('panels.sidebarMenu')

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tableau de Bord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <table id="tab1" class="table table-bordered ">
                <thead>
                    <tr style="background-color: #3d5fb4; color:#ffffff">
                        <th style="background-color: #ffffff"></th>
                        <th >Janvier</th>
                        <th >Février</th>
                        <th >Mars</th>
                        <th >Avril</th>
                        <th >Mai</th>
                        <th>Juin</th>
                        <th>Juillet</th>
                        <th>Août</th>
                        <th>Septembre</th>
                        <th>Octobre</th>
                        <th>Novembre</th>
                        <th>Décembre</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <td style="background-color: #3d5fb4; color:#ffffff">Partenaire 1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tbody>
                <tbody>
                    <td style="background-color: #3d5fb4; color:#ffffff">Partenaire 2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tbody>
            </table>
        </div>

        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Evolution de la fréquentation mensuelle globale
                </h3>

              </div>
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </section>
          <section class="col-lg-5 connectedSortable">



            <!-- fréquence -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Fréquentation moyenne journalière par magasin
                </h3>


              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 275px; height: 275px; max-height: 275px; max-width: 100%;"> </canvas>
              </div>
              <div class="card-footer bg-transparent">
                <div class="row">

                </div>
              </div>
            </div>

          </section>

        </div>

      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="{{asset('/')}}">SMARTY</a>.</strong>
    Tout droit reservé.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('panels.scripts')
</body>
</html>
