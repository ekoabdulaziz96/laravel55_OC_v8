
{{-- calling layouts \ app.blade.php --}}
@extends('layouts.master')

@section('content-header')
{{--         <h1>
        Dashboard
        <small>Control panel</small>
      </h1> --}}
      <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User</li>
      </ol>
      <br>
@endsection

@section('content-body')

<div class="row" >
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="box box-info">
    <div class="box-title">
      <div class="panel panel-default">
      <div class="panel-heading">
         <i style="font-size: 20px">Daftar User</i>
       
          {{-- <a href='#'  style="float: right;" ><i class='fa fa-plus-square fa-2x' data-target="#ModalAdd" data-toggle="modal"></i></a> --}}
          
        <div class="pull-right box-tools">
                <button type="button" class="btn btn-basic btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus "></i></button>
                {{-- <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
      </div>
    </div>        
    <div class="box-body">
    
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="example1">
            <thead>
              <tr class="info">
                  <th width="2%">No</th>
                  <th>Fields</th>
                  <th class="text-center" width="15%" align="center" >
                    <a href="#" class="create-modal btn btn-success btn-sm" style="width: 120% ;">
                      <i class="glyphicon glyphicon-plus"></i>
                    </a>
                  </th>
                </tr>
            </thead>
            <tbody >
             {{ csrf_field() }}
                  @php $no=1;    @endphp  
                  @foreach ($post as $value)
                    <tr class="post{{$value->id}}">
                      <td>{{ $no++ }}</td>
                      <td>
                        <form action="">
                        @if ($value->category =='text')
                            <div class=" row">
                              <label class="control-label col-sm-3" for="{{$value->name}}">{{$value->text_name}} :</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" id="{{$value->name}}" name="{{$value->name}}"
                                placeholder="{{$value->placeholder}}" required>
                                <p class="error text-center alert alert-danger hidden" ></p>
                              </div>
                            </div>   
                        @elseif($value->category =='textarea')
                         <div class="form-group row">
                              <label class="control-label col-sm-4" for="{{$value->name}}">{{$value->text_name}} :</label>
                              <div class="col-sm-8">
                                <textarea  class="form-control" id="{{$value->name}}" name="{{$value->name}}">{{$value->placeholder}}</textarea>
                                <p class="error text-center alert alert-danger hidden" ></p>
                              </div>
                            </div>  
                        @elseif($value->category =='textarea')
                         <div class="form-group row">
                              <label class="control-label col-sm-4" for="{{$value->name}}">{{$value->text_name}} :</label>
                              <div class="col-sm-8">
                                <textarea  class="form-control" id="{{$value->name}}" name="{{$value->name}}">{{$value->placeholder}}</textarea>
                                <p class="error text-center alert alert-danger hidden" ></p>
                              </div>
                            </div>   
                        @else
                        @endif
                        </form>
                      </td>
                      <td align="center">
                        <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-nama="{{$value->nama}}" data-email="{{$value->email}}"  data-password="{{$value->password}}" data-status="{{$value->status}}" data-avatar="{{$value->avatar}}" data-tgl_lahir="{{$value->tgl_lahir}}" data-alamat="{{$value->alamat}}" data-no_hp="{{$value->no_HP}}" data-created_at="{{$value->created_at}}" data-updated_at="{{$value->updated_at}}" >
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-nama="{{$value->nama}}" data-email="{{$value->email}}"  data-password="{{$value->password}}" data-status="{{$value->status}}" data-avatar="{{$value->avatar}}" data-tgl_lahir="{{$value->tgl_lahir}}" data-alamat="{{$value->alamat}}" data-no_hp="{{$value->no_HP}}" data-created_at="{{$value->created_at}}" data-updated_at="{{$value->updated_at}}"  >
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-nama="{{$value->nama}}" data-email="{{$value->email}}"  data-password="{{$value->password}}" data-status="{{$value->status}}" data-avatar="{{$value->avatar}}" data-tgl_lahir="{{$value->tgl_lahir}}" data-alamat="{{$value->alamat}}" data-no_hp="{{$value->no_HP}}" data-created_at="{{$value->created_at}}" data-updated_at="{{$value->updated_at}}"  >
                          <i class="glyphicon glyphicon-trash"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-add" >
        <button type="button" class="close closed" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>

      <div class="modal-body">
        <form class="form-horizontal" role="form">

          <div class="form-group row add">
            <label class="control-label col-sm-2" for="nama">Nama :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama" name="nama"
              placeholder="onecare" required>
              <p class="error text-center alert alert-danger hidden" id="nama-error"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email"
              placeholder="onecare@gmail.com" required>
              <p class="error text-center alert alert-danger hidden" id="email-error"></p>
            </div>
          </div>          
           <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password"
              placeholder="*****" required>
              <p class="error text-center alert alert-danger hidden" id="password-error"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="status">Status :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="status" name="status"
              placeholder="manager" required>
              <p class="error text-center alert alert-danger hidden" id="status-error"></p>
            </div>
          </div>
        </form>

      </div>
          <div class="modal-footer modal-footer-add">
            <button class="btn btn-success" type="submit" id="added">
              <span class="glyphicon glyphicon-plus"></span> Save 
            </button>
            <button class="btn btn-default closed" type="button" data-dismiss="modal" >
              <span class="glyphicon glyphicon-remobe"></span> Close
            </button>
          </div>
    </div>
  </div>
</div>
{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header modal-header-show">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
       </div>
        <div class="modal-body">
        <form class="form-horizontal" role="form">

{{--           <div class="form-group" align="center">
            <label class="control-label col-sm-2" for="avatar-show">Avatar :</label>
            <div class="col-sm-10">
              <img src="" alt="" id="avatar-show">
            </div>
          </div> --}}
           <div class="form-group">
              <label class="control-label col-sm-2" for="nama-show">Nama :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama-show" name="nama-show">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email-show">Email :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email-show" name="email-show">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="password-show">Password :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="password-show" name="password-show">
              </div>
            </div>              
            <div class="form-group">
              <label class="control-label col-sm-2" for="status-show">Status :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="status-show" name="status-show"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_lahir-show">Tgl lahir :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="tgl_lahir-show" name="tgl_lahir-show"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="alamat-show">Alamat :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat-show" name="alamat-show"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="no_HP-show">No. HP :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="no_HP-show" name="no_HP-show"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="created_at-show">Create :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="created_at-show"e name="created_at-show"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="updated_at-show">Update :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="updated_at-show" name="updated_at-show"  >
              </div>
            </div>
         </form>
        </div>
        <div class="modal-footer modal-footer-show">
             <button class="btn btn-default " type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span> Close
            </button>
        </div>
    </div>
  </div>
</div>

{{-- Modal Form Edit and Delete Post --}}
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-edit">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal">
           <div class="form-group">
              <label class="control-label col-sm-2" for="nama-edit">Nama :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama-edit" name="nama-edit">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email-edit">Email :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email-edit" name="email-edit">
              </div>
            </div>     
             <div class="form-group">
              <label class="control-label col-sm-2" for="password-edit">Password :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="password-edit" name="password-edit">
              </div>
            </div>           
            <div class="form-group">
              <label class="control-label col-sm-2" for="status-edit">Status :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="status-edit" name="status-edit"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_lahir-edit">Tgl lahir :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="tgl_lahir-edit" name="tgl_lahir-edit"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="alamat-edit">Alamat :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat-edit" name="alamat-edit"  >
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-sm-2" for="no_hp_edit">No. HP :</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="no_hp_edit" name="no_hp-edit"  >
              </div>
            </div>
          
        </form>
      </div>
          <div class="modal-footer modal-footer-edit">
            <button class="btn btn-warning" type="submit" id="edited">
              <span class="glyphicon glyphicon-check"></span> Update 
            </button>
            <button class="btn btn-default " type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span> Close
            </button>
          </div>
      </div>
    </div>
  </div>
 </div>
  
  {{-- Form Delete Post --}}
<div id="deleted" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-delete">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
      </div>
        <div class="modal-body">
            <div class="deleteContent" align="center">
            Anda yakin ingin menghapus <span class="nama"></span>?
            <span class="hidden id"></span>
          </div>
        </div>
      <div class="modal-footer modal-footer-delete">
            <button class="btn btn-danger" type="submit" id="deleted">
              <span class="glyphicon glyphicon-trash"></span> Delete 
            </button>
            <button class="btn btn-default " type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span> Close
            </button>
      </div>
    </div>
  </div>
</div>

<div id="berhasil" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="modal-header-notif">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
        <div id="notif" align="center">
        </div>
      <div class="modal-footer " id="modal-footer-notif">
        <button type="button" class="btn btn-default  pull-right" data-dismiss="modal" id="ok">
          <span class="glyphicon glyphicon"></span>OK
        </button>

      </div>
    </div>
  </div>
</div>


@endsection
@php
use App\User;
@endphp

@section('script')
<script type="text/javascript">
{{-- ajax Form Add Post--}}
  $(document).on('click','.create-modal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Data');
  });
  $("#added").click(function() {
    $.ajax({
      type: 'POST',
      url: 'addAdminUser',
      data: {
        '_token': $('input[name=_token]').val(),
        'nama': $('input[name=nama]').val(),
        'email': $('input[name=email]').val(),
        'password': $('input[name=password]').val(),
        'status': $('input[name=status]').val()

      },
      success: function(data){
        // alert('sukses');

        console.log(data);
        if ((data.errors)) {
          
          if (data.errors.nama) {$('.error').removeClass('hidden');$('#nama-error').text(data.errors.nama);}else{$('.error').addClass('hidden');}
          if (data.errors.email) {$('.error').removeClass('hidden');$('#email-error').text(data.errors.email);}
          if (data.errors.password) {$('.error').removeClass('hidden');$('#password-error').text(data.errors.password);}
          if (data.errors.status) {$('.error').removeClass('hidden');$('#status-error').text(data.errors.status);}
        } else {
          $('#berhasil').modal('show');
          $('.hasil').show();
          $('.error').remove();
          $('#example1').prepend("<tr class='post" + data.id + "'>"+
          "<td>" + 'new'+ "</td>"+
          "<td>" + data.nama + "</td>"+
          "<td>" + data.email + "</td>"+
          "<td>" + data.status + "</td>"+
          "<td align='center'><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-password='" + data.password + "' data-status='" + data.status + "' data-avatar='" + data.avatar + "' data-tgl_lahir='" + data.tgl_lahir + "' data-alamat='" + data.alamat + "' data-no_hp='" + data.no_HP + "' data-created_at='" + data.created_at + "' data-updated_at='" + data.updated_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-password='" + data.password + "' data-status='" + data.status + "' data-avatar='" + data.avatar + "' data-tgl_lahir='" + data.tgl_lahir + "' data-alamat='" + data.alamat + "' data-no_hp='" + data.no_HP + "' data-created_at='" + data.created_at + "' data-updated_at='" + data.updated_at + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-password='" + data.password + "' data-status='" + data.status + "' data-avatar='" + data.avatar + "' data-tgl_lahir='" + data.tgl_lahir + "' data-alamat='" + data.alamat + "' data-no_hp='" + data.no_HP + "' data-created_at='" + data.created_at + "' data-updated_at='" + data.updated_at + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+

          
          "</tr>"
          );
          {{-- // window.location.href = '{{ route('adminUser') }}'; --}}

          // $('#create').modal('hide');
          $('#berhasil').modal('show');
          $('#notif').text('Tambah User Berhasil');
          $('#modal-header-notif').addClass('modal-header-add');
          $('#modal-footer-notif').addClass('modal-footer-add');

          //  $('.hasil').show();
              $('#nama').val('');
              $('#email').val('');
              $('#password').val('');
              $('#status').val('');
        }
      },
    });



  });
 $(".closed").click(function() {
           window.location.href = '{{ route('adminUser') }}';
          // $('#create').modal('hide');

   });
// function Edit POST
$(document).on('click', '.edit-modal', function() {
  $('.modal-title').text('Post Edit');
  $('.form-horizontal').show();
  $('#nama-edit').val($(this).data('nama'));
  $('#email-edit').val($(this).data('email'));
  $('#password-edit').val($(this).data('password'));
  $('#status-edit').val($(this).data('status'));
  $('#avatar-edit').val($(this).data('avatar'));
  $('#tgl_lahir-edit').val($(this).data('tgl_lahir'));
  $('#alamat-edit').val($(this).data('alamat'));
  $('#no_hp_edit').val($(this).data('no_hp'));
  $id = $(this).data('id');
  $('#edit').modal('show');
});

$("#edited").click(function() {
  $.ajax({
    type: 'POST',
    url: 'editAdminUser',
    data: {
        '_token': $('input[name=_token]').val(),
        'id': $id,
        'nama': $("#nama-edit").val(),
        'email': $("#email-edit").val(),
        'password': $("#password-edit").val(),
        'status': $("#status-edit").val(),
        'avatar': $("#avatar-edit").val(),
        'tgl_lahir': $("#tgl_lahir-edit").val(),
        'alamat': $("#alamat-edit").val(),
        'no_hp': $("#no_hp_edit").val()
        
},
success: function(data) {

  // console.log('cek');
      $('.post' + data.id).replaceWith(" "+
      "<tr class='post" + data.id + "'>"+
      "<td>" + "new" + "</td>"+
      "<td>" + data.nama + "</td>"+
      "<td>" + data.email + "</td>"+
      "<td>" + data.status + "</td>"+
      "<td align='center'><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-password='" + data.password + "' data-status='" + data.status + "' data-avatar='" + data.avatar + "' data-tgl_lahir='" + data.tgl_lahir + "' data-alamat='" + data.alamat + "' data-no_hp='" + data.no_HP + "' data-created_at='" + data.created_at + "' data-updated_at='" + data.updated_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-password='" + data.password + "' data-status='" + data.status + "' data-avatar='" + data.avatar + "' data-tgl_lahir='" + data.tgl_lahir + "' data-alamat='" + data.alamat + "' data-no_hp='" + data.no_HP + "' data-created_at='" + data.created_at + "' data-updated_at='" + data.updated_at + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-password='" + data.password + "' data-status='" + data.status + "' data-avatar='" + data.avatar + "' data-tgl_lahir='" + data.tgl_lahir + "' data-alamat='" + data.alamat + "' data-no_hp='" + data.no_HP + "' data-created_at='" + data.created_at + "' data-updated_at='" + data.updated_at + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
      "</tr>");
   
          $('#berhasil').modal('show');
          $('#notif').text('Update User Berhasil');
          $('#modal-header-notif').addClass('modal-header-edit');
          $('#modal-footer-notif').addClass('modal-footer-edit');
    }
  });
});


// form Delete function
$(document).on('click', '.delete-modal', function() {
  $('.modal-title').text('Delete Post');
  $('.id').text($(this).data('id'));
  $('.deleteContent').show();
  $('.nama').html($(this).data('nama'));
  $('#deleted').modal('show');
});

$("#deleted").click(function() {
  $.ajax({
    type: 'POST',
    url: 'deleteAdminUser',
    data: {
      '_token': $('input[name=_token]').val(),
      'id': $('.id').text()
    },
    success: function(data){
       $('.post' + $('.id').text()).remove();

          $('#berhasil').modal('show');
          $('#notif').text('Delete User Berhasil');
          $('#modal-header-notif').addClass('modal-header-delete');
          $('#modal-footer-notif').addClass('modal-footer-delete');
          $('#deleted').modal('hide');
           window.location.href = '{{ route('adminUser') }}';
          // $('#ok').addClass('closed2');
    }
  });
});
 $(".closed2").click(function() {
           window.location.href = '{{ route('adminUser') }}';
          // $('#create').modal('hide');
   });
  // Show function
  $(document).on('click', '.show-modal', function() {
    $('#show').modal('show');
    $('#nama-show').val($(this).data('nama'));
    $('#email-show').val($(this).data('email'));
    $('#password-show').val($(this).data('password'));
    $('#status-show').val($(this).data('status'));
    $('#avatar-show').val($(this).data('avatar'));
    $('#tgl_lahir-show').val($(this).data('tgl_lahir'));
    $('#alamat-show').val($(this).data('alamat'));
    $('#no_HP-show').val($(this).data('no_hp'));
    $('#created_at-show').val($(this).data('created_at'));
    $('#updated_at-show').val($(this).data('updated_at'));
    $('.modal-title').text('Show Post');
    // console.log($(this).data('no_HP'));
  });
</script>

<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

{{-- <script type="text/javascript">
  window.setTimeout(function() {
  $("#berhasil").fadeTo(5000,0).slideUp(5000, function(){
      $(this).remove();
  });
  }, 1800);
</script> --}}
<script>
  document.getElementById("adminForm").setAttribute("class","active");
</script>
@endsection