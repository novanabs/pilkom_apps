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
                
                $button = '<div class="btn-group btn-group-sm" role="group">';
                if(\Auth::user()->name == $data->name && \Auth::user()->group_id != "SUPER_ADMIN"){ // hanya bisa mengedit dirinya sendiri
                    $button .= '<button id="edit-user" data-id="'.$data->id.'" class="btn btn-success btn-sm"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></button>';
                }
                
                if(\Auth::user()->group_id == "SUPER_ADMIN"){
                    $button .= '<button id="edit-user" data-id="'.$data->id.'" class="btn btn-success btn-sm"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></button>';
                    $button .= '<button id="delete-user"  data-id="'.$data->id.'" class="btn btn-danger btn-sm"><i class="fa fa-sm fa-fw fa-info mr-1"></i><small>Del</small></button>';           
                }

                $button .= '</div>';
                
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $groups = Group::all();
        $job_titles = Job_title::all();
        
        return view('master.user',compact(['groups','job_titles']));
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
            
            if(\Auth::user()->group_id != "SUPER_ADMIN"){
                $user->group_id = "ADMIN";
                $user->job_title_id = "Dosen";
            }else{
                $user->group_id = $request->group_id;
                $user->job_title_id = $request->job_title_id;
            }

            $user->NIP_NIK = $request->NIP_NIK;
            $user->NIDN = $request->NIDN;

            $user->created_at = now();
            $user->save();

            Log::info('Tambah user baru oleh - '.\Auth::user()->name);

            return response()->json(['success' => 'Tambah user berhasil!'], 200);

        }else{ // update

            $user =  User::find($request->id);

            $user->name = $request->name;
            $user->address = $request->address;
            $user->phonenumber = $request->phonenumber;
            
            if(\Auth::user()->group_id == "SUPER_ADMIN"){
                $user->group_id = $request->group_id;
                $user->job_title_id = $request->job_title_id;
            }
            $user->NIP_NIK = $request->NIP_NIK;
            $user->NIDN = $request->NIDN;
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