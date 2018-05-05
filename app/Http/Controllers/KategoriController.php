<?php

namespace App\Http\Controllers;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Kategori;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori');
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
        $input = $request->all();

        Kategori::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Baru berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return $kategori;
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
        $input = $request->all();
        $kategori = Kategori::findOrFail($id);

        if ($kategori->update($input)){
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil di Update'
        ]);
        }else{
            return response()->json([
                'error' => true,
                 'message' => 'error Kategori berhasil di Update'
            ]); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $kategori = Kategori::findOrFail($id);

        Kategori::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil di hapus'
        ]);
    }

    public function apiKategori()
    {
        $kategori = Kategori::all();
        $nomor = 2;
        return Datatables::of($kategori)
            ->addColumn('nomor', function(){
                    global $nomor;
                    return ++$nomor;
            })
            ->addColumn('action', function($kategori){
                return '<div align="right">'.'<a onclick="showForm('. $kategori->id .')" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a onclick="editForm('. $kategori->id .')" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a onclick="deleteForm('. $kategori->id .')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';
            })
            ->rawColumns(['nomor', 'action'])->make(true);
    }
}
