@extends('shared.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">OPERATIONS</a></li>
              <li class="breadcrumb-item active">Error Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h4 class=" text-warning"> ACCES RESTREINT</h4>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i>{{__("Oops! Vous n'êtes pas habilité. Ce module est reservé aux ".Session::get("roles")." (Roles appropriés)")}}</h3>

          <p>
           {{__("Vous n'avez pas accès à cette fonctionnalité.")}} <a href="{{ route('dashboard') }}"> {{__("retourner à l'accueil")}}</a>
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
@endsection
