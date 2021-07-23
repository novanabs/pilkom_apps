@extends('layout_admin')

@section('topic','Aplikasi')
@section('short_desc','Catatan Rapat Baru')
@section('long_desc','Penambahan catatan agenda rapat')


@section('css')
<link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.css')}}">
<script src="https://cdn.tiny.cloud/1/lavhoag7c4yey9n8q7sar7frvxe18sn8s3vs6l52kz7f95nc/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>

@endsection

@section('content')
@include('partial.flash-message')
<form id="app_meeting-form" action="{{route('app_meeting.store')}}" method="POST">
    @csrf
    <div class="col-12">
        <div class="row border p-2">
            <!--- Left Side-->
            <div class="col-lg-4 col-md-6">
                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Topik</label>
                    <div class="col-sm-7 pr-0">

                        <input type="text" class="form-control form-control-sm" id="topic" name="topic" required
                            autofocus value="{{ old('topic') }}">
                    </div>
                    <div class=" col-sm-2">
                        <a role="button" class="btn btn-dark btn-sm btn-block rounded-circle text-light" tabindex="0"
                            data-placement="top" data-toggle="popover" data-trigger="focus" title="Tips mengisi topik"
                            data-content="Beberapa topik dapat dimasukkan dengan dipisahkan tanda , (koma) seperti: MOU, RAB, UAS, DLL">
                            <i class=" fa fa-question"></i>
                        </a>
                    </div>
                </div>
                <div class=" mb-2 row">
                    <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Notulen</label>
                    <div class="col-sm-9">
                        <select id="notulen_id" name="notulen_id" class="form-control form-control-sm" required>
                            @foreach ($users as $notulen)
                            @if (old('notulen_id') == $notulen->id)
                            <option value="{{$notulen->id}}" selected>{{$notulen->name}}</option>
                            @else
                            <option value="{{$notulen->id}}">{{$notulen->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!--- Right Side-->
            <div class="col-lg-4 col-md-6">
                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm datepicker " name="meeting_date"
                            id="meeting_date" value="" required value="{{ old('meeting_date') }}" autocomplete="off">
                    </div>
                </div>
                <div class=" mb-2 row">
                    <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Jam</label>
                    <div class="col-sm-7 pr-0">
                        <input type="text" class="form-control form-control-sm" id="time" name="time" required autofocus
                            value="{{ old('time') }}">
                    </div>
                    <div class=" col-sm-2">
                        <a role="button" class="btn btn-dark btn-sm btn-block rounded-circle text-light" tabindex="0"
                            data-placement="top" data-toggle="popover" data-trigger="focus"
                            title="Tips mengisi waktu rapat" data-content="08.00 - 10.00 atau 08.00 - Selesai">
                            <i class=" fa fa-question"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class=" mb-2 row">
                    <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Ruangan</label>
                    <div class="col-sm-7">
                        <select id="room_id" name="room_id" class="form-control form-control-sm" required>
                            @foreach ($rooms as $room)
                            @if (old('room_id') == $room)
                            <option value="{{$room->id}}" selected>{{$room->name}}</option>
                            @else
                            <option value="{{$room->id}}">{{$room->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- TEXTAREA --}}
            <div class="col-12 px-0 div-table">
                <div class="col-12 border-bottom bg-dark p-1">
                    <span class="text-light">Catatan Rapat</span>
                </div>
                <textarea class="form-control form-control-sm description" name="notes" id="notes" rows="10">
                    {{old('notes')}}
                </textarea>
            </div>
            <div class="col-12 border-bottom border-left border-right px-0">
                <div class="border-bottom bg-dark p-1">
                    <span class="text-light">Peserta Rapat</span>
                </div>
                <div class="row m-2 px-2 participant">
                    @foreach ($users as $item)
                    <div class="col-4">
                        <input type="checkbox" name="participant[]" id="participant"
                            class="form-check-input participant" value="{{$item->id}}">
                        <label class="ml-2 form-check-label small2" for="participant">{{$item->name}}</label>
                    </div>
                    @endforeach
                </div>
                <div class="row px-2 mb-2">
                    <div class="col-4">
                        <button type="button" class="btn btn-primary btn-sm"
                            onclick="check_uncheck('participant',this.value)" value="Select all">Select All
                        </button>
                        <button type="button" class="btn btn-danger btn-sm"
                            onclick="check_uncheck('participant',this.value)" value="De-select all">De-Select
                            All </button>
                    </div>
                </div>
            </div>

            <div class="col-12 px-0 footer_pot mt-3">
                <div class=" d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-success btn-sm" id="end">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                    <span class="mr-2"></span>
                    <a role="button" class="btn btn-danger btn-sm" href="{{route('app_meeting.index')}}">
                        <i class="fa fa-angle-left"></i>
                        Batal
                    </a>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')
{{-- BOOTSTRAP DATEPICKER CSS AND JS--}}
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        tinymce.init({
            selector:'textarea.description',
            height: 300,
            // menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });

        $('[data-toggle="popover"]').popover();

        // TITLE TAB BAR
        $('#web-title').text('Pilkom - Meeting Minute Baru'); 

        // XCRF TOKEN FOR VALIDATION
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // DATEPICKER
        $(".datepicker").datepicker({
            todayHighlight: true,
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
    // check and uncheck checkbutton
    function check_uncheck(parameter, value) { 
        if (value == 'Select all') {
            $('.'+parameter+' input').prop('checked', true);
        } else {
            $('.'+parameter+' input').prop('checked', false);
        }
    } 
</script>
@endsection