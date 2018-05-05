<?php

namespace App\Http\Controllers;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Status;
use App\Kategori;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.status');
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

        Status::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Status Baru berhasil ditambahkan'
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
       $status = Status::findOrFail($id);
       // console.log($status);
        return $status;

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
        $status = Status::findOrFail($id);

        if ($status->update($input)){
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil di Update'
        ]);
        }else{
            return null;
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
        Status::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'berhasil di hapus'
        ]);
    }

    public function apiStatus()
    {
        $status = Status::all();
        $nomor = 2;
        return Datatables::of($status)
            ->addColumn('nomor', function(){
                    global $nomor;
                    return ++$nomor;
            }) 
          
           ->addColumn('action', function($status){
                return '<div align="right">'.'<a onclick="showForm('. $status->id .')" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                       '<a onclick="editForm('. $status->id .')" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a> ' .
                       '<a onclick="deleteForm('. $status->id .')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>'.
                       '</div>';
            })
            ->rawColumns(['nomor','action'])->make(true);
    }
}
