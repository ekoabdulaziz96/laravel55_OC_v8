
      <script>

      function addCabang() {
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
            // $('#form-show').hide();

            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').removeClass('btn-danger');
            $('#button-submit').addClass('btn-success');
            $('#button-submit').removeClass('btn-warning');
            $('#button-submit-text').text('Tambah');

      }

      function editCabang(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/cabang') }}" + '/' + id + "/edit",
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
            // $('#form-show').hide();

            $('#button-submit').show();
            $('#button-submit').removeClass('btn-primary');
            $('#button-submit').removeClass('btn-danger');
            $('#button-submit').removeClass('btn-success');
            $('#button-submit').addClass('btn-warning');
            $('#button-submit-text').text('Perbarui');


            $('#id').val(data.id);   
            $('#nama').val(data.nama);
            $('#maks_wilayah').val(data.maks_wilayah);

          },
          error : function() {
              alert("Nothing Data");
          }
        });
      }   

      
      function deleteCabang(id) {
        save_method = 'delete';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
          url: "{{ url('admin/cabang') }}" + '/' + id + "/edit",
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
            $('#form-delete-text').text('Apakah anda yakin ingin menghapus '+'"'+data.nama+'"');
            // $('#form-show').hide();

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
                      url : "{{ url('admin/cabang') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('admin/cabang') }}";
                    else url = "{{ url('admin/cabang') . '/' }}" + id;

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