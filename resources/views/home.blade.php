@extends('layout_admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

<style>
    table,
    tr,
    td {
        border: none;
    }

    table,
    tr,
    td,
    th {
        /* border: 1px solid black; */
        border-bottom: 1px solid black;
        padding: 1px 10px;
    }

    table {
        width: 100%;
    }

    hr {
        padding: 0px;
        margin: 0px;
    }
</style>
@endsection


@section('content')
<div id="dashboard">
    <div class="row">
        {{-- SPACE 1 --}}
        <div class="col-md-6 col-sm-12">
            <div class="row p-1 pt-1">
                <div class="col-12 px-0">
                    <table class="" cellpadding="2" cellspacing="0">
                        <thead class="bg-dark text-white font">
                            <tr>
                                <td>Nama</td>
                                <td class="text-center">Jmlh Kehadiran</td>
                                <td>Jmlh Notulen</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $orang)
                            <tr>
                                <td>{{ $orang->name }} </td>
                                <td class="text-center">{{ $orang->meetings()->count() }} </td>
                                <td class="text-center">{{ $orang->notulen()->count() }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- SPACE 2 --}}
        <div class="col-md-6 col-sm-12">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top">
                    <p class="mb-0 py-1 text-light">Topik Rapat Terbaru</p>
                </div>
                <div class="col-12  box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <div class="row">
                        @foreach ($meeting as $item)
                        <div class="col-12">
                            <span style="font-size: 12px;">
                                {{$item->shortDateIndonesia}}
                            </span>
                            <br>
                            <span><b>{{$item->topic}}</b></span>
                            <hr>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- GAMBAR CHART  --}}
        <div class="col-12">
            <div class="row p-1">
                <div class="col-12 bg-dark py-1 rounded-top">
                    <p class="text-light mb-0 small">Chart jumlah rapat berbulan dalam rentang 5 bulan terakhir</p>
                </div>
                <div class="col-12 rounded-bottom bg-body-column h-100 p-3">
                    <!-- Chart's container -->
                    <div id="chart" style="height: 300px; background-color:white;"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

    $('#web-title').text('Pilkom - Dashboard');

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  });
  
</script>
{{-- LARAVEL CHART  JS--}}
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->
<script>
    const chart = new Chartisan({
        el: '#chart',
        url: "@chart('meeting_minute_chart')",
        hooks: new ChartisanHooks()
        // .title('This is a sample chart using chartisan!')
        .legend({ position: 'bottom' })
        .colors(['#ECC94B'])
        .tooltip()
        .datasets([{ type: 'line', fill: false }, 'bar'])
        
        

        });
</script>
@endsection