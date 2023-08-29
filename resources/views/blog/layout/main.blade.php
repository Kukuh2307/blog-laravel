<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name') }} - {{ $tittle }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('blog') }}/assets/write.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('blog') }}/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        @include('blog.layout.navbar')

        {{-- apabila request bukan dari / maka tidak akan di tampilkan(untuk menghandle tampilan halaman login) --}}
        @if (Request::is('/'))    
            @include('blog.layout.header')
        @endif
        
        <!-- Page content-->
        <div class="container">
            <div class="row">
                @yield('content')

                {{-- apabila request bukan dari / maka tidak akan di tampilkan(untuk menghandle tampilan halaman login) --}}
                @if (Request::is('/'))    
                    @include('blog.layout.aside')
                @endif
            </div>
        </div>

        {{-- FOOTER --}}
        @include('blog.layout.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('blog') }}/js/scripts.js"></script>
    </body>
</html>
