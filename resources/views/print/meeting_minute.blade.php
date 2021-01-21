<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- TITLE --}}
    <title>Print Agenda Rapat</title>

    {{-- STYLE LAPORAN --}}
    <link href="{{ public_path('css/laporan.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @page {
            margin-top: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 1.5cm;
            margin-left: 2cm;
        }

        .logos {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            background-color: #20B2AA;
            background-repeat: no-repeat;
            padding: 0% !important;
            margin: 0% !important;
            /* background-size: contain; */
            background-image: url('/img/logo-ulm.png');
        }
    </style>
</head>

<body>
    <table id="table-content">
        <thead style="border-bottom:">
            <tr>
                <th colspan="3">
                    <div class="logo">
                        <img src={{url('/img/logo-ulm.png')}} height="90px" width="90px;" />
                    </div>
                </th>
                <th colspan="6" class="title" style="margin-left: 40px; !important">
                    Laporan Agenda Rapat<br>
                    Prodi Pendidikan Ilmu Komputer<br>
                    <span class="no-break">Fakultas Keguruan dan Ilmu Pendidikan</span> <br>
                    Universitas Lambung Mangkurat <br>
                </th>
                <th style="visibility:hidden;" colspan="3">
                    <img src={{url('/img/logo-ulm.png')}} height="90px" width="90px;" />
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="12" class="p-besar"></td>
            </tr>
            <tr>
                <td colspan="12" class="p-besar"></td>
            </tr>
            <tr>
                <td colspan="12" class="p-besar">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="1" class="bold">Topik </td>
                <td colspan="5"> : {{$meeting->topic}}</td>
                <td colspan="1" class="bold">Tanggal</td>
                <td colspan="5"> : {{$meeting->day.', '.$meeting->short_date_indonesia}}</td>

            </tr>
            <tr>

                <td colspan="1" class="bold">Notulen</td>
                <td colspan="5" class=""> : {{$meeting->notulen->name}}</td>
                <td colspan="1" class="bold">Jam</td>
                <td colspan="5"> : {{$meeting->hour_time}}</td>
            </tr>
            <tr>
                <td colspan="1" class="bold">Ruangan</td>
                <td colspan="5"> : {{$meeting->rooms->name}}</td>
                <td colspan="1" class="bold">Durasi </td>
                <td colspan="5"> : {{$meeting->duration}} Menit</td>
            </tr>
            <tr>
                <td colspan="12" class="p-besar">
                </td>
            </tr>
            <tr>
                <td colspan="12" class="p-besar">
                </td>
            </tr>
            <tr>
                <td colspan="1" class="bold"> Peserta</td>
                <td colspan=11>
                    @foreach ($meeting->participants as $item)

                    <ul style="margin:0; padding-left:12px;">
                        <li>{{$item->name}}</li>
                    </ul>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <hr>
                </td>
            </tr>
            <tr>
                {{-- style="padding:20px !important;" --}}
                <td colspan="12">
                    <div class="bold">Catatan</div>
                    {!! $meeting->notes!!}
                </td>
            </tr>

        </tbody>
    </table>
</body>

</html>