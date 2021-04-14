<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Frumbledingle - @yield('page_title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Orbitron:700&display=swap" />
    <style type="text/css">
        #app-container {
            margin: auto;
            width: 1024px;
        }

        .logo {
            color: #121889;
            font-family: 'Orbitron';
            font-size: 4em;
            margin-top: 20px;
            text-align: center;
            text-shadow: #999 4px 4px 8px;
        }
    </style>
    @yield('page_style')
</head>

<body>
    <div id="app" class="mb-5">
        <div class="logo"><i class="fa fa-object-group"></i> Frumbledingle Corp</div>
        <header class="p-3 bg-dark text-white justify-content-center mb-4">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                        <li><a href="/locations" class="nav-link px-2 text-white">Locations</a></li>
                        <li><a href="/items" class="nav-link px-2 text-white">Items</a></li>
                        <li><a href="/categories" class="nav-link px-2 text-white">Categories</a></li>
                        <li><a href="/report" class="nav-link px-2 text-white">Report</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src=" {{ elixir('js/app.js') }}"></script>
    <style>
    a.nav-link.text-white:hover {
        color: #afaeae !important;
    }
    </style>
</body>

</html>