@extends('layout_admin')

@section('topic','Master')
@section('short_desc','User')
@section('long_desc','Semua user yang terdaftar dalam sistem')


@section('css')
<link rel="stylesheet" href="/datatable/dataTables.bootstrap4.css">
@endsection

@section('content')
<div class="col-12 p-0 p-2 border">
    <table class="table table-bordered table-sm mt-2 table-responsive-lg" id="user-table" style="width:100%">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>Email</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th style="white-space: nowrap;">NIP/NIK</th>
                <th style="white-space: nowrap;">NIDN</th>
                {{-- <th style="">Alamat</th> --}}
                <th style="white-space: nowrap;">No. HP</th>
                <th style="">Hak Akses</th>
                <th style="width:0%;">Action</th>
            </tr>
        </thead>
    </table>
</div>

{{-- MODAL ADD/EDIT USER--}}
<div class=" modal fade" id="user-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <form id="user-form" name="user-modal" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Edit User</h5>
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
                                <input type="text" class="form-control form-control-sm d-none" id="id" name="id">
                                <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label col-form-label-sm">Email
                            </label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control form-control-sm" id="email" name="email"
                                    required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label col-form-label-sm">NIP/NIK
                            </label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control form-control-sm" id="NIP_NIK" name="NIP_NIK"
                                    required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label col-form-label-sm">NIDN
                            </label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control form-control-sm" id="NIDN" name="NIDN" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label col-form-label-sm">Jabatan</label>
                            <div class="col-sm-8 ">
                                <select name="job_title_id" id="job_title_id" class="form-control form-control-sm"
                                    @if(\Auth::user()->group_id == "SUPER_ADMIN") required @else disabled @endif>
                                    @foreach($job_titles as $item)
                                    <option value="{{$item->id}}">{{$item->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label col-form-label-sm">Password
                            </label>
                            <div class="col-sm-8 ">
                                <input type="password" class="form-control form-control-sm" id="password"
                                    name="password" placeholder="Ketik password..." required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-sm-4 col-form-label col-form-label-sm"> Hak Akses </label>
                            <div class="col-sm-8 ">
                                <select name="group_id" id="group_id" class="form-control form-control-sm"
                                    @if(\Auth::user()->group_id == "SUPER_ADMIN") required @else disabled @endif>
                                    @foreach($groups as $item)
                                    <option value="{{$item->id}}">{{$item->id}}</option>
                                    @endforeach
                                </select>
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

@include('partial.alert_modal',
['id' => 'alert_success','bg'=>'modal-content text-secondary','title'=>
'Berhasil', 'text'=> 'Anda berhasil mengganti password anda.', 'type'=> 'success'])

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready( function () {

        $('#web-title').text('Pilkom - User');

        // XCRF TOKEN for Validation
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // inisialisasi datatable
        var table = $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('master_user.index') }}", // Alamat json
                type: 'GET', // tipe input
            },
            dom:"t<'col-12'<'row d-flex justify-content-between'<'tambah my-auto'><'small'i><'pagination pagination-sm'p>>>",
            columns: [ // load data
            { data: 'email', name: 'email'},
                { data: 'name', name: 'name' },
                { data: 'job_titles.id', name: 'job_titles.id' },
                { data: 'NIP_NIK', name: 'NIP_NIK' },
                { data: 'NIDN', name: 'NIDN' },
                // { data: 'address', name: 'address' },
                { data: 'phonenumber', name: 'phonenumber' }, 
                { data: 'group_id', name: 'group_id' },
                {data: 'action', name: 'action', orderable: false,searchable:false},
            ]
        });

        // button tambah 
        $("div.tambah").html('<button type="button" id="tambah-user" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm mr-2"></i>Tambah User</button>');
        
        // get id for add and remove required
        var email = document.getElementById("email");
        var password = document.getElementById("password");
        
        // ADD GOL MODAL
        $('#tambah-user').click(function () {
            $(".print-error-msg").css('display','none');
            $('#user-form').trigger("reset");
            $('#modal-title').html("Tambahkan User Baru");
            $('#user-modal').modal('show');
            $('#action').attr('value','add');
            password.setAttribute('required',true);
        });
        
        // fokus input
        $('#user-modal').on('shown.bs.modal',function(){
            $('#name').focus();
        });

        // EDIT GOL MODAL
        $('body').on('click', '#edit-user', function () {
            var id = $(this).data('id');
            $.get('master_user/'+id+'/edit', function (data) {
                // alert(JSON.stringify(data));
                $(".print-error-msg").css('display','none');
                $('#user-form').trigger("reset");
                $('#modal-title').html("Edit User");
                $('#btn-save').val("edit-user");
                $('#email').val(data.email);
                $('#name').val(data.name);
                $('#id').val(data.id);
                $('#job_title').val(data.job_title);
                $('#NIP_NIK').val(data.NIP_NIK);
                $('#NIDN').val(data.NIDN);
                $('#address').val(data.address);
                $('#phonenumber').val(data.phonenumber);
                $('#group_id').val(data.group_id);
                $('#action').attr('value','edit');
                $('#user-modal').modal('show');
                password.removeAttribute('required',false);
            })
        });

        // DELETE GOL 
        $('body').on('click', '#delete-user', function () {
            var id = $(this).data("id");
            var conf = confirm("Apakah anda yakin ingin menghapus data ini ?");
            if(conf){
                $.ajax({
                type: "get",
                url: "master_user/destroy/"+id,
                success: function (data) {
                var oTable = $('#user-table').dataTable(); 
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
    if ($("#user-form").length > 0) {
        $("#user-form").validate({
            submitHandler: function(form) {
            $.ajax({
                data: $('#user-form').serialize(),
                url: "{{ route('master_user.store') }}",
                type: "POST",
                success: function (data) {
                    // alert(JSON.stringify(data));
                    if(data.error){ // jika nama sudah ada
                        printErrorMsg(data.error);
                    }else{ // store user baru
                        $('#user-form').trigger("reset");
                        $('#user-modal').modal('hide');
                        var oTable = $('#user-table').dataTable();
                        oTable.fnDraw(false);
                        $('#alert_success #message').html(data.success);
                        $('#alert_success').modal('show');
                        setInterval(function(){
                            $('#alert_success').modal('hide');
                        },1800);
                    }
                },
                error: function (data) {
                    // alert(JSON.stringify(data));
                    if(data.status == "422"){
                        printErrorMsg(data.responseJSON.errors);
                    }
                }
            });
            }
        })
    }

</script>
@endsection