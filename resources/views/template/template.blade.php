<!DOCTYPE html>

<head>
    <title>@yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/barang/')}}">Data Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/jual/')}}">Jual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/beli/')}}">Beli</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/stok/')}}">Stok</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Logs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</body>
<footer>
    @yield('footer')
</footer>

</html