<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href= {{ asset('plugins/fontawesome-free/css/all.min.css') }}>
  <!-- Font feather -->
  {{--  <link rel="stylesheet" href= {{ asset('fonts/feather/iconfont.css') }}>  --}}
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href= {{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}>
  <!-- iCheck -->
  <link rel="stylesheet" href={{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
  <!-- JQVMap -->
  <link rel="stylesheet" href={{ asset('plugins/jqvmap/jqvmap.min.css') }}>
  <!-- Theme style -->
   <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
  <!-- Daterange picker -->
  <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
  <!-- summernote -->
  <link rel="stylesheet" href={{ asset('plugins/summernote/summernote-bs4.min.css') }}>
  <!-- DataTables -->
  {{-- <link rel="stylesheet" href={{ asset('plugins/datatables/css/jquery.dataTables.min.css') }}> --}}
  <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
   <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
  
  <!-- Select2 -->
  <link rel="stylesheet" href={{ asset('plugins/select2/css/select2.min.css') }}>
  <link rel="stylesheet" href={{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
   <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href={{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}>
 <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href={{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}>
  <!-- Toastr -->
  <link rel="stylesheet" href={{ asset('plugins/toastr/toastr.min.css') }}>
  <!-- File Uploader -->
  {{--  <link rel="stylesheet" href={{ asset('plugins/file-uploaders/dropzone.min.css') }} >  --}}
  @yield('style')


  <style>
    input.transparent-input{
       background-color:rgba(0,0,0,0) !important;
       border:none !important;
    }

    .nav-link .up {
      text-transform: uppercase;
  }
  .card-body .input-group label{
    text-transform: uppercase;
}

.card-body .form-group label{
  text-transform: uppercase;
}

.card-title {
  text-transform: uppercase;
}
</style>
