<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>@yield('judul')</title>
    <link rel="icon" href="{{ asset('image/GOFIT.png') }}" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- Icon -->
    <script src="https://kit.fontawesome.com/b1f0352e54.js" crossorigin="anonymous"></script>
    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        body {
            font-family: 'Poppins';
            font-size: 130%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @yield('header-script')
</head>

<body>

    <header>
        <nav id="sidebarMenu" class="sidebar position-fixed shadow-lg animate__animated animate__fadeInLeft">

            <div class="position-sticky justify-content-center d-flex">
                <img src="{{ asset('image/logo.png') }}" height="120" loading="lazy">
            </div>


            <div class="position-sticky">
                {{-- <div class="info ps-3 pe-3">
                    <hr>
                    <p href="#" class="d-block"><i class="fas fa-user mx-2"></i>
                        {{ $user->NAMA_PEGAWAI }} - {{ $user->ROLE_PEGAWAI }}
                    </p>

                    <hr>
                </div> --}}
                <div class="list-group mx-2">
                    @include('layouts/menu_dashboard')
                </div>
                <div class="list-group mx-2">
                    <a href="{{ url('dashboard/logout') }}"
                        class="list-group-item list-group-item-action py-2 ripple text-white"style="background-color: #1E5F74">
                        <i class="fas fa-solid fa-right-from-bracket fa-fw me-3 text-white"></i><span>Logout</span>
                    </a>
                </div>
                <div class="info text-center blockquote-footer mt-2">
                    powered by@GOFIT-200710850
                </div>
            </div>
        </nav>

        <nav id="main-navbar"
            class="navbar navbar-expand-lg navbar-static-top  no-print  py-4  p-3 mb-5"style="background-color:#2E8A99">
            <div class="d-flex justify-end">
                <button class="btn" onclick="openNav()"> <i class='fas fa-bars fa-1x text-white' id="header-toggle"
                        style="cursor: pointer;"></i>
                </button>
            </div>

        </nav>
    </header>

    <main id="main">
        <div class="d-flex justify-content-between m-5 animate__animated animate__fadeInDown ">
            <h4 class="text-decoration-underline ml-5 ">{{ $user->NAMA_PEGAWAI }} -
                {{ $user->ROLE_PEGAWAI }}
            </h4>
            <h5>
                <i class="fa fa-calendar ms-5 "></i> {{ \Carbon\Carbon::now()->format('l, d M Y') }}
            </h5>
        </div>

        <div class="container animate__animated animate__fadeInUp">

            @include('component/message')
            @yield('main')
        </div>
    </main>
</body>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    $(function() {
        $('#datetimepickermember').datetimepicker({
            format: 'Y-MM-DD'
        });
        $('#datetimepickerschedule').datetimepicker({
            format: 'HH:mm:ss'
        });
    });
</script>
<script>
    function openNav() {
        var elem = elem = document.querySelector('.sidebar');
        var style = getComputedStyle(elem);
        const mediaQuery = window.matchMedia('(min-width: 1024px)')

        if (style.display == "none" && mediaQuery.matches) {
            console.log(mediaQuery.matches);
            document.getElementById("sidebarMenu").style.setProperty('display', 'block', 'important');
            document.getElementById("main").style.paddingLeft = "240px";
            document.getElementById("header-toggle").style.setProperty('margin-left', '230px');
        } else if (style.display == "none" && !mediaQuery.matches) {
            document.getElementById("sidebarMenu").style.display = "block";
            document.getElementById("main").style.paddingLeft = "0px";
            document.getElementById("header-toggle").style.setProperty('margin-left', '0px', );
        } else if (style.display == "block" && !mediaQuery.matches) {
            document.getElementById("sidebarMenu").style.setProperty('display', 'none', );
            document.getElementById("main").style.setProperty('padding-left', '0px', );
            document.getElementById("header-toggle").style.setProperty('margin-left', '0px', );
        } else if (style.display == "block" && mediaQuery.matches) {
            document.getElementById("sidebarMenu").style.setProperty('display', 'none', 'important');
            document.getElementById("main").style.setProperty('padding-left', '0px', 'important');
            document.getElementById("header-toggle").style.setProperty('margin-left', '0px', 'important');
        } else {
            document.getElementById("sidebarMenu").style.display = "none";
            document.getElementById("main").style.paddingLeft = "0px";
            document.getElementById("header-toggle").style.setProperty('margin-left', '0px', );
        }

    }
</script>
@yield('footer-script')

</html>
