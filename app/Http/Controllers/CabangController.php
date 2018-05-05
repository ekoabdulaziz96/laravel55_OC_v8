<?php

namespace App\Http\Controllers;

use App\Cabang;
use Illuminate\Http\Request;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
// use App\Form;
// use App\Pilihan;
// use App\SetTextArea;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cabang');
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
        if(Cabang::where('nama',$request->nama)->exists() ){
           return response()->json([
                'success' => true,
                'message' => 'maaf, nama cabang "'.$request->nama.'" sudah ada. Silahkan input dengan nama berbeda',
                'title'=> 'Gagal Menambahkan!',
                'type'=> 'warning',
                'timer'=> 5000
            ]);
        }else  {
            $input = $request->all();
            $input['slug'] = str_slug($request->nama, '-');
            Cabang::create($input);

            return response()->json([
                'success' => true,
                'message' => 'Data Cabang baru berhasil ditambahkan',
                'title'=> 'Sukses Menambahkan!',
                'type'=> 'success',
                'timer'=> 2500
            ]);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function show(Cabang $cabang)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function edit(Cabang $cabang)
    {
        $cabang = Cabang::findOrFail($cabang->id);
       // console.log($cabang);
        return $cabang;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cabang $cabang)
    {
         if(Cabang::where('nama',$request->nama)->where('id','<>',$cabang->id)->exists()){
           return response()->json([
                'success' => true,
                'message' => 'maaf, nama cabang "'.$request->nama.'" sudah ada. Silahkan input dengan nama berbeda',
                'title'=> 'Gagal Menambahkan!',
                'type'=> 'warning',
                'timer'=> 5000
            ]);
        }else {
            $input = $request->all();
            $input['slug'] = str_slug($request->nama, '-');
            $cabang = Cabang::findOrFail($cabang->id);
            $cabang->update($input);


            return response()->json([
                'success' => true,
                'message' => 'Data Cabang berhasil diperbarui',
                'title'=> 'Sukses Memperbarui!',
                'type'=> 'success',
                'timer'=> 2500
            ]);    
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cabang  $cabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cabang $cabang)
    {
         Cabang::destroy($cabang->id);

        return response()->json([
            'success' => true,
            'message' => 'Data Cabang berhasil dihapus',
            'title'=> 'Sukses Menghapus!',
            'type'=> 'success',
            'timer'=> 2500
        ]);
    }

     public function apiCabang()
    {

        $cabang = Cabang::all();

        return Datatables::of($cabang)
            ->addColumn('nomor', function(){
                    global $nomor;
                    return ++$nomor;
            }) 
           ->addColumn('action', function($cabang){
            
            return '<div align="center" >' .
               '<a onclick="editCabang('. $cabang->id .')" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> ' .
               '<a onclick="deleteCabang('. $cabang->id .')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a>'.
               '</div>';
                   

            })
            ->rawColumns(['nomor', 'action'])->make(true);
    }
}
