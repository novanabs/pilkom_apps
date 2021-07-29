<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KRSconsultation;
use Auth,DB;
use Carbon\Carbon;

class KRSConsultationController extends Controller
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
            $table = DB::table('krs_consultations')
            ->selectRaw("
                krs_consultations.id,
                krs_consultations.student_id,
                students.name as nama,
                students.nim as nim,
                students.email,
                krs_consultations.status as status_dokumen,
                consultation_notes.status as status_pa,
                consultation_notes.comment,
                krs_consultations.khs,
                krs_consultations.krs_sementara,
                krs_consultations.transkrip,
                krs_consultations.slip_ukt,
                krs_consultations.created_at as created_at
            ")
            ->join('students', 'krs_consultations.student_id', '=', 'students.nim')
            ->join('consultation_notes', 'krs_consultations.id', '=', 'consultation_notes.krs_consultation_id')
            ->where('user_id',Auth::user()->id)->get();
            
            return datatables()->of($table)
            ->addColumn('action', function($query){
                $button = '<button id="check_konsultasi" data-toggle="tooltip" data-original-title="Show" data-id="'.$query->id.'" class="show btn btn-info btn-sm"><i class="fa fa-sm fa-fw fa-info mr-1"></i><small>Check</small></button>';
                return $button;
            })
            ->editColumn('created_at',function($query){
                return Carbon::parse($query->created_at)->format('Y-m-d'); 
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('apps.krs_consultation.list_consultations');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->ajax())
        {
            $student = KRSconsultation::with(['students','consultation_notes'])->where('user_id',$id)->first();

            return $student;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}