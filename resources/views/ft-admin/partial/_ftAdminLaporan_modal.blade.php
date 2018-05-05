{{-- form model --}}
<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-form" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header" id="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title text-center" ></h3>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_user" name="id_user" value="{{ $user->id }}">
                    <input type="hidden" id="id" name="id">
                    {{-- input form --}}
                   <span id="form-input">
                    @php
                     $a = 1;
                   @endphp
                   @foreach ($forms as $form)
                   @if (substr($form->nama,0,10) != 'keterangan') 
                        <label class="col-md-1 text-center">{{ $a++}}.</label>
                   @else
                        <label class="col-md-1"></label>
                   @endif


                     @if ($form->tipe =='text')
                      <div class="form-group">
                          <label for="{{ $form->slug }}" class="col-md-2">{{ $form->nama }}</label>
                          <div class="col-md-8">
                              <input type="text" id="{{ $form->slug }}" name="{{ $form->slug }}" class="form-control" placeholder="{{ $form->nama }}" autofocus required >
                              <span class="help-block with-errors"></span>
                          </div>
                     </div>

                     @elseif($form->tipe =='textarea')
                          <div class="form-group">
                              {{-- @if (substr($form->nama,0,10) == 'keterangan') --}}
                                {{-- <label for="{{ $form->slug }}" class="col-md-2 "></label> --}}
                              {{-- @else --}}
                                <label for="{{ $form->slug }}" class="col-md-2 ">{{ $form->nama }}</label>

                              {{-- @endif --}}

                              <div class="col-md-8">
                                @php
                                  $textarea = $form->setTextArea->first();
                                @endphp
                                <textarea id="{{ $form->slug }}" name="{{ $form->slug }}" placeholder="{{ $form->nama }}" class="form-control" cols="10" rows="{{ $textarea->row }}" @if (substr($form->nama,0,10) != 'keterangan') required autofocus @endif ></textarea>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 

                      @elseif($form->tipe =='date')
                          <div class="form-group">
                              <label for="{{ $form->slug }}"  class="col-md-2 ">{{ $form->nama }}</label>
                              <div class="col-md-8">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right formdatepicker" id="{{ $form->slug }}" name="{{ $form->slug }}" autofocus required placeholder="2018-12-30">
                                </div>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 

                      @elseif($form->tipe =='time')
                          <div class="form-group">
                              <label for="{{ $form->slug }}" class="col-md-2  ">{{ $form->nama }}</label>
                              <div class="col-md-8">
                                 <div class="input-group bootstrap-timepicker">
                                  <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right timepicker" id="{{ $form->slug }}" name="{{ $form->slug }}" required autofocus placeholder="23:59">
                                </div>
    
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div>                       

                      @elseif($form->tipe =='file')
                          <div class="form-group">
                              <label for="{{ $form->slug }}" class="col-md-2">{{ $form->nama }}</label>
                              <div class="col-md-8">
                                <div class="input-group ">
                                  <div class="input-group-addon">
                                    <i class="fa fa-upload"></i>
                                  </div>
                                  <input type="file" class="form-control pull-right " id="{{ $form->slug }}" name="{{ $form->slug }}" required autofocus>
                                </div>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                         
                      @elseif($form->tipe =='checkbox')
                          <div class="form-group">
                              <label for="{{ $form->slug }}" class="col-md-2  ">{{ $form->nama }}</label>
                              <div class="col-md-8 ">
                               @php
                                  $pilihans = $form->pilihan->all();
                                @endphp
                                @foreach ($pilihans as $pilihan)
                                   <label class="form-control"> 
                                      <input type="checkbox" class="flat" name="{{ $form->slug.'[]' }}" autocomplete="off" value="{{ $pilihan->slug }}"> {{ $pilihan->nama }}
                                    </label>
                                @endforeach
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 

                      @elseif($form->tipe =='radio')
                          <div class="form-group">
                              <label for="{{ $form->slug }}" class="col-md-2  ">{{ $form->nama }}</label>
                              <div class="col-md-8 ">
                               @php
                                  $pilihans = $form->pilihan->all();
                                @endphp
                                @foreach ($pilihans as $pilihan)
                                   <label class="form-control"> 
                                      <input type="radio" class="flat" name="{{ $form->slug}}" autocomplete="off" value="{{ $pilihan->slug }}"> {{ $pilihan->nama }}
                                    </label>
                                @endforeach
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                       @elseif($form->tipe =='select')
                          <div class="form-group">
                              <label for="{{ $form->slug }}" class="col-md-2  ">{{ $form->nama }}</label>
                              <div class="col-md-8 ">
                                <select id="{{ $form->slug }}" name="{{ $form->slug }}" class="form-control"  style="margin: 0px ;">
                                  <option value=""> --pilih-- </option>
                                 @php
                                    $pilihans = $form->pilihan->all();
                                  @endphp
                                  @foreach ($pilihans as $pilihan)
                                     <option value="{{ $pilihan->slug }}">{{ $pilihan->nama }}</option>
                                  @endforeach
                                </select>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 

                    {{--       <span>
                            <div class=\"form-group {{ $errors->has("pilihan[]") ? "has-error" : "" }}\"> 
                              <label for="pilihan" class="col-md-2 col-md-offset-1" align="right">List pilihan :</label> 
                              <div class="col-md-7"> 
                                <input type="text" id="pilihan" name="pilihan[]" class="form-control" value="'+data.pilihan[0].nama+'" placeholder="pilihan" autofocus required>  
                                @if ($errors->has("pilihan[]")) <span class="help-block"> <strong>{{ $errors->first("pilihan") }}</strong></span> @endif</div> '+btntambah+'</div></span> --}}
                     @else
                       xxx
                     @endif

                   @endforeach
                    {{-- <div class="form-group">
                          <label for="status" class="col-md-2 col-md-offset-1">Status :</label>
                          <div class="col-md-8">
                              <input type="text" id="status" name="status" class="form-control" readonly value="{{ $user->status }}">
                              <span class="help-block with-errors"></span>
                          </div>
                     </div>
                        
                      <div class="form-group">
                          <label for="view" class="col-md-2  col-md-offset-1">View : </label>
                          <div class="col-md-8" >
                              <span id="view">
                                  <input type="radio" name="view" id="view1" value="show"  >Show 
                                  &emsp;&emsp;&emsp;
                                  <input type="radio" name="view" id="view2"  value="hidden" >Hidden 

                              </span>
                              <span class="help-block with-errors"></span>
                          </div>
                       </div> 

                     <div class="form-group">
                          <label for="urutan" class="col-md-2 col-md-offset-1">Urutan :</label>
                          <div class="col-md-8">
                              <input type="text" id="urutan" name="urutan" class="form-control" autofocus required>
                              <span class="help-block with-errors"></span>
                          </div>
                      </div> 
                       <div class="form-group">
                          <label for="nama" class="col-md-2  col-md-offset-1">Nama : </label>
                          <div class="col-md-8">
                              <input type="text" id="nama" name="nama" class="form-control"  autofocus required >
                              <span class="help-block with-errors"></span>
                          </div>
                        </div> 

                        <div class="form-group" id="form-tipe">
                          <label for="tipe" class="col-md-2  col-md-offset-1" >Tipe : </label>
                            <div class="col-md-8">
                               <select  id="tipe" name="tipe" class="form-control " autofocus required style="width: 100% ;" >
                                  <option value=""> --pilih-- </option>
                                  <option value="text" >Text (jawaban singkat)</option>
                                  <option value="textarea" >TextArea (jawaban panjang )</option>
                                  <option value="date" >Date (tanggal)</option>
                                  <option value="time" >Time (waktu)</option>
                                  <option value="file"  >Unggah File</option>
                                  <option value="checkbox" >Checkbox</option>
                                  <option value="radio"   >Radio</option>
                                  <option value="select"  >Select</option>
                                 
                                </select>
                              <span class="help-block with-errors"></span>


                           </div>
                        </div>
 --}}
                        {{-- keterangan tipe--}}
{{--                         <span id="keterangan-tipe">
                          <div class="form-group">
                          <label for="ket-tipe" class="col-md-2  col-md-offset-1">Tipe : </label>
                          <div class="col-md-8">
                              <input type="text" id="ket-tipe"  class="form-control" >
                              <span class="help-block with-errors"></span>
                          </div>
                        </div> 
                        </span> --}}
                        {{-- set text area --}}
                        {{-- <span id="textarea-set" >     </span> --}}
                      
                        {{-- pilihan --}}
                        {{-- <span id="pilihan-set">    </span> --}}
 

           
                    </span>
                    {{-- end input form --}}

                    {{-- show form --}}
                   <span id="form-show">
</span>

                  {{-- delete form --}}
                   <span id="form-delete" class="inline">
                     <p class="text-center" id="form-delete-text"></p>
                   </span>
                   {{-- end delete form --}}
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