
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
         <i style="font-size: 20px">Daftar Status</i>
       
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
    </div>        
    <div class="box-body">
    
      <div class="panel-body">
        <div class="">
            {{-- <table id="status-table" class="table table-striped table-responsive table-bordered table-hover"> --}}
            <table id="status-table"  class="display responsive nowrap table table-striped table-responsive table-bordered table-hover"  width="100%" >
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th  width="40%">Nama</th>
                                <th  width="40%">Kategori</th>
                                <th class="text-center"  width="15%">
                         <a onclick="addForm()" class="btn btn-success btn-sm" style="width: 100% ;"><i class="glyphicon glyphicon-plus"></i></a>
                                </th>
                            </tr>
                        </thead>

                        <tbody></tbody>
           </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


{{-- form model --}}
<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-status" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header" id="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                   <span id="form-input">
                    <div class="form-group">
                        <label for="nama" class="col-md-3 control-label">Nama</label>
                        <div class="col-md-6">
                            <input type="text" id="nama" name="nama" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label for="kategori_id" class="col-md-3 control-label">Kategori</label>
                        <div class="col-md-6">
                             <select class="form-control" id="kategori_id" name="kategori_id" class="form-control" autofocus required style="margin: 0px ;">
                                <option value=""> --pilih-- </option>
                                @php
                                  use App\Kategori;
                                  $kategoris=Kategori::All();
                                  foreach ($kategoris as $kategori) {
                                echo '<option value="'.$kategori->id.'">'. $kategori->nama.'</option>';
                                  }
                                @endphp
                                
                                            
                              </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div> 
                    </span>
                   <span id="form-show">
                     <table id="form-show-table" class="table table-striped table-responsive" style="">
                        <tr>
                          <td width="30%" align="center">Nama</td>
                          <td width="3%" align="center">:</td>
                          <td id="form-show-nama" width="67%"></td>
                        </tr>
                         <tr>
                          <td width="30%" align="center">Kategori</td>
                          <td width="3%" align="center">:</td>
                          <td id="form-show-ketegori-id" width="67%"></td>
                        </tr>
                     </table>
                   </span>

                   <span id="form-delete" class="inline">
                     <p class="text-center" id="form-delete-text"></p>
                   </span>
                </div>

                <div class="modal-footer" id="modal-footer">
                    <span >
                      <button id="button-submit" type="submit"  class="btn btn-primary btn-save">
                        <span id="button-submit-text">Submit</span>
                      </button>
                    </span>
                    <span id="button-cancel">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      <span id="button-cancel-text">Cancel</span>
                    </button>            
                    </span>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
 
    <script type="text/javascript">
      var table = $('#status-table').DataTable({
                      processing: false,
                      serverSide: true,
                      responsive: true,
                      ajax: "{{ route('api.status') }}",
                      columns: [
                        {data: 'nomor', name: 'nomor'},
                        {data: 'nama', name: 'nama'},
                        {data: 'kategori', name: 'kategori'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
                    });

      function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Add Status');
            $('#modal-header').addClass('modal-header-add');
            $('#modal-footer').addClass('modal-footer-add'); 
            $('#modal-header').removeClass('modal-header-edit');
            $('#modal-footer').removeClass('modal-footer-edit');
            $('#modal-header').removeClass('modal-header-delete');
            $('#modal-footer').removeClass('modal-footer-delete'); 
            $('#modal-header').removeClass('modal-header-show');
            $('#modal-footer').removeClass('modal-footer-show');

            $('#form-input').show();
            $('#form-delete').hide();
            $('#form-show').hide();

             $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').removeClass('btn-danger');
            $('#button-submit').addClass('btn-success');
            $('#button-submit').removeClass('btn-warning');
            $('#button-submit-text').text('Add');


      }

      function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/status') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Status');
            
            $('#modal-header').removeClass('modal-header-add');
            $('#modal-footer').removeClass('modal-footer-add'); 
            $('#modal-header').addClass('modal-header-edit');
            $('#modal-footer').addClass('modal-footer-edit');
            $('#modal-header').removeClass('modal-header-delete');
            $('#modal-footer').removeClass('modal-footer-delete'); 
            $('#modal-header').removeClass('modal-header-show');
            $('#modal-footer').removeClass('modal-footer-show');
  
            $('#form-input').show();
            $('#form-delete').hide();
            $('#form-show').hide();

            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').removeClass('btn-danger');
            $('#button-submit').removeClass('btn-success');
            $('#button-submit').addClass('btn-warning');
            $('#button-submit-text').text('Update');


            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#kategori_id').val(data.kategori_id);

          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }
      function deleteForm(id) {
        save_method = 'delete';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/status') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Delete Status');
            
            $('#modal-header').removeClass('modal-header-add');
            $('#modal-footer').removeClass('modal-footer-add'); 
            $('#modal-header').removeClass('modal-header-edit');
            $('#modal-footer').removeClass('modal-footer-edit');
            $('#modal-header').addClass('modal-header-delete');
            $('#modal-footer').addClass('modal-footer-delete'); 
            $('#modal-header').removeClass('modal-header-show');
            $('#modal-footer').removeClass('modal-footer-show');

            $('#form-input').hide();
            $('#form-delete').show();
            $('#form-delete-text').text('Apakah anda yakin ingin menghapus '+'"'+data.nama+'"');
            $('#form-show').hide();

            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').addClass('btn-danger');
            $('#button-submit').removeClass('btn-success');
            $('#button-submit').removeClass('btn-warning');
            $('#button-submit-text').text('Delete');


            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#kategori_id').val(data.kategori_id);
          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }
       function showForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/status') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Detail Status');
            
            $('#modal-header').removeClass('modal-header-add');
            $('#modal-footer').removeClass('modal-footer-add'); 
            $('#modal-header').removeClass('modal-header-edit');
            $('#modal-footer').removeClass('modal-footer-edit');
            $('#modal-header').removeClass('modal-header-delete');
            $('#modal-footer').removeClass('modal-footer-delete'); 
            $('#modal-header').addClass('modal-header-show');
            $('#modal-footer').addClass('modal-footer-show');
            
            $('#form-input').hide();
            $('#form-delete').hide();
            $('#form-show').show();
            $('#form-show-nama').text(data.nama);
            $('#form-show-ketegori-id').text(data.kategori_id);

            $('#button-submit').hide();

          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }

      function deleteData(id){
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          swal({
              title: 'Apakah anda yakin?',
              text: "ingin menghapus "+ id,
              type: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Delete'
          }).then(function () {
              $.ajax({
                  url : "{{ url('admin/status') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
                  success : function(data) {
                      table.ajax.reload();
                      swal({
                          title: 'Success!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                      })
                  },
                  error : function () {
                      swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
          });
        }

    function deleteData(id){
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          swal({
              title: 'Apakah anda yakin?',
              text: "ingin menghapus "+ id,
              type: 'warning',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Delete'
          }).then(function () {
              $.ajax({
                  url : "{{ url('admin/kategori') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
                  success : function(data) {
                      table.ajax.reload();
                      swal({
                          title: 'Success!',
                          text: data.message,
                          type: 'success',
                          timer: '1500'
                      })
                  },
                  error : function () {
                      swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
          });
        }

      $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                // console.log('cek');
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                // console.log('cek1');

                  if(save_method == 'delete'){
                // console.log('cek2');

                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    console.log(id+save_method+csrf_token);
                      $.ajax({
                      url : "{{ url('admin/status') }}" + '/' + id,
                      type : "POST",
                      data : {'_method' : 'DELETE', '_token' : csrf_token},
                      success : function(data) {
                          $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: 2000
                            }).catch(swal.noop);
                      },
                      error : function () {
                           swal({
                                title: 'Oops...',
                                text: 'maaf, maksimal 50 huruf untuk atribut nama',
                                type: 'error',
                                timer: 5000
                            }).catch(swal.noop);
                      }
                  });
                    return false;
                      
                  }else{
                    if (save_method == 'add') url = "{{ url('admin/status') }}";
                    else url = "{{ url('admin/status') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
//                        data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: 2000
                            }).catch(swal.noop);
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: 'maaf, maksimal 50 huruf untuk atribut nama',
                                type: 'error',
                                timer: 5000
                            }).catch(swal.noop);
                        }
                    });
                    return false;
                  }

                }
            });
        });
      function eximForm() {
        $('#modal-exim').modal('show');
        $('#modal-exim form')[0].reset();
      }


    </script>
@endsection
