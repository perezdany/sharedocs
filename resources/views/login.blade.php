@extends('layouts/auth')

@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>Conn</b>exion</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Connectez vous pour accéder à votre espace</p>

        <form action="go_login" method="post">
          @csrf
          @if(session('error'))
              <p class="bg-danger">{{session('error')}}</p>
          @endif
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="login" maxlength="50">
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>
          <div class="form-group ">
            <input type="password" class="form-control" placeholder="Mot de passe" name="password" maxlength="16">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>

          <div class="row">
            
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
            </div>
            <!-- /.col -->
          </div>
        
        </form>

        <br>

        <p class="mb-1">
          <!--<a href="#">Mot de passe oublié</a>-->
        </p>
      
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
<!-- /.login-box -->

@endsection