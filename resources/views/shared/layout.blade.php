<!DOCTYPE html>
<html>
<head>

    <style>

        .button {
          background-color: #211c84; /* Green */
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }

        .button1 {
            background-color: #4CAF50;
            border: #211c84;
            color:white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            width: 250px;
        }


        .button2 {width: 50%;}
        .button3 {width: 100%;}


.footer {
    position:inherit;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color:#076e4f;
   color: white;
   text-align: center;
}

.baner{
 display: block;
    background-color:#076e4f;
    font-weight: 600;
    font-size: 2.14em;
    padding: 11px 0;
    text-align: center;
    color: #fff;
}
.verifie{
  background-color: #076e4f;
  color: white;
  width: 200px;
  height: 35px;
  border-radius: 1px;
}

.margintop{
  margin-top: 80px;
}

 fieldset {
    padding: .35em .625em .75em!important;

    border: 1px solid #337ab7!important;
}
legend {

    width: 40%!important;
    border-bottom: 1px solid #ffffff!important;
}


.dropzone {
    min-height: 200px;
    border: 2px dashed #7367f0;
    background: #f8f8f8; }
    .dropzone .dz-message {
      font-size: 1rem;
      position: absolute;
      top: 50%;
      left: 0;
      width: 100%;
      height: 100px;
      margin-top: -30px;
      color: #7367f0;
      text-align: center; }
    .dropzone .dz-message:before {
      content: "\e864";
      font-family: 'feather';
      font-size: 60px;
      position: absolute;
      top: 48px;
      width: 40px;
      height: 20px;
      display: inline-block;
      left: 55%;
      margin-left: -40px;
      line-height: 1;
      z-index: 2;
      color: #7367f0;
      text-indent: 0px;
      font-weight: normal;
      -webkit-font-smoothing: antialiased; }
    .dropzone .dz-preview {
      background: transparent; }
      .dropzone .dz-preview .dz-error-message {
        min-width: 113px;
        top: 0;
        left: 0; }
    .dropzone .dz-preview .dz-remove {
      font-size: 1.1rem;
      color: #ea5455;
      line-height: 1rem; }
      .dropzone .dz-preview .dz-remove:before {
        content: "\e8f6";
        font-family: 'feather';
        display: inline-block;
        line-height: 1;
        z-index: 2;
        text-indent: 0px;
        font-weight: normal;
        -webkit-font-smoothing: antialiased; }
      .dropzone .dz-preview .dz-remove:hover {
        text-decoration: none;
        color: #e42728; }

  @media (max-width: 576px) {
    .dropzone .dz-message:before {
      top: 7.14rem; } }

</style>

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
    {{--   <!-- Content Header (Page header)
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
    </div>--}}
    <!-- /.content-header -->

    <!-- Main content -->
  @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">SMARTY</a>.</strong>
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
