<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Carbon\Carbon;
use Log;

class RoomController extends Controller
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
            $table = Room::query();
            
            return datatables()->of($table)
            // ->addColumn('action', function($data){
                
            //     $button = '<div class="btn-group btn-group-sm" role="group">';
            //     $button .= '<button id="edit-room" data-id="'.$data->id.'" class="btn btn-success btn-sm"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></button>';
            //     if(\Auth::user()->group_id == "SUPER_ADMIN"){
            //         $button .= '<button id="delete-room"  data-id="'.$data->id.'" class="btn btn-danger btn-sm"><i class="fa fa-sm fa-fw fa-info mr-1"></i><small>Del</small></button>';
            //     }
            //     $button .= '</div>';
                
            //     return $button;
            // })
            ->editColumn('created_at', function($data){
                $date = new carbon($data->created_at);
                return $date->format('Y-m-d');
            })
            // ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('master.room');
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
            Room::insert([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => now(),
            ]);

            Log::info('Tambah ruangan oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Tambah Room berhasil!'], 200);

        }else{ // update

            $Room =  Room::find($request->id);

            $Room->name = $request->name;
            $Room->description = $request->description;
            $Room->updated_at = now();

            $Room->save();

            Log::info('Update ruangan oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Update Room berhasil!'], 200);
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
        $Room = Room::find($id);

        return response()->json($Room, 200);
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
        Room::find($id)->delete();

        Log::info('Hapus ruangan oleh - '.\Auth::user()->name);
    }
}