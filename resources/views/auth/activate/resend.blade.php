{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.activate.resend') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                 <button type="submit" class="btn btn-primary">
                                    Resend
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{--                     <form class="form-horizontal" method="POST" action="{{ route('auth.activate.resend') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Resend
                                </button>

                            </div>
                        </div>
                    </form> --}} 

<!DOCTYPE html>
<html>
@include('layouts/partials/_head')

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{ asset('image/logo.png') }}" alt="" style="width: 15%" >
    <u><b>OneCare</b></u><span style="font-size: 75%">Indonesia</span>
    <div style="font-size: 40%;margin-top: -4%;margin-left: -12%;">One Heart One Solutin</div>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Kirim Ulang Aktivasi Email</p>

     <form method="POST" action="{{ route('auth.activate.resend') }}">
        @csrf
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="Email"required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="invalid-feedback text-center" style="color: red">
                    <p>{{ $errors->first('email') }}</p>
                </span>
             @endif
      </div>
<br>
      <div class="row">
        <div class="col-xs-4">
         <a href="{{ route('log') }}" class="btn btn-success btn-sm btn-flat" > 
        <span class="glyphicon  glyphicon-arrow-left"></span> Kembali
        </a>    
        </div>
        <div class="col-xs-4 col-xs-offset-4">
          <button type="submit" class="btn btn-warning btn-sm btn-flat pull-right">Resend 
            <span class="glyphicon glyphicon-send"></span></button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<br>


  </div>
  <!-- /.login-box-body -->
<br>
<p class="text-center">©2018-OneCareIndonesia </p>

</div>
<!-- /.login-box -->

@include('layouts/partials/_script')

</body>
</html>