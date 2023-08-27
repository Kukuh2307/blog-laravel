<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard- Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('blog') }}/assets/write.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('admin') }}/css/styles.css" rel="stylesheet" />
        {{-- cdn font awesome --}}
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            {{-- sidebar --}}
            @include('dashboard.layout.sidebar')
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                @include('dashboard.layout.navbar')
                <!-- Page content-->
                @yield('content')
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('admin') }}/js/scripts.js"></script>
    </body>
</html>
