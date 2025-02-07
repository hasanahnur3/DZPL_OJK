<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PVML</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> <!-- asli -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes full viewport height */
        }

        .menu-toggle {
            display: none;
            position: absolute;
            top: 15px;
            left: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            z-index: 10; /* Ensure it's above the sidebar */
        }

        .container {
            display: flex;
            flex-grow: 1; /* Key: Allow container to grow and fill available space */
            height: 100%; /* Important: Set container height to 100% */
        }

        .sidebar {
            width: 250px;
            background-color: #A91111;
            padding: 1rem;
            transition: transform 0.3s ease-in-out;
            overflow-y: auto; /* Add scroll if content overflows */
            color: white; /* Text color in sidebar */
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
            color: white; /* Link color */
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Slightly transparent white on hover */
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
            flex: 1; /* Key: Allow main content to take up remaining space */
            padding: 2rem;
            background-color: #f5f5f5;
            overflow-y: auto; /* Add scroll if content overflows */
            height: 100%; /* Important: Set main content height to 100% */
        }

        .chart-container {
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 100%; /* Important: Chart container should also be 100% height */
        }

        span {
            margin-left: 10px;
        }

        span, i {
            color: white;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .menu-toggle {
                display: block;
            }

            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 250px;
                position: fixed;
                left: -250px;
                top: 0;
                height: 100%; /* Sidebar takes full height on mobile */
                background-color: #A91111; /* Keep the dark background */
                padding: 1rem;
                transition: left 0.3s ease-in-out;
                overflow-y: auto;
                z-index: 11; /* Ensure sidebar is above main content */
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
               <a href="{{ route('dashboard') }}">  <img src="img/logo.jpg" alt="OJK Logo" style="max-width: 150px;"></a>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clock"></i>
                        <span>Pending Matters</span>
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
                        <span>Agenda DZPL</span>
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
                        <span>Daftar LJK PVML</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span>Daftar Pengajuan</span>
                    </a>
                    <ul class="dropdown-content">
                        <li class="sub-item">
                            <a href="#">Perizinan PVML</a>
                            <ul class="sub-dropdown-content">
                                <li class="sub-item">
                                    <a href="{{ route('kepengurusan.index') }}">Kepengurusan</a>
                                </li>
                                <li class="sub-item">
                                    <a href="{{ route('kelembagaan.index') }}">Kelembagaan</a>
                                </li>
                                <li class="sub-item dropdown">
                                    <a href="{{ route('pkk') }}">PKK</a>
                                </li>
                                <li class="sub-item dropdown">
                                    <a href="{{ route('dirkom') }}">Dirkom</a>
                                </li>
                                <li class="sub-item dropdown">
                                    <a href="{{ route('tka') }}">TKA</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('quality_control.index') }}">Pengendalian Kualitas</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('riksus') }}">Riksus</a>
                        </li>
                    </ul>
                </li>     
            </ul>
        </nav>
        
    
        <main class="main-content">

            <div class="chart-container">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.nav-item > .nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const parentItem = this.parentElement;
                const dropdownContent = parentItem.querySelector('.dropdown-content');
                if (dropdownContent) {
                    e.preventDefault();
                    parentItem.classList.toggle('active');
                }
            });
        });

        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>


