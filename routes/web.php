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



// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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

// ===================================================================================
// Lembaga Keuangan Mikro
Route::get('/list/lembaga-keuangan-mikro', [ListController::class, 'lembagaKeuanganMikro'])->name('list.lembagaKeuanganMikro');

// LPBBTI
Route::get('/list/lpbbti', [ListController::class, 'lpbbti'])->name('list.lpbbti');

// Pergadaian
Route::get('/list/pergadaian', [ListController::class, 'pergadaian'])->name('list.pergadaian');

// Perusahaan Modal Ventura
Route::get('/list/perusahaan-modal-ventura', [ListController::class, 'perusahaanModalVentura'])->name('list.perusahaanModalVentura');

// Perusahaan Pembiayaan
Route::get('/list/perusahaan-pembiayaan', [ListController::class, 'perusahaanPembiayaan'])->name('list.perusahaanPembiayaan');

// Sue Generis
Route::get('/list/sue-generis', [ListController::class, 'sueGeneris'])->name('list.sueGeneris');

Route::get('/list/lpbbti', [KelembagaanController::class, 'index']);
Route::get('/list/lpbbti', [KelembagaanController::class, 'index'])->name('list.lpbbti');

Route::post('/kepengurusan/store', [PenilaianController::class, 'store'])->name('kepengurusan.store');
Route::get('/kepengurusan', [PenilaianController::class, 'index'])->name('kepengurusan');



// Menampilkan halaman utama dirkom
Route::get('perizinanpvml/dirkom', [DirkomController::class, 'index'])->name('dirkom');

// Menampilkan form untuk membuat dirkom baru
Route::get('perizinanpvml/dirkom/create', [DirkomController::class, 'create'])->name('dirkom.create');

// Menyimpan data dirkom
Route::post('perizinanpvml/dirkom', [DirkomController::class, 'store'])->name('dirkom.store');



// Menampilkan halaman utama dirkom
Route::get('perizinanpvml/tka', [TkaController::class, 'index'])->name('tka');

// Menampilkan form untuk membuat dirkom baru
Route::get('perizinanpvml/tka/create', [TkaController::class, 'create'])->name('tka.create');

// Menyimpan data dirkom
Route::post('perizinanpvml/tka', [TkaController::class, 'store'])->name('tka.store');



// Menampilkan halaman utama dirkom
Route::get('perizinanpvml/kelembagaan', [KelembagaanPvmlController::class, 'index'])->name('kelembagaan');

// Menampilkan form untuk membuat dirkom baru
Route::get('perizinanpvml/kelembagaan/create', [KelembagaanPvmlController::class, 'create'])->name('kelembagaan.create');

// Menyimpan data dirkom
Route::post('perizinanpvml/kelembagaan', [KelembagaanPvmlController::class, 'store'])->name('kelembagaan.store');

Route::post('perizinanpvml/kelembagaan', [KelembagaanController::class, 'store']);

Route::get('/kelembagaan', [KelembagaanPvmlController::class, 'index'])->name('kelembagaan.index');
Route::post('/kelembagaan', [KelembagaanPvmlController::class, 'store'])->name('kelembagaan.store');


Route::get('/pkk', [PkkController::class, 'index'])->name('pkk');
Route::post('/pkk/store', [PkkController::class, 'store'])->name('pkk.store');
Route::get('/pkk', [PkkController::class, 'index'])->name('pkk');
Route::post('/pkk/store', [PkkController::class, 'store'])->name('pkk.store');


Route::get('pengendaliankualitas/riksus', [RiksusController::class, 'index']);
Route::post('pengendaliankualitas/riksus', [RiksusController::class, 'store']);
Route::get('pengendaliankualitas/riksus/{id}', [RiksusController::class, 'show']);
Route::put('pengendaliankualitas/riksus/{id}', [RiksusController::class, 'update']);
Route::delete('pengendaliankualitas/riksus/{id}', [RiksusController::class, 'destroy']);
Route::resource('pengendaliankualitas/riksus', RiksusController::class);

Route::get('/riksus', [RiksusController::class, 'create'])->name('riksus');
Route::post('/riksus/store', [RiksusController::class, 'store'])->name('pengendaliankualitas.store');
Route::get('/riksus/create', [RiksusController::class, 'create'])->name('riksus.create');
Route::resource('riksus', RiksusController::class);
Route::get('/riksus', [RiksusController::class, 'index'])->name('riksus');




Route::get('/quality-control', [QualityControlController::class, 'index'])->name('quality_control.index');
Route::get('/quality-control/create', [QualityControlController::class, 'create'])->name('quality_control.create');
Route::post('/quality-control', [QualityControlController::class, 'store'])->name('quality_control.store');
Route::resource('quality_control', QualityControlController::class);



Route::resource('sosialisasi-riksus', SosialisasiRiksusController::class);




Route::resource('forum-panel', ForumPanelController::class);




Route::resource('rapim', RapimController::class);




Route::resource('pkk-agenda', PkkAgendaController::class);


// routes/web.php



Route::get('agenda/view-sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'index']);
Route::get('sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'show'])->name('sosialisasi-riksus');


// Pastikan nama route sesuai dengan yang Anda panggil di view
Route::get('agenda/view-sosialisasi-riksus', [ViewSosialisasiRiksusController::class, 'index'])->name('view-sosialisasi-riksus.index');
Route::resource('sosialisasi-riksus', SosialisasiRiksusController::class); // Menyertakan resource controller untuk sosialisasi-riksus



Route::resource('penilaian-kemampuan', ViewPkkAgendaController::class); 
Route::get('agenda/view-penilaian-kemampuan', [ViewPkkAgendaController::class, 'index'])->name('view-penilaian-kemampuan.index');
Route::get('/penilaian-kemampuan', [ViewPkkAgendaController::class, 'create'])->name('penilaian-kemampuan.index');
Route::post('/penilaian-kemampuan', [ViewPkkAgendaController::class, 'store'])->name('penilaian-kemampuan.store');




Route::prefix('rapat-pimpinan')->group(function () {
    Route::get('/', [ViewRapimController::class, 'index'])->name('rapat-pimpinan.index');
    Route::get('/create', [ViewRapimController::class, 'create'])->name('rapat-pimpinan.create');
    Route::post('/', [ViewRapimController::class, 'store'])->name('rapat-pimpinan.store');
});




// Menampilkan halaman forum panel
Route::get('/view-forum-panel', [ViewForumPanelController::class, 'index'])->name('forum-panel.index');

// Menampilkan halaman form untuk menambah forum panel
Route::get('/forum-panel/create', [ViewForumPanelController::class, 'create'])->name('forum-panel.create');

// Menyimpan data forum panel
Route::post('/forum-panel', [ViewForumPanelController::class, 'store'])->name('forum-panel.store');


Route::put('forum-panel/{id}', [ViewForumPanelController::class, 'update'])->name('forum-panel.update');




Route::get('/kepengurusan', [ViewPenilaianController::class, 'index'])->name('kepengurusan');
Route::get('/kepengurusan/create', [ViewPenilaianController::class, 'create'])->name('kepengurusan.create');
Route::post('/kepengurusan', [ViewPenilaianController::class, 'store'])->name('kepengurusan.store');
Route::get('/kepengurusan/{id}/edit', [ViewPenilaianController::class, 'edit'])->name('kepengurusan.edit');
Route::put('/kepengurusan/{id}', [ViewPenilaianController::class, 'update'])->name('kepengurusan.update');
// Route untuk halaman edit
Route::get('/kepengurusan/edit/{id}', [ViewPenilaianController::class, 'edit'])->name('kepengurusan.edit');

// Route untuk update data
Route::put('/kepengurusan/update/{id}', [ViewPenilaianController::class, 'update'])->name('kepengurusan.update');

Route::get('/kepengurusan', [PenilaianController::class, 'index'])->name('kepengurusan.index');








Route::get('/kepengurusan', [ViewPenilaianController::class, 'index'])->name('kepengurusan.index');





Route::get('/view-kelembagaan', [ViewKelembagaanPvmlController::class, 'index'])->name('view-kelembagaan.index');
Route::post('/view-kelembagaan', [ViewKelembagaanPvmlController::class, 'store'])->name('view-kelembagaan.store');
Route::get('/view-kelembagaan/{id}/edit', [ViewKelembagaanPvmlController::class, 'edit'])->name('view-kelembagaan.edit');
Route::post('/view-kelembagaan/{id}/update', [ViewKelembagaanPvmlController::class, 'update'])->name('view-kelembagaan.update');


Route::get('/kelembagaan', [ViewKelembagaanPvmlController::class, 'index'])->name('kelembagaan.index');
Route::get('/kelembagaan/create', [ViewKelembagaanPvmlController::class, 'create'])->name('kelembagaan.create');
Route::post('/kelembagaan/store', [ViewKelembagaanPvmlController::class, 'store'])->name('kelembagaan.store');
Route::resource('kelembagaan', KelembagaanController::class);
Route::get('/kelembagaan/{id}/edit', [KelembagaanController::class, 'edit'])->name('kelembagaan.edit');
Route::get('/kelembagaan/{id}/edit', [ViewKelembagaanPvmlController::class, 'edit'])->name('kelembagaan.edit');
Route::put('/kelembagaan/{id}', [ViewKelembagaanPvmlController::class, 'update'])->name('kelembagaan.update');




Route::get('/pkk', [PkkController::class, 'index'])->name('pkk'); // Halaman utama view
Route::get('/pkk/create', [PkkController::class, 'create'])->name('pkk.create'); // Halaman tambah data
Route::post('/pkk', [PkkController::class, 'store'])->name('pkk.store'); // Menyimpan data
Route::get('/pkk/{id}/edit', [PkkController::class, 'edit'])->name('pkk.edit'); // Halaman edit data
Route::put('/pkk/{id}', [PkkController::class, 'update'])->name('pkk.update'); // Update data





Route::get('/dirkom', [DirkomController::class, 'index'])->name('view-dirkom');
Route::get('/dirkom/create', [DirkomController::class, 'create'])->name('dirkom.create');
Route::post('/dirkom', [DirkomController::class, 'store'])->name('dirkom.store');
Route::get('/dirkom/{id}/edit', [DirkomController::class, 'edit'])->name('dirkom.edit');
Route::put('/dirkom/{id}', [DirkomController::class, 'update'])->name('dirkom.update');

Route::resource('dirkom', DirkomController::class);

Route::get('/view-dirkom', [DirkomController::class, 'index'])->name('view-dirkom');




Route::get('/tka', [TkaController::class, 'index'])->name('tka');
Route::get('/tka/create', [TkaController::class, 'create'])->name('tka.create');
Route::post('/tka/store', [TkaController::class, 'store'])->name('tka.store');
Route::get('/tka/edit/{id}', [TkaController::class, 'edit'])->name('tka.edit');
Route::post('/tka/update/{id}', [TkaController::class, 'update'])->name('tka.update');



Route::resource('quality_control', QualityControlController::class);


Route::get('/riksus', [RiksusController::class, 'index'])->name('riksus.index');
Route::get('/riksus/create', [RiksusController::class, 'create'])->name('riksus.create');
Route::post('/riksus', [RiksusController::class, 'store'])->name('riksus.store');
Route::get('/riksus/{id}/edit', [RiksusController::class, 'edit'])->name('riksus.edit');
Route::put('/riksus/{id}', [RiksusController::class, 'update'])->name('riksus.update');
Route::delete('/riksus/{id}', [RiksusController::class, 'destroy'])->name('riksus.destroy');


// Daftar Riksus
Route::get('/riksus', [RiksusController::class, 'index'])->name('riksus');


Route::resource('forum-panel', ForumPanelController::class);
Route::put('/forum-panel/{id}', [ForumPanelController::class, 'update'])->name('forum-panel.update');


Route::get('/sosialisasi-riksus/{id}/view', [SosialisasiRiksusController::class, 'show'])->name('sosialisasi-riksus.view');


Route::put('/pkk-agenda/{id}', [PkkAgendaController::class, 'update'])->name('pkk-agenda.update');
Route::get('/pkk-agenda', [PkkAgendaController::class, 'index'])->name('pkk-agenda.index');
Route::put('/pkk-agenda/{id}', [PkkAgendaController::class, 'update'])->name('pkk-agenda.update');




Route::get('/rapat-pimpinan', [RapimController::class, 'index'])->name('view-rapat-pimpinan.index');  // Halaman daftar rapat
Route::get('/rapat-pimpinan/{id}/edit', [RapimController::class, 'edit'])->name('rapim.edit');  // Halaman edit rapat
Route::put('/rapat-pimpinan/{id}', [RapimController::class, 'update'])->name('rapim.update');  // Proses update rapat
Route::post('/rapat-pimpinan', [RapimController::class, 'store'])->name('rapim.store');  // Proses simpan rapat baru



Route::get('/daftar-ljk', function () {
    return view('daftar-ljk');
});

Route::get('/daftar-ljk', [DaftarljkController::class, 'index']);