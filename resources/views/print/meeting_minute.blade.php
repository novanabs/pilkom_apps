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
        .border-ttd {
            position: relative;
            width: 100%;
            /* border: 3px solid blue; */
        }

        .ttd {
            position: absolute;
            top: 0;
            right: 0;
            width: 250px;
            /* border: 3px solid #73AD21; */
        }

        table,
        tr,
        td {
            border-collapse: collapse !important;
            /* border: 1px solid black; */
        }

        th,
        #logo {
            margin-left: 0px !important;
            padding-left: 0px !important;
            /* border: none; */
        }

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
    <table>
        <thead>
            <tr>
                <th style="width:0px;">
                    <div class="logo">
                        <img src={{url('/img/logo-ulm.png')}} height="90px" width="90px;" />
                    </div>
                </th>
                <th class="title" style="margin-left: 40px; !important">
                    Laporan Agenda Rapat<br>
                    Prodi Pendidikan Ilmu Komputer<br>
                    <span class="no-break">Fakultas Keguruan dan Ilmu Pendidikan</span> <br>
                    Universitas Lambung Mangkurat <br>
                </th>
                <th style="width:0px;">
                    <img style="visibility:hidden;" src={{url('/img/logo-ulm.png')}} height="90px" width="90px;" />
                </th>
            </tr>
        </thead>
    </table>
    <table id="table-content">
        <tbody>
            <tr>
                <td colspan="4" class="p-besar"></td>
            </tr>
            <tr>
                <td colspan="4" class="p-besar"></td>
            </tr>
            <tr>
                <td colspan="4" class="p-besar">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class="bold">Topik </td>
                <td> : {{$meeting->topic}}</td>
                <td class="bold">Tanggal</td>
                <td> : {{$meeting->day.', '.$meeting->short_date_indonesia}}</td>
            </tr>
            <tr>

                <td class="bold">Notulen</td>
                <td> : {{$meeting->notulen->name}}</td>
                <td class="bold">Jam</td>
                <td> : {{$meeting->time}}</td>
            </tr>
            <tr>
                <td class="bold">Ruangan</td>
                <td> : {{$meeting->rooms->name}}</td>
                <td class="bold"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4" class="p-besar">
                </td>
            </tr>
            <tr>
                <td colspan="4" class="p-besar">
                </td>
            </tr>
            <tr>
                <td class="bold"> Peserta</td>
                <td colspan="3">
                    @foreach ($meeting->participants as $item)

                    <ul style="margin:0; padding-left:12px;">
                        <li>{{$item->name}}</li>
                    </ul>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <hr>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="bold text-center">Catatan Rapat</div>
    <div>
        {!! $meeting->notes!!}
    </div>
    <div class="border-ttd">
        <div class="ttd">
            <div style="text-align:left;">
                Mengetahui,
                <br>
                Ketua Prodi
                <br>
                <br>
                <br>
                <br>
                <br>
                <u> {{$kaprodi->name}}</u>
                {{$kaprodi->nip}}
            </div>
        </div>
    </div>
</body>

</html>