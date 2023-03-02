<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DaftarUlangController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KesehatanController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranPemasukanController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PesantrenController;
use App\Http\Controllers\PresensiPegawaiController;
use App\Http\Controllers\PresensiSantriAsramaController;
use App\Http\Controllers\PresensiSantriKelasController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RekapLaporanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiPembayaranController;
use App\Http\Controllers\WaliSantriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('beranda');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('verifikasi-pembayaran/{id}', [BerandaController::class, 'verifikasiPembayaran'])->name('verifikasi-pembayaran');
    Route::post('/mark-as-read', [BerandaController::class, 'markNotification'])->name('markNotification');

    // Route::get('notifications', [BerandaController::class, 'notifications'])->name('verifikasi-pembayaran');
    Route::post('save-verifikasi-pembayaran', [BerandaController::class, 'saveVerifikasiPembayaran'])->name('save-verifikasi-pembayaran');
    Route::post('update-verifikasi-pembayaran', [BerandaController::class, 'updateVerifikasiPembayaran'])->name('update-verifikasi-pembayaran');

    Route::prefix('setting')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('pesantren',PesantrenController::class);
    });

    Route::prefix('manajemen-santri')->group(function () {
        Route::resource('santri',SantriController::class);
        Route::resource('walisantri',WaliSantriController::class);
        Route::resource('kesehatan',KesehatanController::class);
        Route::resource('prestasi',PrestasiController::class);
        Route::resource('ekstrakurikuler',EkstrakurikulerController::class);
        Route::resource('perizinan',PerizinanController::class);
        Route::resource('pelanggaran',PelanggaranController::class);
        Route::resource('presensi-santri-asrama',PresensiSantriAsramaController::class);
        Route::prefix('presensi-santri-asrama')->group(function () {
            Route::post('search', [PresensiSantriAsramaController::class, 'search'])->name('presensi-santri-asrama-search');
        });

    });

    Route::prefix('manajemen-pegawai')->group(function () {
        Route::resource('pegawai',PegawaiController::class);
        Route::resource('presensi-pegawai',PresensiPegawaiController::class);
        Route::prefix('presensi-pegawai')->group(function () {
            Route::post('search', [PresensiPegawaiController::class, 'search'])->name('presensi-pegawai-search');
        });
    });

    Route::prefix('manajemen-akademik')->group(function () {
        Route::resource('guru', GuruController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('mata-pelajaran', MataPelajaranController::class);
        Route::resource('nilai', NilaiController::class);
        Route::prefix('nilai')->group(function () {
            Route::post('search', [NilaiController::class, 'search'])->name('nilai-search');
        });
        Route::resource('presensi-santri-kelas', PresensiSantriKelasController::class);
        Route::prefix('presensi-santri-kelas')->group(function () {
            Route::post('search', [PresensiSantriKelasController::class, 'search'])->name('presensi-santri-kelas-search');
        });
    });

    Route::prefix('manajemen-keuangan')->group(function () {
        Route::resource('pembayaran', PembayaranController::class);
        Route::resource('pengeluaran-pemasukan', PengeluaranPemasukanController::class);
        Route::prefix('pengeluaran-pemasukan')->group(function () {
        });

        Route::controller(PengeluaranPemasukanController::class)->group(function (){
            Route::get('create-pemasukan', 'createPemasukan')->name('pengeluaran-pemasukan.create-pemasukan');
            Route::post('save-pemasukan', 'storePemasukan')->name('pengeluaran-pemasukan.save-pemasukan');
            Route::get('create-pengeluaran', 'createPengeluaran')->name('pengeluaran-pemasukan.create-pengeluaran');
        });

        Route::resource('daftar-ulang', DaftarUlangController::class);
        Route::controller(DaftarUlangController::class)->group(function (){
            Route::get('daftar-ulang-walisantri', 'indexWalisantri')->name('daftar-ulang-walisantri.index');
        });
        Route::resource('infaq', InfaqController::class);
        Route::resource('spp', SppController::class);
        Route::controller(SppController::class)->group(function (){
            Route::get('spp-walisantri', 'indexWalisantri')->name('spp-walisantri.index');
            Route::get('get-ajax-nominal-from-santri/{id}', 'getAjaxNominalFromSantri')->name('get-ajax-nominal-from-santri');
        });
        Route::resource('verifikasi-pembayaran', VerifikasiPembayaranController::class);
        Route::resource('tagihan', TagihanController::class);
        Route::prefix('rekap-laporan')->group(function () {
            Route::post('search', [RekapLaporanController::class, 'search'])->name('rekap-laporan-search');
        });
        Route::resource('rekap-laporan', RekapLaporanController::class);

    });

    Route::prefix('pembayaran')->group(function () {
        Route::get('tagihan-daftar-ulang', [TagihanController::class, 'daftarUlang'])->name('tagihan-daftar-ulang.index');
        Route::get('tagihan-spp', [TagihanController::class, 'spp'])->name('tagihan-spp.index');
        // Route::post('infaq', [RekapLaporanController::class, 'daftarUlang'])->name('tagihan-daftar-ulang');
    });

});

require __DIR__.'/auth.php';
