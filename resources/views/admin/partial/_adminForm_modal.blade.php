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
                    <input type="hidden" id="id" name="id">
                    {{-- input form --}}
                   <span id="form-input">
                    <div class="form-group">
                          <label for="status" class="col-md-2 col-md-offset-1">Status :</label>
                          <div class="col-md-8">
                              <input type="text" id="status" name="status" class="form-control" readonly value="{{ $status }}">
                              <span class="help-block with-errors"></span>
                          </div>
                     </div>
                        
                      <div class="form-group">
                          <label for="view" class="col-md-2  col-md-offset-1">View : </label>
                          <div class="col-md-8" >
                              <span id="view">
                                {{-- <label class="form-control" > --}}
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

                        {{-- keterangan tipe--}}
                        <span id="keterangan-tipe">
                          <div class="form-group">
                          <label for="ket-tipe" class="col-md-2  col-md-offset-1">Tipe : </label>
                          <div class="col-md-8">
                              <input type="text" id="ket-tipe"  class="form-control" >
                              <span class="help-block with-errors"></span>
                          </div>
                        </div> 
                        </span>
                        {{-- set text area --}}
                        <span id="textarea-set" >
                        </span>
                      
                        {{-- pilihan --}}
                        <span id="pilihan-set">
                        </span>
 

           
                    </span>
                    {{-- end input form --}}

                    {{-- show form --}}
                   <span id="form-show">
                    {{-- text --}}
                      <span id="form-show-text">
                          <div class="form-group">
                              <label for="show-text" id="show-text-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8">
                                  <input type="text" id="show-text"  placeholder="" class="form-control" >
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                      </span>
                      {{-- text area --}}
                      <span id="form-show-textarea">
                           <div class="form-group">
                              <label for="show-textarea" id="show-textarea-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8">
                                <textarea id="show-textarea" placeholder="" class="form-control" cols="10" rows="5"></textarea>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                      </span>
                    {{-- date --}}
                      <span id="form-show-date">
                          <div class="form-group">
                              <label for="show-date" id="show-date-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8">
                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right formdatepicker" id="show-date">
                                </div>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                      </span>
                    {{-- time --}}
                      <span id="form-show-time">
                          <div class="">
                          <div class="form-group">
                              <label for="show-time" id="show-time-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8">
                                 <div class="input-group bootstrap-timepicker">
                                  <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right timepicker" id="show-time">
                                </div>
    
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                          </div> 
                      </span>
                      {{-- file --}}
                      <span id="form-show-file">
                          <div class="form-group">
                              <label for="show-file" id="show-file-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8">
                                <div class="input-group ">
                                  <div class="input-group-addon">
                                    <i class="fa fa-upload"></i>
                                  </div>
                                  <input type="file" class="form-control pull-right " id="show-file">
                                </div>
                                  <span class="help-block with-errors"></span>
                              </div>
                          </div> 
                      </span>
                      {{-- checkbox --}}
                       <span id="form-show-checkbox">
                         <div class="form-group">
                              <label for="show-checkbox" id="show-checkbox-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8 " id="show-checkbox">
                   
                          </div> 
                        </div>
                      </span>
                      {{-- radio --}}
                      <span id="form-show-radio">
                          <div class="form-group">
                              <label for="show-radio" id="show-radio-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8 " id="show-radio">
                   
                          </div> 
                        </div>                         
                      </span>   
                      {{-- select --}}
                      <span id="form-show-select">
                           <div class="form-group">
                              <label for="show-select" id="show-select-label" class="col-md-2  col-md-offset-1"></label>
                              <div class="col-md-8">
                               <select id="show-select" class="form-control"  style="margin: 0px ;">
                                <option value=""> --pilih-- </option>
                              </select>
                          </div> 
                        </div>
                      </span>
                   </span>
                  {{-- end show form --}}

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