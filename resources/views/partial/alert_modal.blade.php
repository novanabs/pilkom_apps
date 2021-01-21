<div class="modal fade" id="{{$id}}" aria-hidden="true">
    <div class="modal-dialog modal modalM modal-dialog-centered">
        {{-- modal-content bg-danger text-light --}}
        <div class=" {{ $bg }}">
            <div class="modal-header">
                <div class="modal-title text-center col-12">
                    @isset($type)
                    @if ($type == 'success')
                    <i class="fa fa-check-circle fa-3x my-2 text-success"></i>
                    @elseif($type == 'error')
                    <i class="fa fa-times-circle fa-3x my-2 text-danger"></i>
                    @else
                    <i class="fa fa-info-circle fa-3x my-2 text-warning"></i>
                    @endif
                    <br>
                    @endisset
                    <strong class="h3">{{$title}}</strong>
                </div>
            </div>
            <div class=" modal-body text-center modal_text" id="message">
                @isset($text)
                {{$text}}
                @endisset
            </div>
        </div>
    </div>
</div>