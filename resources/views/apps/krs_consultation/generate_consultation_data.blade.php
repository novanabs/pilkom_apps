{{-- 7,8 tahun 2021 => 2021/2022 ganjil
1,2 tahun 2022 => 2021/2022 genap
4,6 tahun 2022 => 2021/2022 pendek --}}
@extends('layout_admin')

@section('topic','Generate')
@section('short_desc','Konsultasi KRS')
@section('long_desc','halaman digunakan untuk men-generate data konsultasi PA')


@section('css')

@endsection

@section('content')
<form action="#" method="POST">
    @csrf
    <div class="col-md-6 col-sm-7">
        <div class="row border p-2">
            <!-------------   MAIN SIDE -------------->
            <div class="col-lg-12">
                <div class="mb-2 row">
                    <label class="col-4 col-form-label col-form-label-sm">Atur Tahun Akademik</label>
                    <div class="col-8">
                        <select name="academic_year" id="academic_year" class="form-control form-control-sm">
                            <option value="2021/2022" selected>2021/2022</option>
                            <option value="2022/2023">2022/2023</option>
                            <option value="2023/2024">2023/2024</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-4 col-form-label col-form-label-sm">Atur Semester</label>
                    <div class="col-8">
                        <select name="semester" id="semester" class="form-control form-control-sm">
                            <option value="Ganjil" selected>Ganjil</option>
                            <option value="Genap">Genap</option>
                            <option value="Pendek">Pendek</option>
                        </select>
                    </div>
                </div>
                <div class="mb-2 row">
                    <label class="col-sm-4 col-form-label col-form-label-sm">Nama File</label>
                    <div class="col-sm-8 ">
                        <div class="custom-file custom-file-sm">
                            <input type="file" class="custom-file-input form-control form-control-sm" id="file_name"
                                name="file_name">
                            <label class="custom-file-label custom-file-label-sm" for="file_name"><small>Choose
                                    file</small></label>
                        </div>
                    </div>
                </div>
                <span class="m-2"></span>
                <div class="col-12">
                    <div class="row">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-save mr-1 fa-sm"></i>
                            <small>Simpan</small>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')
<script>
    $(document).ready( function () {

    $('#web-title').text('Simprodi - Generate konsultasi PA');  

    // XCRF TOKEN for Validation
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>

@endsection