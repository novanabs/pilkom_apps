{{--==================================== SIBUHAR ==================================================--}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pilkom App</title>
    <link rel="stylesheet" href="{{asset('datatable/dataTables.bootstrap4.css')}}">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous">
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        section {
            width: 100%;
            min-height: 100%;
        }

        .wave {
            position: relative;
            /* background: linear-gradient(90deg, #F0F8FF, #6495ED) */
            background-image: linear-gradient(to left, #6bd1c8, #68d2cc, #65d4d0, #63d5d4, #60d6d8, #5cd6dd, #58d6e2, #55d6e7, #53d4ed, #54d2f2, #58cff7, #5fccfb);
        }

        .wave::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background-size: #000;
        }

        .font-color {
            color: #2F4F4F;
            /* font-size: 15px; */
        }

        .logo {
            width: 120px;
            height: 120px;
            border-radius: 5px;
            /* background-color: #20B2AA; */
            background-repeat: no-repeat;
            background-size: contain;
            background-image: url('img/logo-ulm.png');
        }
    </style>
</head>

<body class="wave">

    <div class="modal-dialog modal-sm modal-dialog-centered " style="margin-top: 0; margin-bottom:0;">
        <div class="modal-content"
            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="col-12 modal-header" style="background-color:#20B2AA;">
                <h5 class="h4 mx-auto my-0 font-weight-bold" style="color:white;">Login</h5>
            </div>
            <div class="col-12 modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="mb-3 d-flex align-items-center justify-content-center logo">

                        </div>
                    </div>
                    <div class="col-12 my-2 text-center">
                        @if ($message = Session::get('error'))
                        <span class="p text-danger" style="font-size:13px;">
                            {{ $message }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="col-sm-4 col-form-label py-0 pb-1 font-color">Email</label>
                        <div class="col-md-12">
                            <input id="email" class="form-control @error('error') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-4 col-form-label py-0 pb-1 font-color">Password</label>
                        <div class="col-md-12">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <button type="submit" class="btn btn-sm btn-block text-light" style="background-color:#5F9EA0;">
                            Masuk
                        </button>
                    </div>
                    <div class="col-12">
                        <span class="text-secondary" style="font-size:10px;">Copyright &copy; Pilkom ULM
                            2021</span>
                        {{-- COPYRIGHT --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>