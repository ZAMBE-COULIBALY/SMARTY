@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="{{ route('dashboard') }}"><b>SMARTY</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Connectez Vous</p>

        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="input-group mb-3">
              <input id="username" name="username" placeholder="Nom d'utilisateur" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>

              </div>

            </div>
             @error('username')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          <div class="input-group mb-3">
              <input id="password" name="password" placeholder="Mot de passe" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">


              <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>

            </div>
             @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">  {{ __('Login') }}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
          </a>
      @endif      </p>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

@endsection
