<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard DZPL</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      background-color: #eeeeee;
    }

    .sidebar {
      width: 250px;
      background: linear-gradient(to right, #7f0101, #e50101);
      color: #fff;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      transition: width 0.3s ease, left 0.3s ease;
      z-index: 1000;
    }

    .sidebar .logo {
      text-align: center;
      background: #fff;
    }

    .sidebar .logo img {
      width: 100%;
      height: auto;
      display: block;
    }

    .sidebar .create-user-btn {
      display: block;
      width: 100%;
      padding: 15px;
      text-align: center;
      background-color: #5cb85c;
      border: none;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .sidebar .create-user-btn:hover {
      background-color: #4cae4c;
    }

    .sidebar .nav-menu {
      list-style: none;
      padding: 0;
      margin: 0.3cm;
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
      background-color: #d84343;
    }

    .sidebar .nav-link .menu-text {
      margin-left: 15px;
      white-space: nowrap;
      overflow: hidden;
    }

    .sidebar .dropdown-content,
    .sidebar .dropdown-menu {
      display: none;
      list-style: none;
      background-color: #d84343;
      padding: 0;
      margin: 0;
    }

    .sidebar .dropdown.active .dropdown-content,
    .sidebar .dropdown.active .dropdown-menu {
      display: block;
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
      background-color: #e0e0e0;
      color: #000;
    }

    .sidebar .logout-item {
      margin-top: auto;
    }

    .sidebar .logout-btn {
      display: flex;
      align-items: center;
      padding: 15px;
      width: auto;
      color: #fff;
      background: none;
      border: none;
      cursor: pointer;
    }

    .main-content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s ease;
      width: 100%;
    }

    .toggle-btn {
      position: fixed;
      top: 5px; /* Ditinggikan */
      right: 15px;
      background: #e50101;
      border: none;
      font-size: 24px;
      color: white;
      cursor: pointer;
      border-radius: 0 0 12px 12px;
      padding: 5px 10px;
      z-index: 1100;
      display: none;
    }

    /* iPad: Sidebar collapsed style (tapi logo & logout tetap tampil normal) */
    @media (max-width: 1024px) {
      .sidebar {
        width: 70px;
      }

      .main-content {
        margin-left: 70px;
      }

      .toggle-btn {
        display: block !important;
      }

      .sidebar .create-user-btn {
        display: none;
      }

      .sidebar .nav-link .menu-text {
        display: none;
      }
    }

    /* Mobile: Sidebar slide-in, toggle aktif */
    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
        left: -200px;
      }

      .sidebar.active {
        left: 0;
      }

      .main-content {
        margin-left: 0;
      }

      .toggle-btn {
        display: block !important;
      }

      .sidebar .nav-link .menu-text {
        display: inline;
      }
    }
  </style>
</head>
<body>
  <nav class="sidebar">
    <div class="logo">
      <a href="{{ route('dashboard') }}">
        <img src="{{ asset('img/bglog.jpeg') }}" alt="OJK Logo" class="logo-image" />
      </a>
    </div>

    <ul class="nav-menu">
      <li class="nav-item">
        @if(Session::get('role') === 'kasubag')
        <a href="{{ route('register') }}" class="nav-link">
          <i class="fas fa-plus"></i>
          <span class="menu-text">Create New User</span>
        </a>
        @endif
      </li>
      <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span class="menu-text">Dashboard</span></a></li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="fas fa-clock"></i><span class="menu-text">Pending Matters</span></a>
        <ul class="dropdown-content">
          <li class="sub-item"><a href="#">Submenu 1</a></li>
          <li class="sub-item"><a href="#">Submenu 2</a></li>
          <li class="sub-item"><a href="#">Submenu 3</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="fas fa-calendar"></i><span class="menu-text">Agenda DZPL</span></a>
        <ul class="dropdown-content">
          <li class="sub-item"><a href="{{ route('view-rapat-pimpinan.index') }}">Rapat Pimpinan</a></li>
          <li class="sub-item"><a href="{{ route('view-penilaian-kemampuan.index') }}">PKK</a></li>
          <li class="sub-item"><a href="{{ route('view-sosialisasi-riksus.index') }}">Sosialisasi Riksus</a></li>
          <li class="sub-item"><a href="{{ route('forum-panel.index') }}">Forum Panel</a></li>
          <li class="sub-item"><a href="{{ route('agenda-lainnya.index') }}">Agenda Lainnya</a></li>
        </ul>
      </li>
      <li class="nav-item"><a href="{{ route('daftarljk.index') }}" class="nav-link"><i class="fas fa-list"></i><span class="menu-text">Daftar LJK PVML</span></a></li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link"><i class="fas fa-file-alt"></i><span class="menu-text">Pengajuan Perizinan <br />PVML</span></a>
        <ul class="dropdown-content">
          <li class="sub-item dropdown">
            <a>Kepengurusan</a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('pkk') }}">PKK</a></li>
              <li><a href="{{ route('dirkom') }}">Dirkom</a></li>
              <li><a href="{{ route('tka') }}">TKA</a></li>
            </ul>
          </li>
          <li class="dropdown-menu"><a href="{{ route('kelembagaan.index') }}">Pengajuan Kelembagaan</a></li>
        </ul>
      </li>
      <li class="nav-item"><a href="{{ route('quality_control.index') }}" class="nav-link"><i class="fas fa-file-alt"></i><span class="menu-text">Pengendalian Kualitas</span></a></li>
      <li class="nav-item"><a href="{{ route('riksus') }}" class="nav-link"><i class="fas fa-file-alt"></i><span class="menu-text">Riksus</span></a></li>
      <li class="nav-item logout-item">
        <form action="{{ route('logout') }}" method="POST">@csrf
          <button class="nav-link logout-btn"><i class="fas fa-sign-out-alt"></i><span class="menu-text">Logout</span></button>
        </form>
      </li>
    </ul>
  </nav>

  <button class="toggle-btn" id="toggleSidebar"><i class="fas fa-bars"></i></button>

  <main class="main-content">
    <div class="chart-container">
      @yield('content')
    </div>
  </main>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      document.querySelectorAll(".nav-item.dropdown > .nav-link").forEach(link => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          this.parentElement.classList.toggle("active");
        });
      });

      document.querySelectorAll(".sub-item.dropdown > a").forEach(link => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          this.parentElement.classList.toggle("active");
        });
      });

      document.getElementById("toggleSidebar").addEventListener("click", () => {
        const sidebar = document.querySelector(".sidebar");
        if (window.innerWidth < 1024) {
          sidebar.classList.toggle("active");
        }
      });
    });
  </script>
</body>
</html>