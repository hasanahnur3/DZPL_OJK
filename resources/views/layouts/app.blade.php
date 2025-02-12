<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PVML</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- asli -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            margin: 0px;
            padding: 0px;
        }


        .menu-toggle {
            display: none;
            top: 15px;
            left: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }

        .container {
            display: flex;
            flex-direction: row;
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s ease-in-out;
        }

        .sidebar {
            width: 250px;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            transition: transform 0.3s ease-in-out;
            position: relative;
            /* Sidebar tetap 250px */
            background-color: #A91111;
        }

        .sidebar.collapsed {
            width: 100px;
        }

        .sidebar .logo {
            text-align: center;
            padding: 1rem;
        }

        .sidebar .logo img {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.collapsed .logo img {
            transform: scale(0.7);
        }

        .sidebar .nav-menu {
            list-style: none;
            padding: 1rem;
        }

        .sidebar .nav-item {
            margin-bottom: 1rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            padding: 0.75rem;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background-color: #D84343;
        }

        .sidebar .menu-text {
            margin-left: 10px;
            transition: opacity 0.3s ease-in-out;
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar .toggle-btn {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background-color: #D84343;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .sidebar .toggle-btn:hover {
            background-color: #FF5757;
        }

        .logo {
            margin-bottom: 2rem;
            padding: 1rem;
            text-align: center;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .nav-link:hover {
            background-color: #D0D0D0;
        }

        .dropdown-content {
            display: none;
            padding-left: 1rem;
            list-style: none;
        }

        .dropdown-content .sub-item {
            padding: 0.75rem;
            padding-left: 1.5rem;
        }

        .active .dropdown-content {
            display: block;
        }

        .main-content {
            flex: 1;
            padding: 1rem;
            background-color: #f5f5f5;
            width: 100%;
        }

        .industry-dropdown {
            text-align: right;
            margin-bottom: 1rem;
        }

        select {
            padding: 0.5rem;
            border-radius: 4px;
        }

        /* .chart-container {
            display: flex;
            align-items: center;
            min-height: 100vh;
        } */

        F
        .chart-container {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 100%;
        }

        /* 
        span {
            margin-left: 10px;
        }

        span,
        i {
            color: #ffffff;
        } */

        /* Awal: Sembunyikan submenu */
        .dropdown-menu {
            display: none;
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            background-color: #faf8f8;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            min-width: 200px;
            z-index: 1000;
            left: 0;
            /* Menjaga menu tetap di bawah item parent */
            top: 100%;
            /* Menu muncul di bawah item induk */
        }

        /* Tampilkan submenu ketika parent di-hover */
        .sub-item:hover>.dropdown-menu {
            display: block;
        }

        /* Submenu item styling */
        .dropdown-menu li {
            padding: 10px 20px;
        }

        .dropdown-menu li a {
            text-decoration: none;
            color: #333;
            display: block;
        }

        .dropdown-menu li a:hover {
            background-color: #A91111;
            color: white;
            border-radius: 4px;
        }

        .sub-item {
            position: relative;
        }


        /* Responsive Styles */
        @media (max-width: 1400px) {
            .menu-toggle {
                display: block;
            }

            .container {
                flex-direction: column;
                max-width: 100%;
            }

            .sidebar {
                width: 250px;
                position: fixed;
                left: -250px;
                top: 0;
                height: 100vh;
                /* Menjadikan sidebar penuh dari atas ke bawah */
                background-color: #E0E0E0;
                padding: 1rem;
                transition: left 0.3s ease-in-out;
                overflow-y: auto;
                /* Jika konten lebih panjang dari layar, bisa di-scroll */
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                padding: 1rem;
            }

            .industry-dropdown {
                text-align: center;
            }

            select {
                width: 100%;
            }
        }
    </style>
</head>

<body>


    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <a href="{{ route('dashboard') }}"> <img src="{{ asset('img/logo.jpg') }}" alt="OJK Logo" style="max-width: 150px;">
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clock"></i>
                        <span class="menu-text">Pending Matters</span>
                    </a>
                    <ul class="dropdown-content">
                        <li class="sub-item">
                            <a href="#">Submenu 1</a>
                        </li>
                        <li class="sub-item">
                            <a href="#">Submenu 2</a>
                        </li>
                        <li class="sub-item">
                            <a href="#">Submenu 3</a>
                        </li>
                    </ul>
                </li>
                <!-- Menu bar with dropdown submenu -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar"></i>
                        <span class="menu-text">Agenda DZPL</span>
                    </a>
                    <ul class="dropdown-content">
                        <li class="sub-item">
                            <a href="{{ route('view-rapat-pimpinan.index') }}">Rapat Pimpinan</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('view-penilaian-kemampuan.index') }}">PKK</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('view-sosialisasi-riksus.index') }}">Sosialisasi Riksus</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('forum-panel.index') }}">Forum Panel</a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftarljk.index') }}" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span class="menu-text">Daftar LJK PVML</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" id="daftarPengajuan">
                        <i class="fas fa-file-alt"></i>
                        <span class="menu-text">Pengajuan Perizinan PVML</span>
                    </a>
                    <ul class="dropdown-content" id="perizinanPVML">
                        <li class="sub-item">
                            <a class="nav-link" id="kepengurusan">Kepengurusan</a>
                            <ul class="dropdown-menu" id="kepengurusanMenu">
                                <li><a href="{{ route('pkk') }}">PKK</a></li>
                                <li><a href="{{ route('dirkom') }}">Dirkom</a></li>
                                <li><a href="{{ route('tka') }}">TKA</a></li>
                            </ul>
                        </li>
                        <li class="sub-item">
                            <a class="nav-link" id="kelembagaan">Kelembagaan</a>
                            <ul class="dropdown-menu" id="kelembagaanMenu">
                                <li><a href="{{ route('quality_control.index') }}">Pengendalian Kualitas</a></li>
                                <li><a href="{{ route('riksus') }}">Riksus</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="toggle-btn" id="toggleSidebar">☰</button>
        </nav>


        <main class="main-content">

            <div class="chart-container">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.nav-item > .nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                const parentItem = this.parentElement;
                const dropdownContent = parentItem.querySelector('.dropdown-content');
                if (dropdownContent) {
                    e.preventDefault();
                    parentItem.classList.toggle('active');
                }
            });
        });

        document.querySelector('.menu-toggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        document.querySelector('.toggle-button').addEventListener('click', function () {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            sidebar.classList.toggle('small');
        });

    </script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', () => {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>

</html>