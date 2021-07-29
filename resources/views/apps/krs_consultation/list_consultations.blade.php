@extends('layout_admin')

@section('topic','Konsultasi')
@section('short_desc','KRS')
@section('long_desc','halaman daftar mahasiwa yang mengajukan konsultasi KRS')


@section('css')
<link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.css')}}">
<style>
    table>tbody>tr>td {
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="col-12 p-0 p-2 border">
    <table class="table table-bordered table-sm mt-2 table-responsive-lg" id="list-consulation-PA-table"
        style="width:100%">
        <thead class="thead-dark">
            <tr class="text-center">
                {{-- <th style="width:0%;">No.</th> --}}
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Pengajuan</th>
                <th>Status Dokumen</th>
                <th>Status PA</th>
                <th style="width:0%;">Aksi</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                {{-- <th>No</th> --}}
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Pengajuan</th>
                <th>Status Dokumen</th>
                <th>Status PA</th>
            </tr>
        </tfoot>
    </table>
</div>
{{-- MODAL CHECK BIMBINGAN PA--}}
<div class="modal fade" id="check-file-PA-modal" tabindex="-1" role="dialog" aria-labelledby="check-file-PA-modal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Halaman Persetujuan PA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="mb-2 row">
                        {{-- ALERT ERROR --}}
                        <div class="col-12">
                            <div class="alert-danger print-error-msg rounded" style="display:none">
                                <ul class="m-0 py-2">
                                </ul>
                            </div>
                        </div>
                        {{-- ========== --}}
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-4 col-form-label col-form-label-sm">Nama</label>
                        <div class="col-sm-8 pl-0">
                            <input type="text" class="form-control form-control-sm" id="name" name="name" disabled>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-4 col-form-label col-form-label-sm">NIM</label>
                        <div class="col-sm-8 pl-0">
                            <input type="text" class="form-control form-control-sm" id="nim" name="nim" disabled>
                        </div>
                    </div>
                    <div class="mb-2 row pt-3">
                        <div class="col-6 mb-2">
                            <div class="row">
                                <label class="col-7 col-form-label col-form-label-sm">SLIP UKT</label>
                                <div class="col-5" id="">
                                    <button class="center btn btn-sm btn-primary btn-block">Check</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="row">
                                <label class="col-7 col-form-label col-form-label-sm">KHS</label>
                                <div class="col-5" id="">
                                    <button class="center btn btn-sm btn-primary btn-block">Check</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="row">
                                <label class="col-7 col-form-label col-form-label-sm">Transkrip</label>
                                <div class="col-5" id="">
                                    <button class="center btn btn-sm btn-primary btn-block">Check</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="row">
                                <label class="col-7 col-form-label col-form-label-sm">KRS Sementara</label>
                                <div class="col-5" id="">
                                    <button class="center btn btn-sm btn-primary btn-block">Check</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mb-2 row">
                        <div class="form-group col-12">
                            <label for="exampleFormControlTextarea1">Komentar</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Belum Disetujui</button>
                <button type="button" class="btn btn-primary">Disetujui</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {

    $('#web-title').text('Simprodi - Daftar konsultasi PA');  

    // XCRF TOKEN for Validation
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // inisialisasi datatable
    var table = $('#list-consulation-PA-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('app_krs_consultation.index') }}", // Alamat json
            type: 'GET', // tipe input
        },
        pagingType:'full_numbers',
        dom:"lt<'col-12'<'row d-flex justify-content-between'<'tambah my-auto'><'small'i><'pagination pagination-sm'p>>>",
        language: {
             lengthMenu: "_MENU_", // Edit tulisan pagelength
             paginate:{
                 previous:"<", // Edit tulisan pagination
                 next:">",
                 first:"<<",
                 last:">>",
             },
        },
        columns: [ // load data
            { data: 'nim', name: 'nim'},
            { data: 'nama', name: 'nama' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status_dokumen', name: 'status_dokumen'},
            { data: 'status_pa', name: 'status_pa'},
            {data: 'action', name: 'action', orderable: false,searchable:false},
        ],
        order: [[3, 'asc']], // sorting
    });
    

    header_search_box('#list-consulation-PA-table',table);
    // get id for add and remove 
    var x = document.getElementById("id");

    var ajax_type = '';
    var ajax_url = '';
    var id;
    

    // HISTORY JENIS_TABUNGAN MODAL
    $('body').on('click', '#check_konsultasi', function () {
        id = $(this).data('id');

        $.get('app_krs_consultation/'+id, function (data) {
            $('#check-file-PA-modal').modal('show');

            // alert(JSON.stringify(data));
            $('#name').val(data.students.name);
            $('#nim').val(data.students.nim);
        })
    });

});
</script>

@endsection