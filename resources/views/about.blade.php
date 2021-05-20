@extends('layout_admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

<style>
    table,
    tr,
    td {
        border: 1px solid black;
    }

    hr {
        padding: 6px;
        margin: 0px;
    }
</style>
@endsection


@section('content')
<div id="dashboard">
    <div class="row">
        <div class="col-12">
            <div class="p-1">
                <h4>Deskripsi Sistem</h4>
                <p> Web Aplikasi ini adalah cikal bakal dari sistem terintegrasi untuk
                    keseluruhan pengelolaan data di lingkungan <b>Program Studi Pendidikan Ilmu Komputer FKIP ULM</b>.
                    Penambahan fitur akan dilakukan secara bertahap sehingga dapat lebih banyak hal yang dikelola.
                    Adapun beberapa fitur yang mungkin akan ditambahkan antara lain:
                    <ol>
                        <li>Presensi Kehadiran Dosen di Prodi</li>
                        <li>Data Penelitian Dosen</li>
                        <li>Data Pengabdian Dosen</li>
                        <li>Borang Akreditasi ISK</li>
                        <li>Borang Akreditasi IAPT 4.0</li>
                        <li>Tracer Study Prodi</li>
                        <li>Daftar Kegiatan Prodi</li>
                        <li>Kerjasama Prodi</li>
                        <li>Sistem Informasi TA (Domain Terpisah)</li>
                    </ol>
                </p>

                <p> Developed By Novan Alkaf Bahraini Saputra, S.Kom., M.T. tahun 2021</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

    $('#web-title').text('Pilkom - About');

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  });

</script>
@endsection