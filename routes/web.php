<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CbtController;
use App\Http\Controllers\MataPelajaran;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BankSoalController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\RuangDiskusiController;
use App\Http\Controllers\MataPelajaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route(
        Auth::check() ? 'dashboard' : 'login'
    );
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi');
    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');

    Route::get('/ruangdiskusi', [RuangDiskusiController::class, 'index'])->name('ruangdiskusi');
    Route::post('/ruangdiskusi/store', [RuangDiskusiController::class, 'store'])->name('ruangdiskusi.store');
    Route::get('/ruangdiskusi/{ruangdiskusi}', [RuangDiskusiController::class, 'show'])->name('ruangdiskusi.show');
    Route::post('/ruangdiskusi/{id}/comment', [RuangDiskusiController::class, 'comment'])->name('ruangdiskusi.comment');
});

Route::prefix('masterdata')->middleware(['auth'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::resource('tahun-ajaran', TahunAjaranController::class)->except(['show']);
        Route::resource('semester', SemesterController::class)->except(['show']);
        Route::get('kelas', [KelasController::class, 'index'])->name('kelas');
        Route::post('kelas/store', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('kelas/edit/{kelas}', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('kelas/update/{kelas}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('kelas/destroy/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');
        Route::resource('pengajar', PengajarController::class);

        Route::resource('mapel', MataPelajaranController::class, ['except' => ['show', 'create']]);
    });
    Route::resource('siswa', SiswaController::class, ['except' => ['show']])->middleware('pengajar');
    Route::resource('user', UserController::class);
});

Route::prefix('report')->middleware(['auth'])->group(function () {
    Route::get('presensi/data', [PresensiController::class, 'dataList'])->name('presensi.data');
    Route::get('presensi/{id}/detail', [PresensiController::class, 'dataShow'])->name('presensi.detail');

    Route::get('siswa/nilai', [SiswaController::class, 'dataNilai'])->name('siswa.dataNilai');
    Route::get('siswa/{id}/nilai', [SiswaController::class, 'detailNilai'])->name('siswa.detailNilai');
});

Route::prefix('mod')->middleware(['auth'])->group(function () {
    Route::get('/', [CbtController::class, 'index'])->name('mod');
    Route::get('/exam/{id}', [CbtController::class, 'soal'])->name('mod.soal');
    Route::post('/exam/{id}/simpan', [CbtController::class, 'simpanJawaban'])->name('mod.simpan');
    Route::get('/exam/{id}/update/{status}', [CbtController::class, 'updateUjian'])->name('mod.update');

    Route::get('/{id}/hasil', [CbtController::class, 'hasil'])->name('mod.hasil');
});

Route::prefix('cbt')->middleware(['auth', 'pengajar'])->group(function () {
    Route::get('/banksoal', [BankSoalController::class, 'index'])->name('banksoal');
    Route::get('/banksoal/create', [BankSoalController::class, 'create'])->name('banksoal.create');
    Route::post('/banksoal/store', [BankSoalController::class, 'store'])->name('banksoal.store');
    Route::get('/banksoal/{id}/edit', [BankSoalController::class, 'edit'])->name('banksoal.edit');
    Route::put('/banksoal/{id}/update', [BankSoalController::class, 'update'])->name('banksoal.update');
    Route::delete('/banksoal/{id}/destroy', [BankSoalController::class, 'destroy'])->name('banksoal.destroy');

    Route::get('/banksoal/{id}/soal', [SoalController::class, 'soal'])->name('banksoal.soal');
    Route::get('/banksoal/{id}/soal/create', [SoalController::class, 'create'])->name('banksoal.soal.create');
    Route::post('/banksoal/{id}/soal/store', [SoalController::class, 'store'])->name('banksoal.soal.store');
    Route::get('/banksoal/soal/edit/{id}', [SoalController::class, 'edit'])->name('banksoal.soal.edit');
    Route::put('/banksoal/soal/{id}/update', [SoalController::class, 'update'])->name('banksoal.soal.update');
    Route::delete('/banksoal/soal/destroy/{id}', [SoalController::class, 'destroy'])->name('banksoal.soal.destroy');
    Route::get('/banksoal/soal/{id}/nilai', [SoalController::class, 'nilai'])->name('banksoal.soal.nilai');
    Route::get('/banksoal/{quiz}/soal/{id}/update', [SoalController::class, 'nilaiUpdate'])->name('banksoal.soal.update.nilai');
});


Route::get('setting/production', function () {
    Artisan::call('storage:link');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    return redirect()->back()->with('success', 'Setting Production Success');
});
