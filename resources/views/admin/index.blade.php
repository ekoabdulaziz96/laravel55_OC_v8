
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
                      <!-- time Picker -->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Time picker:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker">


                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                                         <div class="form-group">
                          <label for="maks_wilayah" class="col-md-2  col-md-offset-1">Maks. Wilayah : </label>
                          <div class="col-md-8">
                             {{--  <input type="text" id="maks_wilayah" name="maks_wilayah" class="form-control"  autofocus required >
                               <input class="form-control" type="number" value="42" id="example-number-input"> --}}
                               <input type="text" class="form-control bfh-number"  data-min="0" id="maks_wilayah" name="maks_wilayah" autofocus required  >
                              <span class="help-block with-errors"></span>
                              <div align="center">
                            {{-- <img class="rounded-square" width="50" height="50" src="{{  asset('upload/foto/kkk.png') }}" alt="cek" id="form-show-foto" style="float: center">     --}}
                              </div>
                            

                          </div>
                        </div> 
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

              
@endsection


@section('script')


{{-- <script type="text/javascript">
  window.setTimeout(function() {
  $("#berhasil").fadeTo(5000,0).slideUp(5000, function(){
      $(this).remove();
  });
  }, 1800);
</script> --}}
<script>
  document.getElementById("adminDashboard").setAttribute("class","active");
</script>

<!-- Page script -->
<script>
  $(function () {



    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })


    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })



    // //Colorpicker
    // $('.my-colorpicker1').colorpicker()
    // //color picker with addon
    // $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@endsection