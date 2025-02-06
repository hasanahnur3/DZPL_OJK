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

        body {
            font-family: Arial, sans-serif;
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
        }

        .container {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #A91111;
            padding: 1rem;
            transition: transform 0.3s ease-in-out;
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
            padding: 2rem;
            background-color: #f5f5f5;
        }

        .industry-dropdown {
            text-align: right;
            margin-bottom: 1rem;
        }

        select {
            padding: 0.5rem;
            border-radius: 4px;
        }

        .chart-container {
            background-color: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        span{
            margin-left: 10px;
        }
        span, i{
            color: #ffffff;
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
                height: 100vh; /* Menjadikan sidebar penuh dari atas ke bawah */
                background-color: #E0E0E0;
                padding: 1rem;
                transition: left 0.3s ease-in-out;
                overflow-y: auto; /* Jika konten lebih panjang dari layar, bisa di-scroll */
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
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">
                        <i class="fas fa-list"></i>
                        <span>Daftar LJK PVML</span>
                    </a>
                    <ul class="dropdown-content">
                        <li class="sub-item">
                            <a href="{{ route('list.lembagaKeuanganMikro') }}">Lembaga Keuangan Mikro</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('list.lpbbti') }}">LPBBTI</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('list.pergadaian') }}">Pergadaian</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('list.perusahaanModalVentura') }}">Perusahaan Modal ventura</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('list.perusahaanPembiayaan') }}">Perusahaan Penbiayaan</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('list.sueGeneris') }}">Sue Generis</a>
                        </li>                        
                    </ul>
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
                                <li class="sub-item dropdown">
                                    <a href="{{ route('kelembagaan') }}">Kelembagaan</a>
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


