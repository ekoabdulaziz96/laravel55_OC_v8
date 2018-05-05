
{{-- calling layouts \ app.blade.php --}}
@extends('layouts.master')

@section('content-header')
{{--         <h1>
        Dashboard
        <small>Control panel</small>
      </h1> --}}
      <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelola Form</li>
      </ol>
      <br>
@endsection

@section('content-body')
<div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="box box-info">
    <div class="box-title ">
      <div class="panel  @isset ($header) @php echo $header; @endphp @endisset" >
      <div class="panel-heading ">
           <a href="{{ url('admin/form') }}"  class="pull-left" ><i class='fa  fa-arrow-circle-o-left fa-2x' ></i></a>
         <i style="font-size: 20px">&nbsp;&nbsp;Daftar Form</i> 
      
          {{-- <a href='#'  style="float: right;" ><i class='fa fa-plus-square fa-2x' data-target="#ModalAdd" data-toggle="modal"></i></a> --}}
          
        <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus "></i></button>
                {{-- <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
      </div>
    </div>
    </div> 
    <div class="box-body">

      <form id="form-form" action="{{ url('admin/form') }}" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
     {{-- header --}}
      <div class="panel-body">

            <input type="hidden" id="id" name="id">
            {{-- input form --}}
             <div class="form-group">
                <label for="nama" class="col-md-2  col-md-offset-1">Nama : </label>
                <div class="col-md-8">
                    <input type="text" id="nama" name="nama" class="form-control"  autofocus required value="{{ old('nama') }}" >
             
                </div>
              </div> 
              <div class="form-group">
                <label for="tipe" class="col-md-2  col-md-offset-1" >Tipe : </label>
                  <div class="col-md-8">
                     <select  id="tipe" name="tipe" class="form-control" autofocus required style="margin: 0px ;" 
                     {{ ($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]')) ? 'readonly' : '' }}>
                        <option value="" @if(($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]'))) hidden  @endif> --pilih-- </option>
                        <option value="text"      @if (old('tipe')=='text') selected @elseif(($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]'))) hidden  @endif>Text</option>
                        <option value="textarea"  @if (old('tipe')=='textarea') selected @elseif(($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]'))) hidden @endif>Text Area</option>
                        <option value="checkbox"  @if (old('tipe')=='checkbox') selected @elseif(($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]'))) hidden @endif>Checkbox</option>
                        <option value="radio"     @if (old('tipe')=='radio') selected @elseif(($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]'))) hidden @endif>Radio</option>
                        <option value="select"    @if (old('tipe')=='select') selected @elseif(($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]'))) hidden  @endif>Select</option>
                      </select>
                 </div>
              </div>
              {{-- set text area --}}
              <span id="tipe-set" >
  
              </span>
              {{-- pilihan --}}
              <span id="pilihan-set">
          
              </span>

            <div class="form-group">
                <label for="status" class="col-md-2 col-md-offset-1">Status :</label>
                <div class="col-md-8">
                    <input type="text" id="status" name="status" class="form-control" autofocus required>
                    <span class="help-block with-errors"></span>
                </div>
            </div> 
       
              <!-- checkbox -->
              <div class="form-group">
                <label>
                  <input type="checkbox" class="minimal" checked>
                </label>
                <label>
                  <input type="checkbox" class="minimal">
                </label>
                <label>
                  <input type="checkbox" class="minimal" disabled>
                  Minimal skin checkbox
                </label>
              </div>

              <!-- radio -->
              <div class="form-group">
                <label>
                  <input type="radio" name="r1" class="minimal" checked>
                </label>
                <label>
                  <input type="radio" name="r1" class="minimal">
                </label>
                <label>
                  <input type="radio" name="r1" class="minimal" disabled>
                  Minimal skin radio
                </label>
              </div>

              <!-- Minimal red style -->

              <!-- checkbox -->
              <div class="form-group">
                <label>
                  <input type="checkbox" class="minimal-red" checked>
                </label>
                <label>
                  <input type="checkbox" class="minimal-red">
                </label>
                <label>
                  <input type="checkbox" class="minimal-red" disabled>
                  Minimal red skin checkbox
                </label>
              </div>

              <!-- radio -->
              <div class="form-group">
                <label>
                  <input type="radio" name="r2" class="minimal-red" checked>
                </label>
                <label>
                  <input type="radio" name="r2" class="minimal-red">
                </label>
                <label>
                  <input type="radio" name="r2" class="minimal-red" disabled>
                  Minimal red skin radio
                </label>
              </div>

              <!-- Minimal red style -->

              <!-- checkbox -->
              <div class="form-group">
                <label>
                  <input type="checkbox" class="flat-red" checked>
                </label>
                <label>
                  <input type="checkbox" class="flat-red">
                </label>
                <label>
                  <input type="checkbox" class="flat-red" disabled>
                  Flat green skin checkbox
                </label>
              </div>

              <!-- radio -->
              <div class="form-group">
                <label>
                  <input type="radio" name="r3" class="flat-red" checked>
                </label>
                <label>
                  <input type="radio" name="r3" class="flat-red">
                </label>
                <label>
                  <input type="radio" name="r3" class="flat-red" disabled>
                  Flat green skin radio
                </label>
              </div>
          {{-- footer --}}
              <div class="panel-footer @isset ($footer) @php echo $footer; @endphp @endisset" style="margin: -1% ">
                 <div class="" align="right" >
                      @if (($errors->has('col') || $errors->has('row') || $errors->has('pilihan[]')))
                        <button type="button" class="btn btn-default " data-dismiss="modal">
                          <span id="button-cancel">Cancel</span>
                        </button> 
                      @endif
                      <button id="button-submit" type="submit"  class="btn @isset ($button) @php echo $button; @endphp @endisset">
                        <span id="button-submit-text">Submit</span>
                      </button>
                </div>
            </div>
            </form>

          </div>
        </div>
      </div>
    </div>



<div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
         Tambah Peserta Praktikum
       
          <a href='admin_presensi.php'  style="float: right;" ><i class='fa  fa-arrow-circle-o-left fa-2x' data-target="#ModalAdd" data-toggle="modal"></i></a>
        
      </div>
      <form action="function/presensi_tambah.php?" name="modal_popup" enctype="multipart/form-data" method="post">
        <div class="panel-body">
            <div class="modal-body">         

                     <div class="form-group">
                        <label for="idj">Mata Kuliah</label>
                        <br>
                     </div>
                      <div class="form-group" id="hasil_status"></div>
                 </div>    
          </div>
            <div class="panel-footer" align="right">
                <button class="btn btn-success" type="submit">
                  Tambah
                </button>
              </div>
        </form> 
    </div>
  </div>
</div>


   
@endsection

@section('script')
 <script>
  $('#button-cancel').click(function() {
    location.reload();
});
 $(document).ready(function(){
 var tipe= $("#tipe").val();
        if (tipe=='textarea'){
          $('#tipe-set').append('<span><div class=\"form-group {{ $errors->has("col") ? "has-error" : "" }}\"> <label for="col" class="col-md-2 col-md-offset-1">panjang :</label> <div class="col-md-8"> <input type="text" id="col" name="col" class="form-control" placeholder="20" autofocus required>  @if ($errors->has("col")) <span class="help-block"> <strong>{{ $errors->first("col") }}</strong></span> @endif</div> </div> <div class=\"form-group {{ $errors->has("row") ? "has-error" : "" }}\"> <label for="row" class="col-md-2 col-md-offset-1">lebar :</label> <div class="col-md-8"> <input type="text" id="row" name="row" class="form-control" placeholder="10" autofocus required> @if ($errors->has("row")) <span class="help-block"> <strong>{{ $errors->first("row") }}</strong></span> @endif </div></div></span>');
            $('#pilihan-set').find('span').remove();
    
        }else if (tipe =='radio' || tipe=='checkbox' || tipe=='select'){
          // $('#pilihan-set').find('span').remove();
          var btntambah = "<span class='col-md-1'><button type='button' class='btn btn-success' id='pilihan-tambah'><i class='fa fa-plus' aria-hidden='true'></i></button></span>";
           $('#pilihan-set').append('<span><div class=\"form-group {{ $errors->has("pilihan[]") ? "has-error" : "" }}\"> <label for="pilihan" class="col-md-2 col-md-offset-1" align="right">List pilihan :</label> <div class="col-md-7"> <input type="text" id="pilihan" name="pilihan[]" class="form-control" placeholder="pilihan" autofocus required>  @if ($errors->has("pilihan[]")) <span class="help-block"> <strong>{{ $errors->first("pilihan") }}</strong></span> @endif</div> '+btntambah+'</div></span>');
           $('#tipe-set').find('span').remove();

        }else {
          $('#tipe-set').find('span').remove();
          $('#pilihan-set').find('span').remove();
        }
  });

    $(document).on('click', '#pilihan-tambah', function(){
           var btnhapus = "<span class='col-md-1'><button type='button' class='btn btn-danger' id='pilihan-hapus'><i class='fa fa-trash' aria-hidden='true'></i></button></span>";
           $('#pilihan-set').append('<span id="pilihan-list"><div class=\"form-group {{ $errors->has("pilihan[]") ? "has-error" : "" }}\"> <label for="pilihan" class="col-md-2 col-md-offset-1" align="right">List pilihan :</label> <div class="col-md-7"> <input type="text" id="pilihan" name="pilihan[]" class="form-control" placeholder="pilihan" autofocus required>  @if ($errors->has("pilihan[]")) <span class="help-block"> <strong>{{ $errors->first("pilihan") }}</strong></span> @endif</div> '+btnhapus+'</div></span>');
            console.log('cek');
   
   });
    $(document).on('click', '#pilihan-hapus', function(){
        $(this).parents('#pilihan-list').remove();
    });

$(document).ready(function(){
    $('#tipe').change(function(){
        var tipe= $("#tipe").val();
        if (tipe=='textarea'){
          $('#tipe-set').append('<span><div class=\"form-group {{ $errors->has("col") ? "has-error" : "" }}\"> <label for="col" class="col-md-2 col-md-offset-1">panjang :</label> <div class="col-md-8"> <input type="text" id="col" name="col" class="form-control" placeholder="20" autofocus required>  @if ($errors->has("col")) <span class="help-block"> <strong>{{ $errors->first("col") }}</strong></span> @endif</div> </div> <div class=\"form-group {{ $errors->has("row") ? "has-error" : "" }}\"> <label for="row" class="col-md-2 col-md-offset-1">lebar :</label> <div class="col-md-8"> <input type="text" id="row" name="row" class="form-control" placeholder="10" autofocus required> @if ($errors->has("row")) <span class="help-block"> <strong>{{ $errors->first("row") }}</strong></span> @endif </div></div></span>');
            $('#pilihan-set').find('span').remove();
    
        }else if (tipe =='radio' || tipe=='checkbox' || tipe=='select'){
          $('#pilihan-set').find('span').remove();
          var btntambah = "<span class='col-md-1'><button type='button' class='btn btn-success' id='pilihan-tambah'><i class='fa fa-plus' aria-hidden='true'></i></button></span>";
           $('#pilihan-set').append('<span><div class=\"form-group {{ $errors->has("pilihan[]") ? "has-error" : "" }}\"> <label for="pilihan" class="col-md-2 col-md-offset-1" align="right">List pilihan :</label> <div class="col-md-7"> <input type="text" id="pilihan" name="pilihan[]" class="form-control" placeholder="pilihan" autofocus required>  @if ($errors->has("pilihan[]")) <span class="help-block"> <strong>{{ $errors->first("pilihan") }}</strong></span> @endif</div> '+btntambah+'</div></span>');
           $('#tipe-set').find('span').remove();

        }else {
          $('#tipe-set').find('span').remove();
          $('#pilihan-set').find('span').remove();
        }
    });
  });

 $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    });
</script>
@endsection
