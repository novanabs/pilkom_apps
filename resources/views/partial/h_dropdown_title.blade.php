<a class="nav-link collapsed" @isset($id) id="{{$id}}" @endisset data-toggle="collapse" data-target="{{ $data_target}}"
    aria-expanded="false" @isset($aria_controls) aria-controls="{{$aria_controls}}" @endisset>
    {{-- Jika pake icon --}}
    @if(isset($icon))
    <div class="pl-0 col-1">
        <div class="sb-nav-link-icon">
            <i class="fa fa-fw {{$icon}}" style="color:@isset($icon_color) {{$icon_color}}@endisset;"></i>
        </div>
    </div>
    <div class="col-10 text-color">
        {{$title}}
    </div>
    <div class="col-1 ">
        <div class="sb-sidenav-collapse-arrow">
            <i class="fa fa-angle-down arrow-color"></i>
        </div>
    </div>
    @else
    {{-- Jika tidak pake icon --}}
    <div class="text-color">
        {{$title}}
    </div>
    <div class="sb-sidenav-collapse-arrow">
        <i class="fa fa-angle-down arrow-color"></i>
    </div>

    @endif
</a>