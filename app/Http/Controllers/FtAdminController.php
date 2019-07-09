<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\FtAdmin;
use App\User;
use App\Form;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class FtAdminController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanBaru()
    {
        $user = User::findOrFail(2);
        $forms = Form::where('status',$user->status)->where('view','show')->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $form_all = Form::where('status',$user->status)->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $status_laporan = 'baru';
        return view('ft-admin.laporan',compact(['user','status_laporan','forms','form_all']));
    }        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanProses()
    {
        $user = User::findOrFail(2);
        $forms = Form::where('status',$user->status)->where('view','show')->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $form_all = Form::where('status',$user->status)->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $status_laporan = 'proses';
        return view('ft-admin.laporan',compact(['user','status_laporan','forms','form_all']));
    }        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanPerbaikan()
        {
        $user = User::findOrFail(2);
        $forms = Form::where('status',$user->status)->where('view','show')->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $form_all = Form::where('status',$user->status)->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $status_laporan = 'perbaikan';
        return view('ft-admin.laporan',compact(['user','status_laporan','forms','form_all']));
    }          
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanDisetujui()
    {
        $user = User::findOrFail(2);
        $forms = Form::where('status',$user->status)->where('view','show')->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $form_all = Form::where('status',$user->status)->orderBy('kategori', 'asc')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $status_laporan = 'disetujui';
        return view('ft-admin.laporan',compact(['user','status_laporan','forms','form_all']));
    }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                //  if(User::where('email',$request->email)->exists() ){
        //    return response()->json([
        //         'success' => true,
        //         'message' => 'maaf, email user "'.$request->email.'" sudah ada. Silahkan input dengan email berbeda',
        //         'title'=> 'Gagal Menambahkan!',
        //         'type'=> 'warning',
        //         'timer'=> 5000
        //     ]);
        // }else  {
            $user = User::findOrFail($request->id_user);

            $input = $request->except(['id','id_user','hour','minute']);  

            $forms = Form::where('status','ft_admin')->where('view','show')->get();
            foreach ($forms as $form) {
                $nama = $form->slug;
                if($form->tipe=='checkbox'){
                    $input[$nama] = implode("; ",$request->$nama);  
                    // dd($request->$nama);    
                }
                if($form->tipe=='file'){
                    if ($request->hasFile($nama)){
                        $input[$nama] = '/upload/'.$user->status.'/'.str_slug($user->nama, '-').'_'.$user->id.'/'.str_slug(Carbon::now(), '-').'.'.$request->$nama->getClientOriginalExtension();
                        $request->$nama->move(public_path('/upload/'.$user->status.'/'.str_slug($user->nama, '-').'_'.$user->id.'/'), $input[$nama]);
                    }
                }
            }
            $input['expired_at'] = Carbon::now()->addDays(7);  
            $input['status_laporan'] = "baru";

        // if ($request->hasFile('foto')){
        //     $input['foto'] = '/upload/foto/'.str_slug($input['nama'], '-').'.'.$request->foto->getClientOriginalExtension();
        //     $request->foto->move(public_path('/upload/foto/'), $input['foto']);
        // }
            
            $user->ftAdmin()->create($input);

            return response()->json([
                'success' => true,
                'message' => 'Data Laporan baru berhasil ditambahkan',
                'title'=> 'Sukses Menambahkan!',
                'type'=> 'success',
                'timer'=> 2500
            ]);
        // }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FtAdmin  $ftAdmin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FtAdmin  $ftAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan = FtAdmin::findOrFail($id);
        $forms = Form::where('status','ft_admin')->where('tipe','checkbox')->get();
        foreach ($forms as $form) {
            $nama = $form->slug;
            if($laporan->$nama != null){
                $laporan[$nama] = explode("; ",$laporan->$nama);      
            }
        }
        return $laporan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FtAdmin  $ftAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //if(Cabang::where('nama',$request->nama)->where('id','<>',$cabang->id)->exists()){
        //    return response()->json([
        //         'success' => true,
        //         'message' => 'maaf, nama cabang "'.$request->nama.'" sudah ada. Silahkan input dengan nama berbeda',
        //         'title'=> 'Gagal Menambahkan!',
        //         'type'=> 'warning',
        //         'timer'=> 5000
        //     ]);
        // }else {
            $user = User::findOrFail($request->id_user);

            $input = $request->except(['id','id_user','hour','minute']);  

            $forms = Form::where('status','ft_admin')->get();
            foreach ($forms as $form) {
                $nama = $form->slug;
                if ($request->has([$nama])){
                    if($form->tipe=='checkbox'){
                        $input[$nama] = implode("; ",$request->$nama);      
                    }
                    if($form->tipe=='file'){
                        if ($request->hasFile($nama)){
                            $input[$nama] = '/upload/'.$user->status.'/'.str_slug($user->nama, '-').'_'.$user->id.'/'.str_slug(Carbon::now(), '-').'.'.$request->$nama->getClientOriginalExtension();
                            $request->$nama->move(public_path('/upload/'.$user->status.'/'.str_slug($user->nama, '-').'_'.$user->id.'/'), $input[$nama]);
                        }
                    }
                }
            }
            $laporan = FtAdmin::findOrFail($id);
            $laporan->update($input);


            return response()->json([
                'success' => true,
                'message' => 'Data Laporan berhasil diperbarui',
                'title'=> 'Sukses Memperbarui!',
                'type'=> 'success',
                'timer'=> 2500
            ]);    
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FtAdmin  $ftAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laporan = FtAdmin::findOrFail($id);
        $forms = Form::where('status','ft_admin')->get();
            foreach ($forms as $form) {
                $nama = $form->slug;
                if($form->tipe=='file'){
                    if ($laporan->$nama != null){
                        unlink(public_path($laporan->$nama));
                    }
                }
            }
        // FtAdmin::destroy($id);
        $laporan->delete();


        return response()->json([
            'success' => true,
            'message' => 'Form berhasil dihapus',
            'title'=> 'Sukses Menghapus!',
            'type'=> 'success',
            'timer'=> 2500
        ]);
    }

        public function apiLaporan($status_laporan)
    {

        $laporan = FtAdmin::where('status_laporan',$status_laporan)->get();

        return Datatables::of($laporan)
            ->addColumn('nomor', function(){
                    global $nomor;
                    return ++$nomor;
            })->addColumn('created', function($laporan){
                    return substr($laporan->created_at,0,10);
            })->addColumn('expired', function($laporan){
                    if ($laporan->expired_at->year ==Carbon::now()->year && $laporan->expired_at->month ==Carbon::now()->month && $laporan->expired_at->day - Carbon::now()->day >=0) {
                        return $laporan->expired_at->day - Carbon::now()->day. ' hari';
                    } else {
                         return 'kedaluwarsa';
                    }
                    
                    // return $laporan->expired_at->diffInDays( Carbon::now());
            })->addColumn('acc_laporan', function($laporan){
                    if($laporan->acc_kacab == 'disetujui') {$btn_kacab = '#87DE8B';} 
                        else if($laporan->acc_kacab == 'perbaikan') {$btn_kacab = '#E9C02F';} 
                            else {$btn_kacab = '#F97373';}
                    if($laporan->acc_manager == 'disetujui') {$btn_manager = '#87DE8B';}
                        else if($laporan->acc_manager == 'perbaikan') {$btn_manager = '#E9C02F';}
                            else {$btn_manager = '#F97373';}
                    if($laporan->acc_direktur == 'disetujui') {$btn_direktur = '#87DE8B';}
                        else if($laporan->acc_direktur == 'perbaikan') {$btn_direktur = '#E9C02F';}
                            else {$btn_direktur = '#F97373';}
                    return '<div align="center" >' .
               '<a onclick="viewAccLaporanKacab('.$laporan->id .')" style="background-color: '.$btn_kacab.'"  class="btn btn-default btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Acc Laporan Kepala Cabang"><i class="fa fa-user-o " style="color:white"></i></a> ' .               
               '<a onclick="viewAccLaporanManager('.$laporan->id .')" style="background-color: '.$btn_manager.'"  class="btn btn-default btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Acc Laporan Manager"><i class="fa fa-user-circle " style="color:white"></i></a> ' .                
               '<a onclick="viewAccLaporanDirektur('.$laporan->id .')" style="background-color: '.$btn_direktur.'"  class="btn btn-default btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Acc Laporan Direktur"><i class="fa fa-user-circle-o " style="color:white"></i></a> ' . 
               '</div>';
            })->addColumn('action', function($laporan){
                if ($laporan->expired_at->day - Carbon::now()->day >= 0 ){
                        if ($laporan->status_laporan=='baru' ){
                            return '<div align="right" >'.
                            '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                           '<a onclick="editLaporan('.$laporan->id .')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                           '<a onclick="deleteLaporan('.$laporan->id .')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                           '</div>';
                       }else if ($laporan->status_laporan=='perbaikan'){
                            return '<div align="right" >'.
                            '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                           '<a onclick="editLaporan('.$laporan->id .')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                           '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                           '</div>';
                        }else if ($laporan->status_laporan=='proses' || $laporan->status_laporan=='disetujui'){
                            return '<div align="right" >'.
                            '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                           '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                           '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                           '</div>';
                       }
                }else {
                     return '<div align="right" >'.
                        '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';    
                }


            })->addColumn('kirim', function($laporan){
                if ($laporan->expired_at->day - Carbon::now()->day >= 0 ){
                        if ($laporan->status_laporan=='baru' || $laporan->status_laporan=='perbaikan'){
                            return '<div align="center" >'.
                            '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-default btn-sm" style="background-color:#6C85EF;color:white;width:100%" data-toggle="tooltip" data-placement="top" title="kirim laporan">--<i class="glyphicon glyphicon-send "></i>--</a> ' .      
                           '</div>';
                       }else if ($laporan->status_laporan=='proses' || $laporan->status_laporan=='disetujui'){
                          return '<div align="center" >'.
                            '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" style="width:100%"  data-placement="top" title="kirim laporan">--<i class="glyphicon glyphicon-send"></i>--</a> ' .                      
                           '</div>';
                        }
                }else {
                 return '<div align="center" >'.
                    '<a href="#" style="width:100%" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="kirim laporan">--<i class="glyphicon glyphicon-send"></i>--</a> ' .                      
                   '</div>';
                }
               })
            ->rawColumns(['nomor', 'action','created','expired','acc_laporan','kirim'])->make(true);
    }
}


