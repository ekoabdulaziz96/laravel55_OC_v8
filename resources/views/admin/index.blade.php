
{{-- calling layouts \ app.blade.php --}}
@extends('layouts.master')

@section('content-header')
{{--         <h1>
        Dashboard
        <small>Control panel</small>
      </h1> --}}
      <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
      <br>
@endsection

@section('content-body')

<h1>Dashboard</h1>
<div id="app" >
  <span v-for="(user) in users">
   <div class="form-group">
      <label for="nama" class="col-md-2  col-md-offset-1">Nama : </label>
      <div class="col-md-8">
          <input type="text" id="nama" v-model="user.name" class="form-control"  autofocus required >
          <span class="help-block with-errors"></span>
      </div>
    </div> 
    </span>
  </div>
              
@endsection


@section('script')
<script>
  document.getElementById("adminDashboard").setAttribute("class","active");
</script>
<script src="{{ asset('vuejs/vue.js') }}"> </script>
<script type="text/javascript">
    var app = new Vue({
      el :'#app',
      data:{
        users:[
            {name:''}
        ]
      }
    })
</script>

@endsection