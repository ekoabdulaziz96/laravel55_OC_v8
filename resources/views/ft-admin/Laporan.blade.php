
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
  <div class="box box-success">
    <div class="box-title">
      <div class="panel panel-default">
      <div class="panel-heading">
         <i style="font-size: 20px">Kelola Form <u >{{ $user->status }}</u></i>
{{--          @foreach ($forms as $form)
           {{ $form->nama }}
         @endforeach --}}

       
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
        <div class="table-responsive">
            {{-- <table id="Form-table" class="table table-striped table-responsive table-bordered table-hover"> --}}
            <table id="form-table"  class="display responsive nowrap table  table-responsive table-bordered "  width="100%" >
                        <thead >
                            <tr class="bg-green color-palette">
                                <th width="5%">No</th>
                                <th width="20%">Tgl laporan (th-bln-hr)</th>
                                <th  width="20%">Kedaluwarsa</th>
                                <th  width="20%">Status Laporan</th>
                                <th  width="20%">Acc Status Laporan</th>
                                <th class="text-center "  width="15%" >
                         <a onclick="addLaporan()" class="btn btn-success btn-sm" style="width: 100% ;background-color: #14CA77" data-toggle="tooltip" data-placement="top" title="Tambah"><i class="glyphicon glyphicon-plus"></i></a>
                         {{-- <a href="{{ url('admin/form/create') }}" class="btn btn-success btn-sm" style="width: 100% ;"><i class="glyphicon glyphicon-plus"></i></a> --}}
                                </th>
                            </tr>
                        </thead>

                        <tbody ></tbody>
           </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



@include('ft-admin/partial/_ftAdminLaporan_modal')
   
@endsection

@section('script')
 @if(session('success'))

    <script>
  $(document).ready(function(){
        swal({
          title: 'Success!',
          text: 'cek',
          type: 'success',
          timer: 2000
      }).catch(swal.noop);

  });
 
    </script>
  </div>
  @php
    echo $status;
  @endphp
@endif
    <script type="text/javascript">
      var table = $('#form-table').DataTable({
                      processing: false,
                      serverSide: true,
                      responsive: true,
                      ajax: "{{ route('api.ft-admin.laporan',$status_laporan) }}",
                      columns: [
                        {data: 'nomor', name: 'nomor'},
                        {data: 'created', name: 'created'},
                        {data: 'expired', name: 'expired'},
                        {data: 'status_laporan', name: 'status_laporan'},
                        {data: 'acc_laporan', name: 'acc_laporan'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
                    });


 $(function () {
    //Flat red color scheme for iCheck
    $('input[type="checkbox"], input[type="radio"]').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    $("tr:odd").addClass("odd");
    $("tr:even").addClass("even");
  });

</script>
<script>
  document.getElementById("ftAdminLaporan").setAttribute("class","active");
   if ('{{ $status_laporan }}' == 'baru'){
  document.getElementById("ftAdminLaporan_baru").setAttribute("class","active");
  }else    if ('{{ $status_laporan }}' == 'proses'){
  document.getElementById("ftAdminLaporan_proses").setAttribute("class","active");
  }else    if ('{{ $status_laporan }}' == 'perbaikan'){
  document.getElementById("ftAdminLaporan_perbaikan").setAttribute("class","active");
  }else    if ('{{ $status_laporan }}' == 'distujui'){
  document.getElementById("ftAdminLaporan_distujui").setAttribute("class","active");
  }
</script>
@include('ft-admin/partial/_ftAdminLaporan_script')

@endsection
