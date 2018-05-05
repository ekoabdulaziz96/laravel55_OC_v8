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
        $forms = Form::where('status',$user->status)->where('view','show')->orderBy('urutan', 'asc')->orderBy('id', 'asc')->get();
        $status_laporan = 'baru';
        return view('ft-admin.laporan',compact(['user','status_laporan','forms']));
    }        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanProses()
    {
        $user = User::findOrFail(2);
        $status_laporan = 'proses';
        return view('ft-admin.laporan',compact(['user','status_laporan']));
    }        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanPerbaikan()
    {
        $user = User::findOrFail(2);
        $status_laporan = 'perbaikan';
        return view('ft-admin.laporan',compact(['user','status_laporan']));
    }        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporanDisetujui()
    {
        $user = User::findOrFail(2);
        $status_laporan = 'disetujui';
        return view('ft-admin.laporan',compact(['user','status_laporan']));
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
      
            
            $input = $request->except(['id','id_user','hour','minute']);  
            $input['expired_at'] = Carbon::now()->addDays(7);  
            $input['status_laporan'] = "baru";

            // if ($request->hasFile('foto')){
            //     $input['foto'] = '/upload/foto/'.str_slug($input['nama'], '-').'.'.$request->foto->getClientOriginalExtension();
            //     $request->foto->move(public_path('/upload/foto/'), $input['foto']);
            // }
            
            $user = User::findOrFail($request->id_user);
            $user->ftAdmin()->create($input);
            // event (new UserActivationEmail($user));

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
            $input = $request->except(['id_user','id']); 
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
        FtAdmin::destroy($id);


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
                    return $laporan->expired_at->diffInDays($laporan->created_at);
            })->addColumn('acc_laporan', function($laporan){
                    if($laporan->acc_kacab == 'ya') {$btn_kacab = '#76FD7C';}else {$btn_kacab = '#F45454';}
                    if($laporan->acc_manager == 'ya') {$btn_manager = '#76FD7C';}else {$btn_manager = '#F45454';}
                    if($laporan->acc_direktur == 'ya') {$btn_direktur = '#76FD7C';}else {$btn_direktur = '#F45454';}
                    return '<div align="center" >' .
               '<a onclick="viewAccLaporanKacab('.$laporan->id .')" style="background-color: '.$btn_kacab.'"  class="btn btn-default btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Acc Laporan Kepala Cabang"><i class="fa fa-user-o " style="color:white"></i></a> ' .               
               '<a onclick="viewAccLaporanManager('.$laporan->id .')" style="background-color: '.$btn_manager.'"  class="btn btn-default btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Acc Laporan Manager"><i class="fa fa-user " style="color:white"></i></a> ' .                
               '<a onclick="viewAccLaporanDirektur('.$laporan->id .')" style="background-color: '.$btn_direktur.'"  class="btn btn-default btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Acc Laporan Direktori"><i class="fa fa-user-circle-o " style="color:white"></i></a> ' . 
               '</div>';
            })->addColumn('action', function($laporan){
                if ($laporan->status_laporan=='baru' || $laporan->status_laporan=='perbaikan'){
                        return '<div align="right" >'.
                        '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a onclick="editLaporan('.$laporan->id .')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a onclick="deleteLaporan('.$laporan->id .')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';
                   }else if ($laporan->status_laporan=='proses' || $laporan->status_laporan=='disetujui'){
                        return '<div align="right" >'.
                        '<a onclick="showLaporan('.$laporan->id .')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a onclick="" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a onclick="" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';
                   }

            })
            ->rawColumns(['nomor', 'action','created','expired','acc_laporan'])->make(true);
    }
}


