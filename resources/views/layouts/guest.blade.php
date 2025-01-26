<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Toko Kain">
    <meta name="author" content="CindyAPPS">

    <title>TokoKain.</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <!-- end common css -->

    @stack('style')
</head>

<body data-base-url="{{ url('/') }}">

    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div class="container-fluid" id="app">


        <div class="page-body-wrapper full-page-wrapper">
            @yield('content')
        </div>

    </div>




    <!-- base js -->
    {{-- <script src="{{ asset('assets/js/dashboard.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->
    <script>
        // Sweet Alert untuk sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: {!! json_encode(session('success')) !!}
            });
        @endif

        // Sweet Alert untuk gagal
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: {!! json_encode(session('error')) !!}
            });
        @endif
    </script>
    <!-- common js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>

</html>
