<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KRSconsultation;
use App\Consultation_note;
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
        $month = intval(date('m'));
        $year = intval(date('Y'));
        $academic_year = "";
        $semester = "";

        if($month >=7 && $month <=8){
            $academic_year = $year."/".($year+1);
            $semester = "Ganjil";
        }else if($month >=1 && $month <=2){
            $academic_year = ($year-1)."/".$year;
            $semester = "Genap";
        }else if($month >=5 && $month <=6){
            $academic_year = ($year-1)."/".$year;
            $semester = "Pendek";
        }

        if(request()->ajax())
        {
            $table = DB::table('krs_consultations')
            ->selectRaw("
                krs_consultations.id,
                krs_consultations.student_id,
                students.name as nama,
                students.nim as nim,
                students.email,
                IFNULL(consultation_notes.status,'BELUM DISETUJUI') as status_pa,
                IF(IF(krs_consultations.khs ='',0,1)+
                IF(krs_consultations.transkrip ='',0,1)+
                IF(krs_consultations.krs_sementara ='',0,1)+
                IF(krs_consultations.slip_ukt ='',0,1) = 4, 'LENGKAP', 'BELUM LENGKAP')
                 as status_pengajuan,
                consultation_notes.comment as comment,
                krs_consultations.khs,
                krs_consultations.krs_sementara,
                krs_consultations.transkrip,
                krs_consultations.slip_ukt,
                krs_consultations.created_at as created_at
            ")
            ->join('academic_datas', function($join) use($academic_year,$semester){
                $join->on('krs_consultations.academic_id', '=', 'academic_datas.id')
                    ->where('academic_year', $academic_year)->where('semester',$semester);
            })
            ->leftJoin('students', 'krs_consultations.student_id', '=', 'students.nim')
            ->leftJoin('consultation_notes', 'krs_consultations.id', '=', 'consultation_notes.krs_consultation_id')
            ->where('user_id',\Auth::user()->nip)->get();
            
            return datatables()->of($table)
            ->addColumn('action', function($query){
                $button = '<button  data-toggle="tooltip" data-original-title="Show" data-id="'.$query->id.'" class="check_konsultasi btn btn-info btn-sm"><small>Check</small></button>';
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
        $find =  Consultation_note::where('krs_consultation_id',$request->id)->first();
        
        if($find ){
            Consultation_note::where('krs_consultation_id',$request->id)->update([
                    'comment' => $request->comment,
                    'status' => $request->approval,
                ]);
        }else{
            Consultation_note::create([
                'krs_consultation_id'=> $request->id,
                'comment' => $request->comment,
                'status' => $request->approval,
            ]);
        }

        return response()->json($find, 200);
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
            $student = KRSconsultation::with(['students','consultation_notes'])->where('id',$id)->first();

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

    public function generate(){

        // return view('apps.krs_consultation.generate_consultation_data');
    }
}