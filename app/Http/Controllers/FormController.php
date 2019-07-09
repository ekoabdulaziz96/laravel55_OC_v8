<?php

namespace App\Http\Controllers;

use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Form;
use App\Pilihan;
use App\SetTextArea;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.form');
        //
    }
    public function formFtAdmin()
    {
        $status = 'ft_admin';
        return view('admin.form',compact('status'));
        //
    }    
    public function formFtSponsorship()
    {
        $status = 'ft_sponsorship';
        return view('admin.form',compact('status'));
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $header = 'panel-success';
        // $footer = 'modal-footer-add';
        // $button = 'btn-success';
        // return view('admin/form_tambah',compact(['header','footer','button']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Form::where('nama',$request->nama)->where('status',$request->status)->exists()){
           return response()->json([
                'success' => true,
                'message' => 'maaf, nama form "'.$request->nama.'" sudah ada. Silahkan input dengan nama berbeda',
                'title'=> 'Gagal Menambahkan!',
                'type'=> 'warning',
                'timer'=> 5000
            ]);
        }else if((string)(int)$request->nama  == (string)$request->nama ) {
           return response()->json([
                'success' => true,
                'message' => 'maaf, nama form harus bertipe string ( A-Z, a-z, 0-9, karakter lain) tidak boleh angka(integer)',
                'title'=> 'Gagal Menambahkan!',
                'type'=> 'warning',
                'timer'=> 5000
            ]);
        }else
   
        if ($request->has(['row'])) {
            if ((string)(int)$request->row == (string)$request->row && $request->row >= 0 && $request->row <=100){
                $textarea =  $request->only(['row']);
            }else {
                $textarea = ["row"=> 2];
            }

            $form =  $request->only(['nama','tipe','status','view','kategori']);
            if ((string)(int)$request->urutan == (string)$request->urutan ){
               $form['urutan'] = $request->urutan;
            }else {
                $form['urutan'] = 999;
            }
            $form['slug'] = str_slug($request->nama,'_');
            $forms = Form::create($form);

            $forms->setTextArea()->create($textarea);
            
        }else if ($request->has(['pilihan'])) {
            // for($i=0;$i<count($request->pilihan);$i++){
            //     if ($request->pilihan[$i] == ''){
            //         $request->pilihan[$i] = '-';
            //     }
            // }

            $form =  $request->only(['nama', 'tipe','status','view','kategori']);
            $form['slug'] = str_slug($request->nama,'_');
            if ((string)(int)$request->urutan == (string)$request->urutan ){
               $form['urutan'] = $request->urutan;
            }else {
                $form['urutan'] = 999;
            }
            $forms = Form::create($form);

            for($i=0;$i<count($request->pilihan);$i++){
                $forms->pilihan()->create([
                    'nama'=> $request->pilihan[$i],
                    'slug'=>str_slug($request->pilihan[$i], '-'),
                ]);
            }
        }else {
            //form
            $form =  $request->only(['nama', 'tipe','status','view','kategori']);
            if ((string)(int)$request->urutan == (string)$request->urutan ){
               $form['urutan'] = $request->urutan;
            }else {
                $form['urutan'] = 999;
            }
            $form['slug'] = str_slug($request->nama,'_');
            // $form['view'] = '-';
            $forms = Form::create($form);

        }
            // keterangan
            $find =  Form::where('nama',$request->nama)->where('status',$request->status)->first();
            $ket['nama'] = 'keterangan '.$find->nama;
            $ket['slug'] = 'ket_'.str_slug($request->nama,'_');
            $ket['tipe'] = 'textarea';
            $ket['status'] = $find->status;
            $ket['urutan'] = $find->urutan;
            $ket['view'] = $find->view;
            $ket['kategori'] = $find->kategori;
            $kets = Form::create($ket);
            $kets->setTextArea()->create(['row'=>2]);

           //schema DB
            if($request->tipe == 'textarea'){
                Schema::table($request->status, function ($table) use ($request) {
                    $table->string(str_slug($request->nama,'_'),500)->nullable()->default(null);
                });

            // }else if($request->tipe == 'date'){
            //     Schema::table($request->status, function ($table) use ($request) {
            //         $table->date(str_slug($request->nama,'_'))->nullable()->default(null);
            //     });

            // }else if($request->tipe == 'time'){
            //     Schema::table($request->status, function ($table) use ($request) {
            //         $table->time(str_slug($request->nama,'_'))->nullable()->default(null);
            //     });

            }else{
                Schema::table($request->status, function ($table) use ($request) {
                    $table->string(str_slug($request->nama,'_'),200)->nullable()->default(null);
                });
            }
            //schema keterangan
            Schema::table($request->status, function ($table) use ($request) {
                $table->string('ket_'.str_slug($request->nama,'_'),999)->nullable()->default(null);

            });

        return response()->json([
            'success' => true,
            'message' => 'Form berhasil ditambahkan',
            'title'=> 'Sukses Menambahkan!',
            'type'=> 'success',
            'timer'=> 2500
        ]);
          // return 'cek';
          // return redirect()->route('admin.form')->withSuccess('Success adding a post !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Form::findOrFail($id);
        $count = Pilihan::where('form_id',$id)->count();
        $pilihans = Pilihan::where('form_id',$id)->get();
        $textarea = SetTextArea::select('row')->where('form_id',$id)->first();

        $form['count']= $count;
        $form['pilihan']= $pilihans;
        $form['textarea']= $textarea;

        return $form;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = Form::findOrFail($id);
        if ($form['tipe']=='textarea'){
            $textarea = $form->setTextArea()->select('row')->get();
            $form['textarea']= $textarea;
        }else if ($form['tipe']=='checkbox'  || $form['tipe']=='radio'  || $form['tipe']=='select'){
            $pilihan = $form->pilihan()->get();
            $count = $form->pilihan()->count();
            $form['count']= $count;
            $form['pilihan']= $pilihan;
        }

       // console.log($Form);
        return $form;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $forms = Form::findOrFail($id);
        if(Form::where('nama',$request->nama)->where('status',$request->status)->where('id','<>',$id)->exists()){
           return response()->json([
                'success' => true,
                'message' => 'maaf, nama form "'.$request->nama.'" sudah ada. Silahkan input dengan nama berbeda',
                'title'=> 'Gagal Menambahkan!',
                'type'=> 'warning',
                'timer'=> 5000
            ]);
        }else  if((string)(int)$request->nama  == (string)$request->nama ) {
           return response()->json([
                'success' => true,
                'message' => 'maaf, nama form harus bertipe string ( A-Z , 0-9, karakter lain) tidak boleh angka(integer)',
                'title'=> 'Gagal Menambahkan!',
                'type'=> 'warning',
                'timer'=> 5000
            ]);
        }else if(substr($request->nama,0,10) == 'keterangan' && $request->tipe == 'textarea'){
            $forms = Form::findOrFail($id);
            $forms->setTextArea()->update(['row'=> $request->row]);
             return response()->json([
                'success' => true,
                'message' => 'Form berhasil diperbarui',
                'title'=> 'Sukses Memperbarui!',
                'type'=> 'success',
                'timer'=> 2500
            ]);
        }else

        if ($request->has(['row'])) {
            if ((string)(int)$request->row == (string)$request->row && $request->row >= 0 && $request->row <=100){
                $textarea =  $request->only(['row']);
            }else {
                $textarea = ["row"=> 2];
            }
          
            $form =  $request->only(['nama', 'tipe','status','view','kategori']);
            $form['slug'] = str_slug($request->nama,'_');
            if ((string)(int)$request->urutan == (string)$request->urutan ){
               $form['urutan'] = $request->urutan;
            }else {
                $form['urutan'] = 999;
            }  
            $forms = Form::findOrFail($id);
            $nama = $forms->nama;
            $tipe = $forms->tipe;
            $status = $forms->status;
            $forms->update($form);
            
            if ($forms->setTextArea()->count()==0){
                $forms->setTextArea()->create($textarea);
            }else {
                $forms->setTextArea()->update($textarea);
            }
            $forms->pilihan()->delete();
            
        }else if ($request->has(['pilihan'])) {
            // for($i=0;$i<count($request->pilihan);$i++){
            //     if ($request->pilihan[$i] == ''){
            //         $request->pilihan[$i] = '-';
            //     }
            // }
            $form =  $request->only(['nama', 'tipe','status','view','kategori']);
            $form['slug'] = str_slug($request->nama,'_');
            if ((string)(int)$request->urutan == (string)$request->urutan ){
               $form['urutan'] = $request->urutan;
            }else {
                $form['urutan'] = 999;
            }
            $forms = Form::findOrFail($id);
            $nama = $forms->nama;
            $tipe = $forms->tipe;
            $status = $forms->status;
            $forms->update($form);

            $forms->setTextArea()->delete();
            $forms->pilihan()->delete();
            for($i=0;$i<count($request->pilihan);$i++){
                $forms->pilihan()->create([
                    'nama'=> $request->pilihan[$i],
                    'slug'=>str_slug($request->pilihan[$i],'_'),
                ]);
            }
        }else {

            $form =  $request->only(['nama', 'tipe','status','view','kategori']);
            $form['slug'] = str_slug($request->nama,'_');
            if ((string)(int)$request->urutan == (string)$request->urutan ){
               $form['urutan'] = $request->urutan;
            }else {
                $form['urutan'] = 999;
            }
            $forms = Form::findOrFail($id);
            $nama = $forms->nama;
            $tipe = $forms->tipe;
            $status = $forms->status;
            $forms->update($form);

            $forms->setTextArea()->delete();
            $forms->pilihan()->delete();
        }

        //keterangan
            $find = Form::findOrFail($id);
            $ket['nama'] = 'keterangan '.$find->nama;
            $ket['slug'] = 'ket_'.str_slug($find->nama,'_');
            $ket['urutan'] = $find->urutan;
            $ket['view'] = $find->view;
            $ket['kategori'] = $find->kategori;
            $kets = Form::where('nama','keterangan '.$nama)->where('status',$status)->first();
            $kets->update($ket);

            //scema tipe change
            if($request->tipe != $tipe){
                if($request->tipe == 'textarea'){
                    Schema::table($request->status, function ($table) use ($nama) {
                        $table->string(str_slug($nama,'_'), 500)->change();
                    });
                // }else if($request->tipe == 'date'){
                //     Schema::table($request->status, function ($table) use ($nama) {
                //         $table->date(str_slug($nama,'_'))->change();
                //     });
                // }else if($request->tipe == 'time'){
                //     Schema::table($request->status, function ($table) use ($nama) {
                //         $table->time(str_slug($nama,'_'))->change();
                //     });
                }else{
                    Schema::table($request->status, function ($table) use ($nama) {
                        $table->string(str_slug($nama,'_'), 200)->change();
                    });
                }
            }
            
            //schema rename
             Schema::table($request->status, function ($table) use ($request, $nama) {
                    $table->renameColumn(str_slug($nama,'_') , str_slug($request->nama,'_'));
                    $table->renameColumn('ket_'.str_slug($nama,'_') , 'ket_'.str_slug($request->nama,'_'));
                });

        return response()->json([
           'success' => true,
            'message' => 'Form berhasil diperbarui',
            'title'=> 'Sukses Memperbarui!',
            'type'=> 'success',
            'timer'=> 2500
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forms = Form::findOrFail($id);
        Form::where('nama','keterangan '.$forms->nama)->where('status',$forms->status)->delete();
        Form::destroy($id);

        Schema::table($forms->status, function ($table) use ($forms) {
            $table->dropColumn(str_slug($forms->nama, '_'));
            $table->dropColumn('ket_'.str_slug($forms->nama, '_'));

        });
        return response()->json([
            'success' => true,
            'message' => 'Form berhasil dihapus',
            'title'=> 'Sukses Menghapus!',
            'type'=> 'success',
            'timer'=> 2500
        ]);
    }

        public function apiForm($status)
    {

        $form = Form::where('status',$status)->get();

        return Datatables::of($form)
            ->addColumn('nomor', function(){
                    global $nomor;
                    return ++$nomor;
            }) 
           ->addColumn('action', function($form){
                if (substr($form->slug,0,4) == 'ket_'){
                        return '<div align="right">'.
                        '<a onclick="showForm('. $form->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a onclick="editFormKet('. $form->id .')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';
                   }else{
                        return '<div align="right" >'.
                        '<a onclick="showForm('. $form->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a onclick="editForm('. $form->id .')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a onclick="deleteForm('. $form->id .')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';
                   }

            })
            ->rawColumns(['nomor', 'action'])->make(true);
    }

}
