
      <script>
          // $(document).ready(function(){
              {{-- @foreach ($forms as $form) --}}
                      @php
                         // $pilihans = $form->pilihan->all();
                      @endphp
                      {{-- @foreach ($pilihans as $pilihan) --}}
                        {{-- // if('{{ $form->tipe }}' =='radio' || '{{ $form->tipe }}' =='checkbox'){ --}}
                          {{-- // $('#{{ $form->slug.$pilihan->slug }}').iCheck('uncheck'); --}}
                        // }
                      {{-- @endforeach --}}
                {{-- @endforeach --}}
            // }); 

      function addLaporan() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        // $('#ModalAdd').modal('show');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Form Tambah ');
            $('#modal-header').addClass('modal-header-add');
            $('#modal-footer').addClass('modal-footer-add'); 
            $('#modal-header').removeClass('modal-header-edit');
            $('#modal-footer').removeClass('modal-footer-edit');
            $('#modal-header').removeClass('modal-header-delete');
            $('#modal-footer').removeClass('modal-footer-delete'); 
            $('#modal-header').removeClass('modal-header-show');
            $('#modal-footer').removeClass('modal-footer-show');

            $('#form-input').show();
            // $('#keterangan-tipe').hide();
            $('#form-delete').hide();
            $('#form-show').hide();
              var i = 1;
              @foreach ($form_all as $form)
                
                if('{{$form->view}}'=='hidden'){
                   $('#view_{{$form->slug}}').hide();
                   $('#{{$form->slug}}').removeAttr('name','{{$form->slug}}');
                   $('#{{$form->slug}}').removeAttr('required','required');
                   $('#{{$form->slug}}').removeAttr('autofokus','autofokus');
                   
                } else {
                   if ('{{ $form->nama }}'.substring(0,10) != 'keterangan') {
                      $('#view_no_{{$form->slug}}').text(i+'.');
                      i = i +1;
                   }
                     $('#view_{{$form->slug}}').show();
                  if ('{{$form->tipe}}' == 'file' ){
                     $('#{{$form->slug}}').attr('required','required');
                     $('#{{$form->slug}}').attr('autofokus','autofokus');
                     $('#file_{{$form->slug}}').hide();
                  }
                }

                @php
                   $pilihans = $form->pilihan->all();
                @endphp
                @foreach ($pilihans as $pilihan)
                  if('$form->view'=='hidden'){
                     if('{{ $form->tipe }}' =='radio') {
                      $('#{{ $form->slug.$pilihan->slug }}').removeAttr('name','{{$form->slug}}');
                      $('#{{ $form->slug.$pilihan->slug }}').removeAttr('required','required');
                      $('#{{ $form->slug.$pilihan->slug }}').removeAttr('autofokus','autofokus');
                     }
                     if('{{ $form->tipe }}' =='checkbox') {
                      $('#{{ $form->slug.$pilihan->slug }}').removeAttr('name','{{$form->slug}}[]');

                    }
                   }
                  if('{{ $form->tipe }}' =='radio' || '{{ $form->tipe }}' =='checkbox'){
                      $('#{{ $form->slug.$pilihan->slug }}').removeAttr('checked','checked');
                  }
                @endforeach
              @endforeach
            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').removeClass('btn-danger');
            $('#button-submit').addClass('btn-success');
            $('#button-submit').removeClass('btn-warning');
            $('#button-submit-text').text('Tambah');

      }

      function editLaporan(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('ft-admin/laporan') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Form Edit');
            
            $('#modal-header').removeClass('modal-header-add');
            $('#modal-footer').removeClass('modal-footer-add'); 
            $('#modal-header').addClass('modal-header-edit');
            $('#modal-footer').addClass('modal-footer-edit');
            $('#modal-header').removeClass('modal-header-delete');
            $('#modal-footer').removeClass('modal-footer-delete'); 
            $('#modal-header').removeClass('modal-header-show');
            $('#modal-footer').removeClass('modal-footer-show');
  
            $('#form-input').show();
            // $('#keterangan-tipe').show();            
            $('#form-delete').hide();
            $('#form-show').hide();

            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').removeClass('btn-danger');
            $('#button-submit').removeClass('btn-success');
            $('#button-submit').addClass('btn-warning');
            $('#button-submit-text').text('Perbarui');
              //normalisasi show all
              var i = 1;
              @foreach ($form_all as $form)
              if(data.{{ $form->slug }} == null && '{{ $form->nama }}'.substring(0,10) != 'keterangan'){ 
                 $('#view_{{$form->slug}}').hide();
                 $('#view_ket_{{$form->slug}}').hide();
                  $('#{{$form->slug}}').removeAttr('required','required');
                  $('#{{$form->slug}}').removeAttr('autofokus','autofokus');
              }else if(data.{{ $form->slug }} != null){ 
                 $('#view_{{$form->slug}}').show();
                 $('#view_ket_{{$form->slug}}').show();
                 $('#{{$form->slug}}').attr('name','{{$form->slug}}');

                 if ('{{ $form->nama }}'.substring(0,10) != 'keterangan') {
                  $('#view_no_{{$form->slug}}').text(i+'.');
                  i = i +1;

                  $('#{{$form->slug}}').attr('required','required');
                  $('#{{$form->slug}}').attr('autofokus','autofokus');
                }
                @php
                   $pilihans = $form->pilihan->all();
                @endphp
                @foreach ($pilihans as $pilihan)
                     if('{{ $form->tipe }}' =='radio') {
                      $('#{{ $form->slug.$pilihan->slug }}').attr('name','{{$form->slug}}');
                      $('#{{ $form->slug.$pilihan->slug }}').attr('required','required');
                      $('#{{ $form->slug.$pilihan->slug }}').attr('autofokus','autofokus');
                     }
                     if('{{ $form->tipe }}' =='checkbox') {
                      $('#{{ $form->slug.$pilihan->slug }}').attr('name','{{$form->slug}}[]');

                    }

                  if('{{ $form->tipe }}' =='radio' || '{{ $form->tipe }}' =='checkbox'){
                      $('#{{ $form->slug.$pilihan->slug }}').removeAttr('checked','checked');
                  }
                @endforeach
              }
              @endforeach

            //view berdasarkan tgl
            $('#id').val(data.id); 
              @foreach ($form_all as $form)
                if('{{$form->tipe}}' != 'file' && '{{$form->tipe}}' != 'checkbox'){
                   $('#{{$form->slug}}').val(data.{{ $form->slug }});
                }else if ('{{$form->tipe}}' == 'file'){
                   $('#{{$form->slug}}').removeAttr('required','required');
                   $('#{{$form->slug}}').removeAttr('autofokus','autofokus');

                   $('#file_{{$form->slug}}').show();
                   $('#file_download_{{$form->slug}}').attr('href',data.{{ $form->slug }});
                   $('#file_text_{{$form->slug}}').text(data.{{ $form->slug }});
                }
                @php
                   $pilihans = $form->pilihan->all();
                @endphp
                @foreach ($pilihans as $pilihan)
                  if('{{ $form->tipe }}' =='radio' ){
                    if (data.{{ $form->slug }} == '{{ $pilihan->nama }}'){
                      $('#{{ $form->slug.$pilihan->slug }}').attr('checked','checked');
                    }
                  }else if ('{{ $form->tipe }}' =='checkbox'){
                    if (jQuery.inArray("{{ $pilihan->slug }}",  data.{{ $form->slug }}) != -1){
                      $('#{{ $form->slug.$pilihan->slug }}').attr('checked','checked');
                    }
                  }
                @endforeach
              @endforeach
          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }   

     function showLaporan(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('ft-admin/laporan') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            
            $('#modal-form').modal('show');
            $('.modal-title').text('Form Detail ');
            
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
             //normalisasi show all
              var i = 1;
              @foreach ($form_all as $form)
              if(data.{{ $form->slug }} == null && '{{ $form->nama }}'.substring(0,10) != 'keterangan'){ 
                 $('#form-show-{{ $form->slug }}').hide();
                 $('#form-show-file-{{ $form->slug }}').hide();
                 $('#form-show-ket_{{ $form->slug }}').hide();

              }else if(data.{{ $form->slug }} != null){ 
                 $('#form-show-{{ $form->slug }}').show();
                 $('#form-show-ket_{{ $form->slug }}').show();

                 if ('{{ $form->nama }}'.substring(0,10) != 'keterangan') {
                  $('#form-show-no-{{ $form->slug }}').text(i+'.');
                  i = i +1;
                }
              }
              @endforeach

            //view berdasarkan tgl
            $('#id').val(data.id); 
              @foreach ($form_all as $form)

               if ('{{$form->tipe}}' == 'file'){
                  $('#form-show-file-{{ $form->slug }}').show();
                  $('#form-show-file-text-{{$form->slug }}').text(data.{{ $form->slug }});
                  $('#form-show-file-download-{{$form->slug }}').attr('href',data.{{ $form->slug }})
                }else  if('{{$form->tipe}}' != 'file'){
                  if(data.{{$form->slug}} == null){
                    $('#form-show-data-{{ $form->slug }}').text('-');
                  }else {
                    $('#form-show-data-{{ $form->slug }}').text(data.{{ $form->slug }});
                  } 
                    }
              @endforeach

            {{-- @foreach ($forms as $form) --}}

              // if ('{{$form->tipe}}' =='file'){
              //  $('#form-show-text-{{$form->slug }}').text(data.{{ $form->slug }});
              //  $('#form-show-download-{{$form->slug }}').attr('href',data.{{ $form->slug }})
              // }else if(data.{{ $form->slug }} == null){
              //  $('#form-show-data-{{$form->slug }}').text('-');
              // }
              //  else{
              //  $('#form-show-data-{{$form->slug }}').text(data.{{ $form->slug }});
              // }
            {{-- @endforeach --}}
            $('#button-submit').hide();
          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }      

      function viewAccLaporanKacab(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('ft-admin/laporan') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form-acc').modal('show');
            $('#modal-form-acc-tittle').text('View Acc Laporan oleh Kepala Cabang ');

            $('#form-show-acc-status').text(data.acc_kacab);
            $('#form-show-acc-komentar').text(data.komentar_kacab);
          },
          error : function() {
              alert("Nothing Data");
          }
        });
      } 


      function deleteLaporan(id) {
        save_method = 'delete';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('ft-admin/laporan') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-form').modal('show');
            $('.modal-title').text('Form Hapus ');
            
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
            $('#form-delete-text').text('Apakah anda yakin ingin menghapus data pada tanggal '+'"'+data.created_at.substring(0,10)+'"');
            $('#form-show').hide();

            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').addClass('btn-danger');
            $('#button-submit').removeClass('btn-success');
            $('#button-submit').removeClass('btn-warning');
            $('#button-submit-text').text('Hapus');

            $('#id').val(data.id);
          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }

      $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                // console.log('cek');
                // if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                // console.log('cek1');

                  if(save_method == 'delete'){
                // console.log('cek2');

                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    // console.log(id+save_method+csrf_token);
                      $.ajax({
                      url : "{{ url('ft-admin/laporan') }}" + '/' + id,
                      type : "POST",
                      data : {'_method' : 'DELETE', '_token' : csrf_token},
                      beforeSend: function(){
                            $("body").css("padding",'0px');
                           swal({
                                title: 'Sedang Memuat...',
                                onOpen: () => {
                                  swal.showLoading()
                                }
                              }).catch(swal.noop);
                            },
                        success : function(data) {
                          $("body").css("padding",'0px');
                          $('#modal-form').modal('hide');
                            table.ajax.reload();
                            console.log(data);
                            swal({
                                title: data.title,
                                text: data.message,
                                type: data.type,
                                timer: data.timer,
                            }).catch(swal.noop);
                      },
                      error : function () {
                           swal({
                                title: 'Oops...',
                                text: 'gagal, menghapus',
                                type: 'error',
                                timer: 5000
                            }).catch(swal.noop);
                      }
                  });
                    return false;
                      
                  }else{
                    if (save_method == 'add') url = "{{ url('ft-admin/laporan') }}";
                    else url = "{{ url('ft-admin/laporan') . '/' }}" + id;

                    $.ajax({
                        url : url,
                        type : "POST",
//                        data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        beforeSend: function(){
                             $("body").css("padding",'0px');
                          swal({
                                title: 'Sedang Memuat...',
                                onOpen: () => {
                                  swal.showLoading()
                                }
                              }).catch(swal.noop);
                            },
                          success : function(data) {
                            $("body").css("padding",'0px');
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: data.title,
                                text: data.message,
                                type: data.type,
                                timer: data.timer,
                            }).catch(swal.noop);
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: 'Maaf, pastikan semua kolom terisi dengan format yang benar',
                                type: 'error',
                                timer: 5000
                            }).catch(swal.noop);
                        }
                    });
                    return false;
                  }
            });
        });

    </script>