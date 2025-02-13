<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\KelembagaanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DireksiKomisarisController;
use App\Http\Controllers\DirkomController;
use App\Http\Controllers\TkaController;
use App\Http\Controllers\KelembagaanPvmlController;
use App\Http\Controllers\PkkController;
use App\Http\Controllers\RiksusController;
use App\Http\Controllers\QualityControlController;
use App\Http\Controllers\SosialisasiRiksusController;
use App\Http\Controllers\ForumPanelController;
use App\Http\Controllers\RapimController;
use App\Http\Controllers\PkkAgendaController;
use App\Http\Controllers\ViewSosialisasiRiksusController;
use App\Http\Controllers\ViewPkkAgendaController;
use App\Http\Controllers\ViewRapimController;
use App\Http\Controllers\ViewForumPanelController;
use App\Http\Controllers\ViewPenilaianController;
use App\Http\Controllers\ViewKelembagaanPvmlController;
use App\Http\Controllers\DaftarljkController;
use App\Models\Daftarljk;




Route::get('/daftar-ljk', function () {
    return view('daftar-ljk');
});

// Rapat Pimpinan
Route::get('/agenda/rapat-pimpinan', function () {
    return view('agenda.rapat-pimpinan');
})->name('rapat.pimpinan');

// Penilaian Kemampuan (PKK)
Route::get('/agenda/penilaian-kemampuan', function () {
    return view('agenda.penilaian-kemampuan');
})->name('penilaian.kemampuan');

// Sosialisasi Riksus
Route::get('/agenda/sosialisasi-riksus', function () {
    return view('agenda.sosialisasi-riksus');
})->name('sosialisasi.riksus');

// Forum Panel
Route::get('/agenda/forum-panel', function () {
    return view('agenda.forum-panel');
})->name('forum.panel');


Route::get('/list/lembaga-keuangan-mikro', [ListController::class, 'lembagaKeuanganMikro'])->name('list.lembagaKeuanganMikro');
Route::get('/list/lpbbti', [ListController::class, 'lpbbti'])->name('list.lpbbti');
Route::get('/list/pergadaian', [ListController::class, 'pergadaian'])->name('list.pergadaian');
Route::get('/list/perusahaan-modal-ventura', [ListController::class, 'perusahaanModalVentura'])->name('list.perusahaanModalVentura');
Route::get('/list/perusahaan-pembiayaan', [ListController::class, 'perusahaanPembiayaan'])->name('list.perusahaanPembiayaan');
Route::get('/list/sue-generis', [ListController::class, 'sueGeneris'])->name('list.sueGeneris');



Route::get('/kepengurusan', [PenilaianController::class, 'index'])->name('kepengurusan.index');
Route::post('/kepengurusan/store', [PenilaianController::class, 'store'])->name('kepengurusan.store');
Route::get('/kepengurusan', [PenilaianController::class, 'index'])->name('kepengurusan.index');
Route::get('/kepengurusan', [ViewPenilaianController::class, 'index'])->name('kepengurusan');
Route::get('/kepengurusan/create', [ViewPenilaianController::class, 'create'])->name('kepengurusan.create');
Route::post('/kepengurusan', [ViewPenilaianController::class, 'store'])->name('kepengurusan.store');
Route::get('/kepengurusan/{id}/edit', [ViewPenilaianController::class, 'edit'])->name('kepengurusan.edit');
Route::put('/kepengurusan/{id}', [ViewPenilaianController::class, 'update'])->name('kepengurusan.update');
Route::get('/kepengurusan/edit/{id}', [ViewPenilaianController::class, 'edit'])->name('kepengurusan.edit');
Route::put('/kepengurusan/update/{id}', [ViewPenilaianController::class, 'update'])->name('kepengurusan.update');
Route::get('/kepengurusan', [ViewPenilaianController::class, 'index'])->name('kepengurusan.index');




Route::resource('dirkom', DirkomController::class);Route::get('perizinanpvml/dirkom', [DirkomController::class, 'index'])->name('dirkom');
Route::get('perizinanpvml/dirkom/create', [DirkomController::class, 'create'])->name('dirkom.create');
Route::post('perizinanpvml/dirkom', [DirkomController::class, 'store'])->name('dirkom.store');
Route::get('/dirkom', [DirkomController::class, 'index'])->name('view-dirkom');
Route::get('/dirkom/create', [DirkomController::class, 'create'])->name('dirkom.create');
Route::post('/dirkom', [DirkomController::class, 'store'])->name('dirkom.store');
Route::get('/dirkom/{id}/edit', [DirkomController::class, 'edit'])->name('dirkom.edit');
Route::put('/dirkom/{id}', [DirkomController::class, 'update'])->name('dirkom.update');
Route::get('/view-dirkom', [DirkomController::class, 'index'])->name('view-dirkom');
Route::get('/get-companies', [DirkomController::class, 'getCompaniesByIndustry']);



Route::get('perizinanpvml/tka', [TkaController::class, 'index'])->name('tka.index');
Route::get('perizinanpvml/tka/create', [TkaController::class, 'create'])->name('tka.create');
Route::post('perizinanpvml/tka', [TkaController::class, 'store'])->name('tka.store');
Route::get('/tka', [TkaController::class, 'index'])->name('tka');
Route::get('/tka/create', [TkaController::class, 'create'])->name('tka.create');
Route::post('/tka/store', [TkaController::class, 'store'])->name('tka.store');
Route::get('/tka/edit/{id}', [TkaController::class, 'edit'])->name('tka.edit');
Route::post('/tka/update/{id}', [TkaController::class, 'update'])->name('tka.update');
Route::get('/get-companies', [TkaController::class, 'getCompaniesByIndustry']);



// Menampilkan halaman utama (daftar kelembagaan)
Route::get('perizinanpvml/kelembagaan', [KelembagaanPvmlController::class, 'index'])->name('kelembagaan.index');
Route::get('perizinanpvml/kelembagaan/create', [KelembagaanPvmlController::class, 'create'])->name('kelembagaan.create');
Route::post('perizinanpvml/kelembagaan', [KelembagaanPvmlController::class, 'store'])->name('kelembagaan.store');
Route::get('perizinanpvml/kelembagaan/{id}/edit', [KelembagaanPvmlController::class, 'edit'])->name('kelembagaan.edit');
Route::put('perizinanpvml/kelembagaan/{id}', [KelembagaanPvmlController::class, 'update'])->name('kelembagaan.update');
Route::delete('perizinanpvml/kelembagaan/{id}', [KelembagaanPvmlController::class, 'destroy'])->name('kelembagaan.destroy');
Route::get('/kelembagaan', [KelembagaanPvmlController::class, 'index'])->name('kelembagaan.index');
Route::post('/kelembagaan', [KelembagaanPvmlController::class, 'store'])->name('kelembagaan.store');
Route::get('/view-kelembagaan', [ViewKelembagaanPvmlController::class, 'index'])->name('view-kelembagaan.index');
Route::post('/view-kelembagaan', [ViewKelembagaanPvmlController::class, 'store'])->name('view-kelembagaan.store');
Route::get('/view-kelembagaan/{id}/edit', [ViewKelembagaanPvmlController::class, 'edit'])->name('view-kelembagaan.edit');
Route::post('/view-kelembagaan/{id}/update', [ViewKelembagaanPvmlController::class, 'update'])->name('view-kelembagaan.update');
Route::get('/kelembagaan', [ViewKelembagaanPvmlController::class, 'index'])->name('kelembagaan.index');
Route::get('/kelembagaan/create', [ViewKelembagaanPvmlController::class, 'create'])->name('kelembagaan.create');
Route::post('/kelembagaan/store', [ViewKelembagaanPvmlController::class, 'store'])->name('kelembagaan.store');
Route::get('/kelembagaan/{id}/edit', [ViewKelembagaanPvmlController::class, 'edit'])->name('kelembagaan.edit');
Route::put('/kelembagaan/{id}', [ViewKelembagaanPvmlController::class, 'update'])->name('kelembagaan.update');



Route::get('/pkk', [PkkController::class, 'index'])->name('pkk');
Route::post('/pkk/store', [PkkController::class, 'store'])->name('pkk.store');
Route::get('/pkk', [PkkController::class, 'index'])->name('pkk');
Route::post('/pkk/store', [PkkController::class, 'store'])->name('pkk.store');
Route::get('/pkk', [PkkController::class, 'index'])->name('pkk'); // Halaman utama view
Route::get('/pkk/create', [PkkController::class, 'create'])->name('pkk.create'); // Halaman tambah data
Route::post('/pkk', [PkkController::class, 'store'])->name('pkk.store'); // Menyimpan data
Route::get('/pkk/{id}/edit', [PkkController::class, 'edit'])->name('pkk.edit'); // Halaman edit data
Route::put('/pkk/{id}', [PkkController::class, 'update'])->name('pkk.update'); // Update data
Route::get('/get-companies', [PkkController::class, 'getCompaniesByIndustry']);


Route::get('agenda/view-sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'index']);
Route::get('sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'show'])->name('sosialisasi-riksus');
Route::get('agenda/view-sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'index'])->name('view-sosialisasi-riksus.index');
Route::resource('sosialisasi-riksus', SosialisasiRiksusController::class);
Route::resource('riksus', RiksusController::class);
Route::resource('pengendaliankualitas/riksus', RiksusController::class);
Route::get('pengendaliankualitas/riksus', [RiksusController::class, 'index']);
Route::post('pengendaliankualitas/riksus', [RiksusController::class, 'store']);
Route::get('pengendaliankualitas/riksus/{id}', [RiksusController::class, 'show']);
Route::put('pengendaliankualitas/riksus/{id}', [RiksusController::class, 'update']);
Route::delete('pengendaliankualitas/riksus/{id}', [RiksusController::class, 'destroy']);
Route::get('/riksus', [RiksusController::class, 'create'])->name('riksus');
Route::post('/riksus/store', [RiksusController::class, 'store'])->name('pengendaliankualitas.store');
Route::get('/riksus/create', [RiksusController::class, 'create'])->name('riksus.create');
Route::get('/riksus', [RiksusController::class, 'index'])->name('riksus.index');
Route::get('/riksus/create', [RiksusController::class, 'create'])->name('riksus.create');
Route::post('/riksus', [RiksusController::class, 'store'])->name('riksus.store');
Route::get('/riksus/{id}/edit', [RiksusController::class, 'edit'])->name('riksus.edit');
Route::put('/riksus/{id}', [RiksusController::class, 'update'])->name('riksus.update');
Route::delete('/riksus/{id}', [RiksusController::class, 'destroy'])->name('riksus.destroy');
Route::get('/riksus', [RiksusController::class, 'index'])->name('riksus');
Route::get('/get-companies', [RiksusController::class, 'getCompaniesByIndustry']);
Route::get('/sosialisasi-riksus/{id}/view', [SosialisasiRiksusController::class, 'show'])->name('sosialisasi-riksus.view');
Route::get('sosialisasi-riksus/{id}/view', [SosialisasiRiksusController::class, 'show'])->name('sosialisasi-riksus.view');


Route::resource('forum-panel', ForumPanelController::class);
Route::get('/view-forum-panel', [ViewForumPanelController::class, 'index'])->name('forum-panel.index');
Route::get('/forum-panel/create', [ViewForumPanelController::class, 'create'])->name('forum-panel.create');
Route::post('/forum-panel', [ViewForumPanelController::class, 'store'])->name('forum-panel.store');
Route::put('forum-panel/{id}', [ViewForumPanelController::class, 'update'])->name('forum-panel.update');
Route::put('/forum-panel/{id}', [ForumPanelController::class, 'update'])->name('forum-panel.update');



Route::resource('quality_control', QualityControlController::class);
Route::get('/get-companies', [QualityControlController::class, 'getCompaniesByIndustry'])->name('quality_control.getCompanies');
Route::post('/quality_control', [QualityControlController::class, 'store'])->name('quality_control.store');
Route::get('/quality-control', [QualityControlController::class, 'index'])->name('quality_control.index');
Route::get('/quality-control/create', [QualityControlController::class, 'create'])->name('quality_control.create');
Route::post('/quality-control', [QualityControlController::class, 'store'])->name('quality_control.store');
Route::get('/get-companies', [QualityControlController::class, 'getCompaniesByIndustry']);
Route::get('/get-companies', [QualityControlController::class, 'getCompaniesByIndustry'])->name('get.companies');
Route::get('/quality-control', [QualityControlController::class, 'index'])->name('quality_control.index');
Route::get('/quality-control/create', [QualityControlController::class, 'create'])->name('quality_control.create');
Route::post('/quality-control', [QualityControlController::class, 'store'])->name('quality_control.store');



Route::get('/daftar-ljk', [DaftarljkController::class, 'index'])->name('daftarljk.index');
Route::get('/daftar-ljk/{id}/edit', [DaftarljkController::class, 'edit'])->name('daftarljk.edit');
Route::post('/daftar-ljk/{id}/update', [DaftarljkController::class, 'update'])->name('daftarljk.update');
Route::get('/daftarljk', [DaftarljkController::class, 'index'])->name('daftarljk.index'); // Tampilkan daftar LJK
Route::get('/daftarljk/create', [DaftarljkController::class, 'create'])->name('daftarljk.create'); // Form tambah data
Route::post('/daftarljk', [DaftarljkController::class, 'store'])->name('daftarljk.store'); // Simpan data baru
Route::get('/daftarljk/{id}/edit', [DaftarljkController::class, 'edit'])->name('daftarljk.edit'); // Form edit data
Route::post('/daftarljk/{id}', [DaftarljkController::class, 'update'])->name('daftarljk.update'); // Update data
Route::delete('/daftarljk/{id}', [DaftarljkController::class, 'destroy'])->name('daftarljk.destroy'); // Hapus data
Route::get('/daftar-ljk', [DaftarljkController::class, 'index'])->name('daftarljk.index');
Route::get('/daftar-ljk', [DaftarljkController::class, 'index']);



Route::resource('kelembagaan', KelembagaanController::class);
Route::get('/kelembagaan', [KelembagaanController::class, 'index'])->name('kelembagaan.index');
Route::get('/kelembagaan', [KelembagaanController::class, 'index'])->name('kelembagaan');
Route::get('/kelembagaan', [KelembagaanController::class, 'index'])->name('kelembagaan.index');
Route::get('/list/lpbbti', [KelembagaanController::class, 'index']);
Route::get('/list/lpbbti', [KelembagaanController::class, 'index'])->name('list.lpbbti');
Route::get('/kelembagaan', [KelembagaanController::class, 'index'])->name('kelembagaan.index');
Route::get('/kelembagaan/{id}/edit', [KelembagaanController::class, 'edit'])->name('kelembagaan.edit');
Route::put('/kelembagaan/{id}', [KelembagaanController::class, 'update'])->name('kelembagaan.update');
Route::get('/kelembagaan/{id}/edit', [KelembagaanController::class, 'edit'])->name('kelembagaan.edit');
Route::put('/kelembagaan/{id}', [KelembagaanController::class, 'update'])->name('kelembagaan.update');
Route::get('/kelembagaan/{id}/edit', [KelembagaanController::class, 'edit'])->name('kelembagaan.edit');
Route::put('/kelembagaan/{id}', [KelembagaanController::class, 'update'])->name('kelembagaan.update');
Route::get('/kelembagaan/{id}/edit', [KelembagaanController::class, 'edit'])->name('kelembagaan.edit');
Route::put('/kelembagaan/{id}', [KelembagaanController::class, 'update'])->name('kelembagaan.update');
Route::post('perizinanpvml/kelembagaan', [KelembagaanController::class, 'store'])->name('kelembagaan.store');
Route::get('/kelembagaan/{id}/edit', [KelembagaanController::class, 'edit'])->name('kelembagaan.edit');



Route::prefix('rapat-pimpinan')->group(function () {
    Route::get('/', [ViewRapimController::class, 'index'])->name('rapat-pimpinan.index');
    Route::get('/create', [ViewRapimController::class, 'create'])->name('rapat-pimpinan.create');
    Route::post('/', [ViewRapimController::class, 'store'])->name('rapat-pimpinan.store');
});
Route::resource('rapim', RapimController::class);
Route::get('/rapat-pimpinan', [RapimController::class, 'index'])->name('view-rapat-pimpinan.index');  // Halaman daftar rapat
Route::get('/rapat-pimpinan/{id}/edit', [RapimController::class, 'edit'])->name('rapim.edit');  // Halaman edit rapat
Route::put('/rapat-pimpinan/{id}', [RapimController::class, 'update'])->name('rapim.update');  // Proses update rapat
Route::post('/rapat-pimpinan', [RapimController::class, 'store'])->name('rapim.store');  // Proses simpan rapat baru


Route::resource('pkk-agenda', PkkAgendaController::class);
Route::resource('penilaian-kemampuan', ViewPkkAgendaController::class); 
Route::get('agenda/view-penilaian-kemampuan', [ViewPkkAgendaController::class, 'index'])->name('view-penilaian-kemampuan.index');
Route::get('/penilaian-kemampuan', [ViewPkkAgendaController::class, 'create'])->name('penilaian-kemampuan.index');
Route::post('/penilaian-kemampuan', [ViewPkkAgendaController::class, 'store'])->name('penilaian-kemampuan.store');
Route::get('/pkk-agenda/{id}/edit', [PkkAgendaController::class, 'edit'])->name('pkk-agenda.edit');
Route::put('/pkk-agenda/{id}', [PkkAgendaController::class, 'update'])->name('pkk-agenda.update');
Route::get('/pkk-agenda', [PkkAgendaController::class, 'index'])->name('pkk-agenda.index');



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/chart-data', [DashboardController::class, 'getChartData']);
Route::get('/dashboard', [DashboardController::class, 'dashboard']);  // Pastikan ini mengarah ke metode dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//=================================================================================================


Route::put('/pkk-agenda/{pkk_agenda}', [PkkAgendaController::class, 'update'])->name('pkk-agenda.update');
Route::get('/dirkom', [DirkomController::class, 'index'])->name('dirkom.index');


// Group semua rute riksus dengan prefix dan name yang konsisten
Route::prefix('pengendaliankualitas')->group(function () {
    Route::resource('riksus', RiksusController::class);
    Route::get('get-companies', [RiksusController::class, 'getCompaniesByIndustry'])->name('riksus.companies');
});

// Rute untuk sosialisasi riksus
Route::prefix('agenda')->group(function () {
    Route::get('view-sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'index'])->name('view-sosialisasi-riksus.index');
    Route::resource('sosialisasi-riksus', SosialisasiRiksusController::class);
});