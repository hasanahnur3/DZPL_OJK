<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collapsible Sidebar</title>
    <title>Dashboard DZPL</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #EEEEEE;
        }
        .sidebar {
            width: 250px;
            background-color: #D84343;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar .logo {
            padding: 20px;
            text-align: center;
        }
        .sidebar .logo img {
            max-width: 150px;
            transition: max-width 0.3s ease;
        }
        .sidebar.collapsed .logo img {
            max-width: 70px;
        }
        .sidebar .create-user-btn {
            display: block;
            width: 100%;
            padding: 15px;
            text-align: center;
            color: #fff;
            background-color: #5cb85c;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .sidebar .create-user-btn:hover {
            background-color: #4cae4c;
        }
        .sidebar .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar .nav-item {
            position: relative;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #D84343;
        }
        .sidebar .nav-link .menu-text {
            margin-left: 15px;
        }
        .dropdown-content {
            display: none;
            /* Sembunyikan dropdown secara default */
        }
        .dropdown-content.show {
            display: block;
            /* Tampilkan dropdown saat aktif */
        }
        .sidebar .dropdown-content,
        .sidebar .dropdown-menu {
            display: none;
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #D84343;
        }
        .sidebar .dropdown-content .sub-item a,
        .sidebar .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 25px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .sidebar .dropdown-content .sub-item a:hover,
        .sidebar .dropdown-menu a:hover {
            background-color: #E0E0E0;
        }
        .sidebar .dropdown-content .sub-item.dropdown .dropdown-menu {
            margin-left: 20px;
        }
        .sidebar .dropdown.active .dropdown-content,
        .sidebar .dropdown.active .dropdown-menu {
            display: block;
        }
        .sidebar .logout-item {
            margin-top: auto;
        }
        .sidebar .logout-btn {
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            color: #fff;
            background-color: #9d0601;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .sidebar .logout-btn:hover {
            background-color: #c9302c;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
            width: 100%;
        }
        .main-content.collapsed {
            margin-left: 70px;
        }
        .toggle-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
        @media (max-width: 1380px) {
            .sidebar {
                width: 70px;
            }
            .container {
                flex-direction: column;
                max-width: 100%;
            }
            select {
                width: 100%;
            }
            .sidebar .logo img {
                max-width: 70px;
            }
            .sidebar .create-user-btn {
                display: none;
            }
            .main-content {
                margin-left: 70px;
            }
        }


        .sidebar .dropdown-content .sub-item.dropdown .dropdown-menu {
    position: static;
    display: none;
    padding-left: 15px;
    background-color: rgba(0, 0, 0, 0.1);
    width: 100%;
}

.sidebar .dropdown-content .sub-item.dropdown.active .dropdown-menu {
    display: block;
}

/* Ensure all menu text is visible */
.sidebar .nav-link .menu-text,
.sidebar .dropdown-content .sub-item a,
.sidebar .dropdown-menu a {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

    </style>
</head>

<body>>

    <nav class="sidebar">
        <div class="logo">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" alt="OJK Logo" class="logo-image">
            </a>
        </div>
        @if(Session::get('role') === 'kasubag')
            <a href="{{ route('register') }}" class="btn create-user-btn">Create New User</a>
        @endif
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
                <a href="#" class="nav-link">
                    <i class="fas fa-file-alt"></i>
                    <span class="menu-text">Pengajuan Perizinan PVML</span>
                </a>
                <ul class="dropdown-content">
                    <li class="sub-item dropdown">
                        <a>Kepengurusan</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('pkk') }}">PKK</a></li>
                            <li><a href="{{ route('dirkom') }}">Dirkom</a></li>
                            <li><a href="{{ route('tka') }}">TKA</a></li>
                        </ul>
                    </li>
                    <li class="sub-item dropdown">
                        <a>Kelembagaan</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('quality_control.index') }}">Pengendalian Kualitas</a></li>
                            <li><a href="{{ route('riksus') }}">Riksus</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item logout-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
        <button class="toggle-btn" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <main class="main-content">
        <div class="chart-container">
            @yield('content')
        </div>
    </main>

    <script>
       // Replace your current dropdown JS with this
document.addEventListener('DOMContentLoaded', () => {
    // Main dropdown toggles
    document.querySelectorAll('.nav-item.dropdown > .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const parentItem = this.parentElement;
            parentItem.classList.toggle('active');
        });
    });
    
    // Sub-item dropdown toggles
    document.querySelectorAll('.sub-item.dropdown > a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const parentItem = this.parentElement;
            parentItem.classList.toggle('active');
        });
    });

    // Toggle sidebar
    document.getElementById('toggleSidebar').addEventListener('click', () => {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
        
        const logoImage = sidebar.querySelector('.logo img');
        logoImage.style.maxWidth = sidebar.classList.contains('collapsed') ? '70px' : '150px';
    });
});
    </script>
</body>