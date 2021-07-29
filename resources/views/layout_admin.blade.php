<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="PILKOM app" />
    <meta name="author" content="novanabs@gmail.com" />
    <title id="web-title">Management Pilkom</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    {{-- MAIN CSS AND JS: BOOTSTRAP, FONTAWESOME, STYLE.CSS dan SIBUHAR.CSS --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- BOOTSTRAP CSS --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- Style CSS: ADMIN --}}
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    {{-- css/styles.css --}}
    {{-- SIBUHAR ADDITIONAL CSS --}}
    <link href="{{asset('css/sibuhar.css')}}" rel="stylesheet" />
    {{-- FONT AWESOME JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous">
    </script>
    {{-- DATATABLE BOOTSTRAP 4 CSS --}}
    <link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.css')}}">
    {{-- DATATABLE CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    {{-- ADDITIONAL CSS CUSTOM --}}
    <style>
        a {
            cursor: pointer;
        }

        .close:active,
        .close:focus {
            outline: none;
        }

        hr.garis {
            border: 1.5px solid darkslategrey;
        }

        .nav-link.text-color.active {
            font-weight: 600;
            color: #292828 !important;
            background-color: #f4f0f0;
            border-radius: 10px 0px 0px 10px;
        }

        .text-color:hover {
            color: black !important;
        }

        table.dataTable td.focus {
            outline: none;
        }

        table.dataTable tbody td.focus {
            box-shadow: none;
        }
    </style>
    @yield('css')
</head>

<body class="sb-nav-fixed">

    {{-- CLASS TAMBAHAN ASAL : navbar-dark bg-dark --}}
    <div class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="#######">SIM Prodi Pilkom</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fa fa-bars"></i></button><!-- Navbar Search-->

        <!-- Navbar-->
        <div class="navbar-nav form-inline ml-auto mr-0 my-2 my-md-0">
            <div class="row">
                {{-- CHANGE PASSWORD --}}
                <div class="pr-3">
                    <a role="button" id="ganti_password">
                        <i class="fa fa-fw fa-key icon-nav-color"></i>
                    </a>
                </div>
                {{-- LOGOUT --}}
                <div class="pr-3">
                    <a role="submit" href="{{route('logout')}}">
                        <i class="fa fa-fw fa-sign-out-alt icon-nav-color"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </div>
            </div>


            {{-- LAYOUT TEST --}}
            {{-- <li class="nav-item">
                <a class="nav-link d-block d-sm-none text-light"> XS </a>
                <a class="nav-link d-none d-sm-block d-md-none text-light">Small</a>
                <a class="nav-link d-none d-md-block d-lg-none text-light">Medium</a>
                <a class="nav-link d-none d-lg-block d-xl-none text-light">Large</a>
                <a class="nav-link d-none d-xl-block text-light">Xtra Large</a>
            </li> --}}
        </div>
    </div>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                {{-- CHANGE : add->shadow --}}
                <div class="sb-sidenav-menu shadow">
                    {{-- USER INFO --}}
                    <div class="nav">
                        <div class="nav-link">
                            <div class="col-12">
                                <div class="row">
                                    {{-- USER INFO --}}
                                    <div class="col-12 p-0 mb-2">
                                        <p class="m-0 info-color">Selamat datang:</p>
                                        {{-- NAMA USER --}}
                                        <span class="font-weight-bold info-color">{{\Auth::user()->short_name}}</span>
                                    </div>
                                    {{-- USER ID --}}
                                    {{-- <div class="col-6 p-0">
                                        <i class="fa fa-user fa-sm mr-2 fa-fw arrow-icon" style="color: #5a5aff"></i>
                                        <span class="small info-color">######</span>
                                    </div> --}}
                                    <div class="col-12 p-0">
                                        {{-- GROUP ID --}}
                                        <i class="fa fa-users fa-sm mr-2 fa-fw arrow-icon" style="color: #465442"></i>
                                        <span class="small info-color">{{\Auth::user()->job_title_id}}</span>
                                    </div>
                                    <div class="col-12 p-0">
                                        {{-- NAMA DAN ID CABANG --}}
                                        <i class="fa fa-envelope fa-sm mr-2 fa-fw arrow-icon"
                                            style="color: #088938"></i>
                                        <span id="set_cabang" class="small info-color">{{\Auth::user()->email}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- LINE --}}
                    <div class="offset-1 col-10 offset-1" style="border:1px black solid;">
                        {{-- <meta name="author" content="novanabs@gmail.com" /> --}}
                    </div>
                    {{-- MENU --}}
                    <div class="nav pt-2">
                        <div class="sb-sidenav-menu-heading pt-2 text-dark pb-0">
                            <div class="text-center h6 font-weight-bold info-color">
                                Menu
                            </div>
                        </div>
                        <div>
                            <a href="{{route('home')}}"
                                class="nav-link text-color {{ Route::is('home*') ? 'active' : ''}}">
                                <div class=" col-1 pl-0">
                                    <div class="sb-nav-link-icon">
                                        <i class="fas fa-chart-line arrow-icon" style="color:steelblue;"></i>
                                    </div>
                                </div>
                                <div class="col-11">
                                    Dashboard
                                </div>
                            </a>
                        </div>
                        {{-- DASHBOARD --}}

                        {{-- MASTER --}}
                        @include('partial.h_dropdown_title',[
                        'title' => 'Master',
                        'data_target'=>'#collapseMaster',
                        'aria_controls'=>'collapseMaster',
                        'icon' => 'fa-database',
                        'icon_color'=> '#e9c93b',
                        ])
                        <div class="{{ Route::is('master*') ? '' : 'collapse'}}" id="collapseMaster"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-color" href="{{route('master_user.index')}}">Pengguna</a>
                                <a class="nav-link text-color" href="{{route('master_room.index')}}">Ruangan</a>
                                {{-- <a class="nav-link text-color" href="######">OTHER LINK</a> --}}
                            </nav>
                        </div>

                        {{-- Aplikasi --}}
                        @include('partial.h_dropdown_title',[
                        'title' => 'Aplikasi',
                        'data_target'=>'#collapseApps',
                        'aria_controls'=>'collapseApps',
                        'icon' => 'fa-rocket',
                        'icon_color'=> '#be3d3d',
                        ])
                        <div class="{{ Route::is('app*') ? '' : 'collapse'}}" id="collapseApps"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-color {{ Route::is('*meeting*') ? 'active' : ''}}"
                                    href="{{route('app_meeting.index')}}">Catatan Rapat</a>
                                <a class="nav-link text-color {{ Route::is('*consultation*') ? 'active' : ''}}"
                                    href="{{route('app_krs_consultation.index')}}">Konsultasi KRS</a>
                                {{-- <a class="nav-link text-color" href="######">OTHER LINK</a> --}}
                            </nav>
                        </div>

                        {{-- SYSTEM --}}
                        @include('partial.h_dropdown_title',[
                        'title' => 'Sistem',
                        'data_target'=>'#collapseSystem',
                        'aria_controls'=>'collapseSystem',
                        'icon' => 'fa-cog',
                        'icon_color'=> '#719e63',
                        ])
                        <div class="{{ Route::is('system*') ? '' : 'collapse'}}" id="collapseSystem"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link text-color {{ Route::is('system*') ? 'active' : ''}}"
                                    href="{{route('system_group.index')}}">Hak Akses</a>
                            </nav>
                        </div>

                        {{-- INFO SOFTWARE --}}
                        <a href="{{route('about')}}" class="nav-link text-color">
                            <div class="col-1 pl-0">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-info arrow-icon" style="color:steelblue;"></i>
                                </div>
                            </div>
                            <div class="col-11">
                                Tentang
                            </div>
                        </a>
                    </div>
                </div>
                {{-- SIDEBAR BOTTOM COLUMN --}}
                {{-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> --}}
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main class="bg-content">
                @yield('content_full')
                <div class="container-fluid">
                    {{-- BASIC --}}
                    <h3 class="mt-2">
                        {{-- MENU --}}
                        @yield('topic')
                        {{-- SUB MENU --}}
                        <small class="text-muted">@yield('short_desc')</small>
                    </h3>
                    {{-- DESCRIPTION --}}
                    <p>@yield('long_desc')</p>
                    {{-- CONTENT --}}
                    @yield('content')
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;
                            Pilkom ULM 2021
                        </div>
                        {{-- COPYRIGHT --}}
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    {{-- MAIN SCRIPT INCLUDE JQUERY,POPPER AND BOOTSTRAP --}}
    {{-- SLIM JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    {{-- JQUERY --}}
    <script src="{{asset('datatable/jquery.js')}}"> </script>
    {{-- POPPPER JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    {{-- BOOTSRAP MIN JS--}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    {{-- DATATABLES JS --}}
    <script src="{{asset('datatable/jquery.dataTables.min.js')}}"></script>
    {{-- BOOTSTRAP 4 DATATABLE --}}
    <script src="{{asset('datatable/dataTables.bootstrap4.js')}}"></script>
    {{-- JS SIBUHAR --}}
    <script src="{{asset('js/scripts.js')}}"></script>
    {{-- Validate JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    {{-- TEMPAT JIKA ADA JS TAMBAHAN --}}
    @yield('js')
</body>
<script type="text/javascript">
    $(document).ready(function(){


    });
</script>

</html>