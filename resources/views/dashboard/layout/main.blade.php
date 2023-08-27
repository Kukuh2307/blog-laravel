<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard- {{ $tittle }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('blog') }}/assets/write.png" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('admin') }}/css/styles.css" rel="stylesheet" />
        {{-- cdn font awesome --}}
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        {{-- ckeditor --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <style>
            .ck-editor__editable{
                min-height: 100px
            }
        </style>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            {{-- sidebar --}}
            @include('dashboard.layout.sidebar')
            <!-- Page content wrapper-->
            <div id="page-content-wrapper" style="background-color: #ECECEC">
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

        <script>
            function tampilGambar() {
                let gambarInput = document.getElementById('gambar');
                let tampilGambar = document.querySelector('.tampil-gambar');

                tampilGambar.style.display = 'block';

                const oFReader = new FileReader();
    
                oFReader.readAsDataURL(gambarInput.files[0]);

                oFReader.onload = function(oFREvent) {
                    tampilGambar.src = oFREvent.target.result;
            };
        }

        ClassicEditor
		.create( document.querySelector( '#editor' ) )
		.catch( error => {
			console.error( error );
		} );
        </script>
    </body>
</html>
