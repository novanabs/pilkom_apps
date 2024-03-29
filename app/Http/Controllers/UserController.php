<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Job_title;
use App\Http\Requests\UserRequest;
use Hash,Log;


class UserController extends Controller
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
            $table = User::query()->with(['job_titles']);
            
            return datatables()->of($table)
            ->addColumn('action', function($data){
                
                $button ="";
               
                if(\Auth::user()->name == $data->name & \Auth::user()->job_title_id != "Operator"){ // hanya bisa mengedit dirinya sendiri
                    $button = '<button id="edit-user" data-id="'.$data->nip.'" class="btn btn-block btn-success btn-sm"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></button>';
                }else if(\Auth::user()->name != $data->name && \Auth::user()->job_title_id == "Operator"){
                    $button = '<button disabled class="btn btn-block btn-secondary btn-sm"><small><i class="fa fa-sm fa-hand-paper mr-2"></i>Read Only</small></button>';
                }
                
                if(\Auth::user()->job_title_id == "Operator"){
                    $button = '<div class="btn-group btn-group-sm" role="group">';
                    $button .= '<button id="edit-user" data-id="'.$data->nip.'" class="btn btn-success btn-sm"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></button>';
                    $button .= '<button id="delete-user"  data-id="'.$data->nip.'" class="btn btn-danger btn-sm"><i class="fa fa-sm fa-fw fa-info mr-1"></i><small>Del</small></button>';           
                    $button .= '</div>';
                }

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $job_titles = Job_title::all();
        
        return view('master.user',compact(['job_titles']));
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
    public function store(UserRequest $request)
    {
        // create baru
        if($request->action == 'add'){

            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->phonenumber = $request->phonenumber;
            
            if(\Auth::user()->job_title_id != "Operator"){
                $user->job_title_id = "Dosen";
            }else{
                $user->job_title_id = $request->job_title_id;
            }

            $user->nip = $request->nip;
            $user->nid = $request->nid;

            $user->created_at = now();
            $user->save();

            Log::info('Tambah user baru oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Tambah user berhasil!'], 200);

        }else{ // update

            $user =  User::find($request->nip);

            $user->name = $request->name;
            $user->address = $request->address;
            $user->phonenumber = $request->phonenumber;
            
            if(\Auth::user()->group_id == "Operator"){
                $user->job_title_id = $request->job_title_id;
            }
            $user->nip = $request->nip;
            $user->nid = $request->nid;
            $user->updated_at = now();
 
            if($request->password != ""){
                $user->password = Hash::make($request->password);
            }

            if($request->email != $user->email){
                $user->email = $request->email;
            }

            $user->save();

            Log::info('Update user oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Update user berhasil!'], 200);
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
        $user = User::find($id);

        return response()->json($user, 200);
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
        User::find($id)->delete();

        Log::info('Hapus user oleh - '.\Auth::user()->name);
    }
}