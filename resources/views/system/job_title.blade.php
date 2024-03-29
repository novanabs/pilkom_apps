@extends('layout_admin')

@section('topic','Sistem')
@section('short_desc','Jenis pengguna')
@section('long_desc','Semua jenis pengguna yang terdaftar dalam sistem')


@section('css')
<link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
<div class="col-12 p-0 p-2 border">
    <table class="table table-bordered table-sm mt-2 table-responsive-lg" id="job_title-table" style="width:100%">
        <thead class="thead-dark">
            <tr class="text-center">
                <th style="width:33%;">Nama</th>
                {{-- <th style="width:33%;">Created by</th> --}}
                <th style="width:33%;">Created at</th>
            </tr>
        </thead>
    </table>
</div>

{{-- MODAL ADD/EDIT USER--}}
<div class=" modal fade" id="job_title-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <form id="job_title-form" name="job_title-modal" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit Jenis Pengguna</h5>
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
                            <label class="col-sm-4 col-form-label col-form-label-sm">
                                Nama</label>
                            <div class="col-sm-8">
                                {{-- HIDDEN INPUT for detect ADD or EDIT --}}
                                <input type="text" class="form-control form-control-sm d-none" id="action"
                                    name="action">
                                <input type="text" class="form-control form-control-sm" id="id" name="id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                            <i class="fa fa-ban fa-sm"></i>
                            <small>Batal</small>
                        </button>
                        <span class="ml-2"></span>
                        <button id="btn-save" type="submit" class="btn btn-success btn-sm" value="create">
                            <i class="fa fa-save fa-sm"></i>
                            <small>Simpan</small>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready( function () {

        $('#web-title').text('Pilkom - Hak Akses');

        // XCRF TOKEN for Validation
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // inisialisasi datatable
        var table = $('#job_title-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('system_job_title.index') }}", // Alamat json
                type: 'GET', // tipe input
            },
            dom:"lt<'col-12'<'row d-flex justify-content-between'<'tambah my-auto'><'small'i><'pagination pagination-sm'p>>>",
            columns: [ // load data
                { data: 'id', name: 'id' },
                // { data: 'created_by', name: 'created_by'},
                { data: 'created_at', name: 'created_at' },
            ]
        });

        // button tambah 
        // $("div.tambah").html('<button type="button" id="tambah-job_title" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm mr-2"></i>Tambah hak akses</button>');
    
        // ADD GOL MODAL
        $('#tambah-job_title').click(function () {
            $(".print-error-msg").css('display','none');
            $('#job_title-form').trigger("reset");
            $('#modal-title').html("Tambahkan Hak Akses Baru");
            $('#job_title-modal').modal('show');
            $('#action').attr('value','add');
        });
        
        // fokus input

        $('#job_title-modal').on('shown.bs.modal',function(){
            $('#id').focus();
        });

        // EDIT GOL MODAL
        $('body').on('click', '#edit-job_title', function () {
            var id = $(this).data('id');
            $.get('system_job_title/'+id+'/edit', function (data) {
                //alert(JSON.stringify(data.management_cabangs[0].id));
                $(".print-error-msg").css('display','none');
                $('#job_title-form').trigger("reset");
                $('#modal-title').html("Edit Hak Akses");
                $('#id').val(data.id);
                $('#action').attr('value','edit');
                $('#job_title-modal').modal('show');
               
            })
        });

        // DELETE GOL 
        $('body').on('click', '#delete-job_title', function () {
            var id = $(this).data("id");
            var conf = confirm("Apakah anda yakin ingin menghapus data ini ?");
            if(conf){
                $.ajax({
                type: "get",
                url: "system_job_title/destroy/"+id,
                success: function (data) {
                var oTable = $('#job_title-table').dataTable(); 
                oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            }
        });   
    });
 
    // STORE GOL
    if ($("#job_title-form").length > 0) {
        $("#job_title-form").validate({
            submitHandler: function(form) {
            $.ajax({
                data: $('#job_title-form').serialize(),
                url: "{{ route('system_job_title.store') }}",
                type: "POST",
                success: function (data) {
                    // alert(JSON.stringify(data));
                    if(data.error){ // jika id sudah ada
                        printErrorMsg(data.error);
                    }else{ // store job_title baru
                        $('#alert').css('display','block');
                        $('div.flash-message').html(data.success);
                        $('#job_title-modal').trigger("reset");
                        $('#job_title-modal').modal('hide');
                        $('#btn-save');
                        var oTable = $('#job_title-table').dataTable();
                        oTable.fnDraw(false);
                    }
                },
                error: function (data) {
                    alert(JSON.stringify(data));
                    // printErrorMsg(data.responseJSON.errors);
                }
            });
            }
        })
    }

</script>
@endsection