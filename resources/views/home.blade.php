@extends('layout_admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

<style>
    .box-height {
        height: 80px;
    }

    table.dataTable td.focus {
        outline: none;
    }

    table.dataTable tbody td.focus {
        box-shadow: none;
    }

    #table_cabang tbody tr.selected {
        color: black;
        background-color: #eeeeee;
    }
</style>
@endsection


@section('content')
<div id="dashboard">
    <div class="row">
        {{-- SPACE 1 --}}
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 ">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top test">
                    <p class="mb-0 py-1 small text-light">Space 1</p>
                </div>
                <div
                    class="col-12 bg-body-column box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <p class="mt-2 h3">1</p>
                </div>
            </div>
        </div>
        {{-- SPACE 2 --}}
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top">
                    <p class="mb-0 py-1 small text-light">Space 2</p>
                </div>
                <div
                    class="col-12 bg-body-column box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <p class=" mt-2 h3">2</p>
                </div>
            </div>
        </div>
        {{-- SPACE 3 --}}
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 ">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top test">
                    <p class="mb-0 py-1 small text-light">Space 3</p>
                </div>
                <div
                    class="col-12 bg-body-column box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <p class="mt-2 h3">3</p>
                </div>
            </div>
        </div>
        {{-- SPACE 4 --}}
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top">
                    <p class="mb-0 py-1 small text-light">Space 4</p>
                </div>
                <div
                    class="col-12 bg-body-column box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <p class=" mt-2 h3">4</p>
                </div>
            </div>
        </div>
        {{-- SPACE 5 --}}
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 ">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top test">
                    <p class="mb-0 py-1 small text-light">Space 5</p>
                </div>
                <div
                    class="col-12 bg-body-column box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <p class="mt-2 h3">5</p>
                </div>
            </div>
        </div>
        {{-- SPACE 6 --}}
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
            <div class="row px-1 pt-1">
                <div class="col-12 text-center bg-dark rounded-top">
                    <p class="mb-0 py-1 small text-light">Space 6</p>
                </div>
                <div
                    class="col-12 bg-body-column box-height d-flex align-items-center justify-content-center rounded-bottom">
                    <p class=" mt-2 h3">6</p>
                </div>
            </div>
        </div>

        {{-- GAMBAR CHART  --}}
        <div class="col-12 mt-2">
            <div class="row p-1" style="height: 500px;">
                <div class="col-12 bg-dark py-1 rounded-top">
                    <p class="text-light mb-0 small">Chart</p>
                </div>
                <div class="col-12 rounded-bottom bg-body-column bg-secondary h-100">
                    {{-- ISI CHART DISINI --}}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
{{-- CHART JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
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
@endsection