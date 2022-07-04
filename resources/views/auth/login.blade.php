<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simprodi PILKOM</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/login-style.css">
    <style>
        .logo {
            width: 120px;
            height: 120px;
            border-radius: 5px;
            /* background-color: #20B2AA; */
            background-repeat: no-repeat;
            background-size: contain;
            background-image: url('img/logo-ulm.png');
        }

        ::-webkit-input-placeholder {
            text-align: left !important;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            text-align: left !important;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            text-align: left !important;
        }

        :-ms-input-placeholder {
            text-align: left !important;
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-4 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100 ">
                                <img src="/img/logo-ulm-baru.png" alt="" width="120px" height="120px" class="mb-2">
                                <h2>
                                    Selamat datang di <br> SIMPRODI
                                </h2>
                                <h5 class="text-white"><strong>Program Studi Pendidikan Komputer</strong> </h5>
                                <span>Fakultas Keguruan dan Ilmu Pendidikan
                                    <br>Universitas Lambung Mangkurat</span>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Masuk</h3>
                                </div>
                                {{-- <div class="w-100"> --}}
                                    {{-- <p class="social-media d-flex justify-content-end">
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                    </p> --}}
                                    {{-- </div> --}}
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf
                                @if($errors->any())
                                <strong class="text-danger">{{$errors->first()}}</strong>
                                @endif
                                {{-- EMAIL --}}
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Email</label>
                                    <input type="text" class="form-control" placeholder="email" name="email" id="email"
                                        value="{{ old('email') }}" autofocus required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{-- PASSWORD --}}
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control " placeholder="password" name="password"
                                        required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="form-control btn btn-primary submit px-3">Masuk</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        {{-- <a href="#">Sign up</a> --}}
                                        {{-- <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label> --}}
                                    </div>
                                    <div class="w-50 text-md-right">
                                        {{-- <a href="#">Sign Up</a> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> --}}

</body>

</html>