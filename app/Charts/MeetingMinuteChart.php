<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Meeting;
use DB;

class MeetingMinuteChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $meeting_data = Meeting::selectRaw("
            (DATE_FORMAT(meeting_date, '%M %Y')) as month_year,
            COUNT('month_year') as jumlah
            ")
            ->groupByRaw("month_year,(DATE_FORMAT(meeting_date, '%m')),(DATE_FORMAT(meeting_date, '%Y'))")
            ->orderByRaw("(DATE_FORMAT(meeting_date, '%Y')) desc, (DATE_FORMAT(meeting_date, '%m')) desc")
            ->take(5)
            ->get()->toArray();

        $meeting_data = array_reverse($meeting_data);
        $labels = [];
        $jumlah = [];

        foreach($meeting_data as $data){
            array_push($labels, $data["month_year"]);
            array_push($jumlah, $data["jumlah"]);
        }

        // dd($meeting_data,$labels,$samples);

        return Chartisan::build()
            ->labels($labels)
            ->dataset('Jumlah Rapat', $jumlah);
            
    }
}