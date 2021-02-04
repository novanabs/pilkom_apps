<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Carbon\Carbon;
use Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $table = Group::query(); 
            
            return datatables()->of($table)
            ->addColumn('action', function($data){
                
                $button = '<div class="btn-group btn-group-sm" role="group">';
                if($data->id != "ADMIN" && $data->id != "SUPER_ADMIN"){
                    // $button .= '<button id="edit-group" data-id="'.$data->id.'" class="btn btn-success btn-sm"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></button>';
                    $button .= '<button id="delete-group"  data-id="'.$data->id.'" class="btn btn-danger btn-sm "><i class="fa fa-sm fa-fw fa-times mr-1"></i><small>Del</small></button>';
                }else{
                    $button .= '<button class="btn btn-danger btn-sm invisible"><i class="fa fa-sm fa-fw fa-times mr-1"></i><small>Del</small></button>';
                }
                $button .= '</div>';
                
                return $button;
            })
            ->editColumn('created_at', function($data){
                $date = new carbon($data->created_at);
                return $date->format('Y-m-d');
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('system.group');
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
        // create baru
        if($request->action == 'add'){
            Group::insert([
                'id' => $request->id,
                'created_by' => \Auth::user()->name,
                'created_at' => now(),
            ]);

            Log::info('Tambah hak akses oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Tambah hak akses berhasil!'], 200);

        }else{ // update

            $Group =  Group::find($request->id);

            $Group->id = $request->id;
            $Group->updated_at = now();
            $Group->save();

            Log::info('Update hak akses oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Update hak akses berhasil!'], 200);
        }
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
        $Group = Group::find($id);

        return response()->json($Group, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::find($id)->delete();

        Log::info('Hapus hak akses oleh - '.\Auth::user()->name);
    }
}