@extends('layout_admin')

@section('topic','Aplikasi')
@section('short_desc','Catata Rapat')
@section('long_desc','Semua catatan rapat yang terdaftar dalam sistem')


@section('css')
<link rel="stylesheet" href="/datatable/dataTables.bootstrap4.css">
@endsection

@section('content')
<div class="col-12 p-0 p-2 border">
    <table class="table table-bordered table-sm mt-2 table-responsive-lg" id="meeting-table" style="width:100%">
        <thead class="thead-dark">
            <tr class="text-center">
                <th style="width:30%;">Topic</th>
                <th style="width:20%;">Notulen</th>
                <th style="width:20%;">Tanggal Rapat</th>
                <th style="width:15%;">Waktu</th>
                <th style="width:15%;">Ruangan</th>
                <th style="width:0%;">Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Topic</th>
                <th>Notulen</th>
                <th>Tanggal Rapat</th>
                <th>Waktu</th>
                <th>Ruangan</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready( function () {

        $('#web-title').text('Pilkom - meeting');

        // XCRF TOKEN for Validation
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // inisialisasi datatable
        var table = $('#meeting-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('app_meeting.index') }}", // Alamat json
                type: 'GET', // tipe input
            },
            dom:"lt<'col-12'<'row d-flex justify-content-between'<'tambah my-auto'><'small'i><'pagination pagination-sm'p>>>",
            columns: [ // load data
                { data: 'topic', name: 'topic'},
                { data: 'notulen.name', name: 'notulen.name' },
                { data: 'meeting_date', name: 'meeting_date' },
                { data: 'time', name: 'time' }, 
                { data: 'rooms.name', name: 'rooms.name' },
                {data: 'action', name: 'action', orderable: false,searchable:false},
            ],
            order: [[2, 'DESC']], // sorting
            rowCallback: function( row, data ) {
                $('td:eq(2)', row).html("<div class='text-center'>"+data.meeting_date+"</div>");
                $('td:eq(3)', row).html("<div class='text-center'>"+data.time+"</div>");
                $('td:eq(4)', row).html("<div class='text-center'>"+data.rooms.name+"</div>");
            }
        });

        // button tambah 
        $("div.tambah").html('<a href="/app_meeting/create" role="button" id="tambah-meeting" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus fa-sm mr-2"></i>Tambah meeting</a>');
        
        header_search_box('#meeting-table',table);

        // DELETE GOL 
        $('body').on('click', '#delete-meeting', function () {
            var meeting_id = $(this).data("id");
            var conf = confirm("Apakah anda yakin ingin menghapus data ini ?");
            if(conf){
                $.ajax({
                type: "get",
                url: "app_meeting/destroy/"+meeting_id,
                success: function (data) {
                var oTable = $('#meeting-table').dataTable(); 
                oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            }
        });   
    });
</script>
@endsection