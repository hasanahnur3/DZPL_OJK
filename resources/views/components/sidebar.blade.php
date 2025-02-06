<div class="w-64 min-h-screen bg-gray-200 p-4">
    <div class="flex items-center mb-6">
        <img src="{{ asset('images/ojk-logo.png') }}" alt="OJK Logo" class="h-12">
    </div>
    <ul class="space-y-2">
        <li>
            <a href="#" class="block py-2 px-4 rounded-lg bg-gray-300">Dashboard</a>
        </li>
        <li>
            <button class="w-full text-left py-2 px-4 rounded-lg bg-gray-300" onclick="toggleDropdown('pendingMatters')">Pending Matters</button>
            <ul id="pendingMatters" class="hidden pl-4">
                <li><a href="#" class="block py-2 px-4">Submenu 1</a></li>
            </ul>
        </li>
        <li>
            <button class="w-full text-left py-2 px-4 rounded-lg bg-gray-300" onclick="toggleDropdown('agenda')">Agenda DZPL</button>
            <ul id="agenda" class="hidden pl-4">
                <li><a href="{{ route('agenda.rapat-pimpinan') }}" class="block py-2 px-4">Rapat Pimpinan</a></li>
                <li><a href="{{ route('agenda.penilaian-kemampuan') }}" class="block py-2 px-4">Penilaian Kemampuan dan Kepatutan</a></li>
                <li><a href="{{ route('agenda.forum-panji') }}" class="block py-2 px-4">Forum Panji</a></li>
                <li><a href="{{ route('agenda.sosialisasi-riksus') }}" class="block py-2 px-4">Sosialisasi Riksus</a></li>
            </ul>
        </li>
        <li>
            <button class="w-full text-left py-2 px-4 rounded-lg bg-gray-300" onclick="toggleDropdown('lukPvml')">Daftar LUK PVML</button>
            <ul id="lukPvml" class="hidden pl-4">
                <li><a href="#" class="block py-2 px-4">Daftar 1</a></li>
            </ul>
        </li>
        <li>
            <button class="w-full text-left py-2 px-4 rounded-lg bg-gray-300" onclick="toggleDropdown('pengajuan')">Daftar Pengajuan</button>
            <ul id="pengajuan" class="hidden pl-4">
                <li><a href="#" class="block py-2 px-4">Daftar 1</a></li>
            </ul>
        </li>
    </ul>
</div>

<script>
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle("hidden");
    }
</script>
