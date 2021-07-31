<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\User;
use App\Room;
use Carbon\Carbon;
use App\Http\Requests\CreateMeetingRequest;
use DB,PDF,Log;

class MeetingController extends Controller
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
            $table = Meeting::query()->with(['notulen','rooms']); 
            
            return datatables()->of($table)
            ->addColumn('action', function($data){
                
                $button = '<div class="btn-group btn-group-sm btn-block" role="group">';
                $button .= '<a target="_blank" href="/app_meeting/'.$data->id.'" role="button" id="print-meeting"  data-id="'.$data->id.'" class="btn btn-warning btn-sm"><i class="fa fa-sm fa-fw fa-print mr-1"></i><small>Print</small></a>';
                if(\Auth::user()->job_title_id == "Operator" || \Auth::user()->name == $data->notulen->name){
                    $button .= '<a role="button" href="/app_meeting/'.$data->id.'/edit" id="edit-meeting" data-id="'.$data->id.'" class="btn btn-success btn-sm text-white"><small><i class="fa fa-sm fa-edit mr-2"></i>Edit</small></a>';
                    $button .= '<a role="button" id="delete-meeting"  data-id="'.$data->id.'" class="btn btn-danger btn-sm text-white"><i class="fa fa-sm fa-fw fa-times mr-1"></i><small>Del</small></a>';
                }
                $button .= '</div>';
                
                return $button;
            })
            ->editColumn('meeting_date', function($data){
                $date = new carbon($data->meeting_date);
                return $date->format('Y-m-d');
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('apps.meeting_minute.meeting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $rooms = Room::get();

        return view('apps.meeting_minute.new_meeting',compact(['users','rooms']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMeetingRequest $request)
    {
        // dd($request->all());
        Meeting::create($request->all());

        foreach($request->participant as $participant){
            $data_meeting = Meeting::where('meeting_date',$request->meeting_date)
            ->where('notulen_id',$request->notulen_id)->first();

            if($data_meeting){
                DB::table('meeting_user')->insert([
                    'user_id' => $participant,
                    'meeting_id' => $data_meeting->id,
                    'created_at' => now(),
                ]);
            }

        }

        Log::info('Tambah catatan rapat oleh - '.\Auth::user()->name);
        
        return redirect()->route('app_meeting.index')->with('success','Data rapat baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting = Meeting::with(['participants' => function ($query){
            return $query->orderByRaw("FIELD(job_title_id,'Kaprodi','Sekprodi','Dosen','Operator') ASC");
        },'notulen','rooms'])->find($id);
        $kaprodi = User::where('job_title_id','kaprodi')->first();

        Log::info('print catatan meeting id: '.$meeting->id.' oleh - '.\Auth::user()->name);

        $pdf = PDF::loadview('print.meeting_minute',['meeting'=>$meeting, 'kaprodi' => $kaprodi]);
        // $pdf->download('laporan-agenda-rapat-'.$meeting->short_date.'-pdf');
    	return $pdf->stream();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::orderBy('name')->get();
        $rooms = Room::get();
        $data_meeting = Meeting::with(['participants' => function($query){
            return $query->orderByRaw("FIELD(job_title_id,'Kaprodi','Sekprodi','Dosen','Operator') ASC");
        }])->find($id);
        $participants = [];
        foreach($data_meeting->participants as $item){
            array_push($participants, $item->nip);
        }
    
        return view('apps.meeting_minute.edit_meeting',compact(['users','rooms','data_meeting','participants']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMeetingRequest $request, $id)
    {

        $meeting = Meeting::where('id',$id)
        ->update([
            'topic' => $request->topic,
            'notulen_id' => $request->notulen_id,
            'meeting_date' => $request->meeting_date,
            'time' => $request->time,
            'room_id' => $request->room_id,
            'notes' => $request->notes
        ]);

        $meeting_participants = Meeting::with(['participants'])->find($id);

        foreach($meeting_participants->participants as $save_participant){
            DB::table('meeting_user')->where('user_id',$save_participant->nip)
            ->where('meeting_id',$meeting_participants->id)
            ->delete();
        }

        if($request->has('participant')){
            foreach($request->participant as $input_participant){
                DB::table('meeting_user')->insert([
                    'user_id' => $input_participant,
                    'meeting_id' =>  $meeting_participants->id
                ]);
            }
        }

        Log::info('Update catatan rapat oleh - '.\Auth::user()->name);
        
        return redirect()->route('app_meeting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meeting::where('id',$id)->delete();
        
        Log::info('Hapus catatan rapat oleh - '.\Auth::user()->name);
    }

    /** Additional funtion */

    /** Create arr time */
    public function create_timepicker(){
        $menit = ['00','15','30','45'];
        
        $arr_time = [];
        for ($i=5; $i < 23; $i++) { 
            for ($j=0; $j < count($menit); $j++) { 
               if( $i < 10){
                    array_push($arr_time,"0".$i.":".$menit[$j]);
               }else{
                    array_push($arr_time,$i.":".$menit[$j]);
               }
            }
        }

        return $arr_time;
    }
}