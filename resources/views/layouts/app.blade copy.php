<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collapsible Sidebar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');


*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", serif;
}

body{
    min-height: 100vh;
    background: white
    
}


.sidebar{
    position: fixed;
    top: 0;
    left: 0;
    width: 290px;
    height: 100vh;
    background: #A91111;
    transition: all 0.4s ease;
}

.sidebar.collapsed{
    width: 90px;
}

.sidebar .sidebar-header{
    display: flex;
    align-items: center;
    padding: 25px 20px;
    justify-content: space-between;
}

.sidebar-header .header-logo img{
    height: 55px;
    width: 44px;
    display: block;
    object-fit: contain;

}

.sidebar-header .sidebar-toggler{
    position: absolute;
    right: 25px;
    height: 35px;
    width: 35px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #EEF2FF;
    transition: 0.4s ease;

}

.sidebar-header .sidebar-toggler:hover{
    background: #d9e1fd;
}

.sidebar.collapsed .sidebar-toggler{
    transform: translate(-4px, 65px);
}

.sidebar-header .sidebar-toggler span{
    font-size: 1.75rem;
    transition: 0.4s ease;
}

.sidebar.collapsed .sidebar-toggler span{
    transform: rotate(180deg);
}

.sidebar-nav .nav-list{
    list-style: none;
    display: flex;
    gap: 4px;
    padding: 0 15px;
    flex-direction: column;
    transition: traslateY(15px);
    transition: 0.4s ease;
}
.sidebar.collapsed .sidebar-nav .primary-nav{
    transform: translateY(65px);
}

.sidebar-nav .nav-item .nav-link{
    color: #ffffff;
    display: flex;
    gap: 12px;
    white-space: nowrap;
    padding: 11px 15px;
    align-items: center;
    border-radius: 8px;
    text-decoration: none;
    border: 1px solid #A91111;
    transition: 0.4s ease;
}

.sidebar-nav .nav-item:hover > .nav-link:not(.dropdown-title){
    color: #A91111;
    background: #EEF2FF;
}

.sidebar-nav .nav-link :where(.nav-label, .dropdown-icon){
    transition: opacity 0.3s ease;
}

.sidebar.collapsed .nav-link :where(.nav-label, .dropdown-icon){
    opacity: 0;
    pointer-events: none;
}

.sidebar-nav .secondary-nav{
    position: absolute;
    bottom: 30px;
    width: 100%;
    background: #A91111;
}


/* Dropdown */

.sidebar-nav .nav-item{
    position: relative;
}

.sidebar-nav .dropdown-container .dropdown-icon{
    margin: 0 -4px 0 auto;
    transition: transform 0.4s ease, opacity 0.3s 0.2s ease;
}

.sidebar.collapsed .dropdown-container .dropdown-icon{
    transition: opacity 0.3s 0s ease;
}

.sidebar-nav .dropdown-container.open .dropdown-icon{
    transform: rotate(180deg);
}

 .sidebar-nav .dropdown-menu, .dropdown-menu1 {
    height: 0;
    overflow-y: hidden;
    list-style: none;
    padding-left: 10px;
    transition: height 0.4s ease;
}


.sidebar.collapsed .dropdown-menu{
    position: absolute;
    left: 100%;
    top: -10px;
    opacity: 0;
    height: auto !important;
    overflow-y: unset;
    pointer-events: none;
    background: #A91111;
    padding: 7px 10px 7px 24px;
    border-radius: 0 10px 10px 0;
    transition: 0s;
}

.sidebar.collapsed .nav-item:hover .dropdown-menu, .dropdown-menu1{
    opacity: 1;
    pointer-events: auto;
    transform: translateY(10px);
    transition: 0.4s ease;
}


.dropdown-menu .nav-item .nav-link{
    padding: 9px 15px;
}

.sidebar.collapsed .dropdown-menu .nav-link{
    padding: 7px 15px ;
}


.dropdown-menu .nav-item .dropdown-title{
    display: none;
    font-weight: 500;
}

.sidebar.collapsed .dropdown-menu .nav-item .dropdown-title{
    display: block;
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

        @media (max-width: 1380px) {
            .main-content {
                margin-left: 70px;
            }
        }

    </style>
</head>

<body>
    <aside class="sidebar">
        <header class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="header-logo">
                <img src="Logo DZPL.png" alt="" class="DZPLlogo">
            </a>
            <button class="sidebar-toggler">
                <span class="material-symbols-rounded">
                    chevron_left
                </span>
            </button>
        </header>

        <nav class="sidebar-nav">
            <ul class="nav-list primary-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="material-symbols-rounded">
                            space_dashboard
                        </span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="material-symbols-rounded">
                            schedule
                        </span>
                        <span class="nav-label">Pendding Matters</span>
                    </a>
                </li>
                <li class="nav-item dropdown-container">
                    <a href="#" class="nav-link dropdown-toggle">
                        <span class="material-symbols-rounded">
                            view_agenda
                        </span>
                        <span class="nav-label">Agenda DZPL</span>
                        <span class="dropdown-icon material-symbols-rounded">
                            keyboard_arrow_down
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link dropdown-title">Agenda DZPL</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view-rapat-pimpinan.index') }}" class="nav-link dropdown-link">Rapat Pimpinan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view-penilaian-kemampuan.index') }}" class="nav-link dropdown-link">PKK</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view-sosialisasi-riksus.index') }}" class="nav-link dropdown-link">Sosialisasi Riksus</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('forum-panel.index') }}" class="nav-link dropdown-link">Forum Panel</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftarljk.index') }}" class="nav-link">
                        <span class="material-symbols-rounded">
                            list_alt
                        </span>
                        <span class="nav-label">Daftar LJK PVML</span>
                    </a>
                </li>
                <li class="nav-item dropdown-container">
                    <a href="#" class="nav-link dropdown-toggle">
                        <span class="material-symbols-rounded">
                            edit_document
                        </span>
                        <span class="nav-label">Pengajuan Perizinan <br>Kepengurusan</span>
                        <span class="dropdown-icon material-symbols-rounded">
                            keyboard_arrow_down
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link dropdown-title">Pengajuan Perizinan <br>Kepengurusan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pkk') }}" class="nav-link dropdown-link">PKK</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dirkom') }}" class="nav-link dropdown-link">Dirkom</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tka') }}" class="nav-link dropdown-link">TKA</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown-container">
                    <a href="#" class="nav-link dropdown-toggle">
                        <span class="material-symbols-rounded">
                            edit_document
                        </span>
                        <span class="nav-label">Pengajuan Perizinan <br>Kelembagaan</span>
                        <span class="dropdown-icon material-symbols-rounded">
                            keyboard_arrow_down
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link dropdown-title">Pengajuan Perizinan <br>Kelembagaan</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('quality_control.index') }}" class="nav-link dropdown-link">Pengendalian Kualitas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riksus') }}" class="nav-link dropdown-link">Riksus</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav-list secondary-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="material-symbols-rounded"> Logout</span>
                        <span class="nav-label"> Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <div class="chart-container">
            @yield('content')
        </div>
    </main>
    <script>
        const toggleDropdown = (dropdown, menu, isOpen) =>{
    dropdown.classList.toggle("open", isOpen)
    menu.style.height = isOpen ?`${menu.scrollHeight}px`: 0;
}

const closeAllDropdowns = () => {
    document.querySelectorAll(".dropdown-container.open").forEach(openDropdown =>{
        toggleDropdown(openDropdown, openDropdown.querySelector(".dropdown-menu"), false);
    })
}

document.querySelectorAll(".dropdown-toggle").forEach(dropdownToggle =>{
    dropdownToggle.addEventListener("click", e=>{
        e.preventDefault();

        const dropdown = e.target.closest(".dropdown-container");
        const menu = dropdown.querySelector(".dropdown-menu");
        const isOpen = dropdown.classList.contains("open");

        toggleDropdown(dropdown, menu, !isOpen);
    });
});


document.querySelector(".sidebar-toggler").addEventListener
("click", ()=>{
    closeAllDropdowns();


    document.querySelector(".sidebar").classList.toggle
    ("collapsed");
})



    

    </script>
</body>

</html>