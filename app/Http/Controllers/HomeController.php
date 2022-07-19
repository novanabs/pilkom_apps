<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Meeting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::with('notulen','meetings')
        ->whereIn('job_title_id',['Kaprodi','Sekprodi','Dosen','Operator'])
        ->orderBy('name')
        ->get();

        $meeting = Meeting::orderBy('meeting_date','DESC')->take(5)->get();

        return view('home', compact('user','meeting'));
    }
}