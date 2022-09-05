<?php

use App\Http\Controllers\{BeritaController, WelcomeController, HomeController, InformasiController, KuisionerController, TentangController, ShopController, ArtikelController};
use App\Http\Controllers\Admin\{DashboardController, HomeController as AdminHomeController, TentangController as AdminTentangController, KategoriController as AdminKategoriController, BeritaController as AdminBeritaController, InformasiController as AdminInformasiController, KuisionerController as AdminKuisionerController, ArtikelController as AdminArtikelController, ShopController as AdminShopController, SettingController as AdminSettingController};
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

//user
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi');
Route::get('/tentang-kami', [TentangController::class, 'index'])->name('tentang-kami');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/tahun/{tahun}', [BeritaController::class, 'tahun'])->name('berita-tahun');
Route::get('/berita/{id}/{slug}', [BeritaController::class, 'show'])->name('berita-show');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/tahun/{tahun}', [ArtikelController::class, 'tahun'])->name('artikel-tahun');
Route::get('/artikel/{id}/{slug}', [ArtikelController::class, 'show'])->name('artikel-show');


Route::get('/kuisioner', [KuisionerController::class, 'index'])->name('kuisioner');
Route::post('/kuisioner/create', [KuisionerController::class, 'create'])->name('kuisioner.create');
Route::post('/kuisioner/store', [KuisionerController::class, 'store'])->name('kuisioner.store');


Route::get('/shop', [ShopController::class, 'index'])->name('shop');



//admin
Auth::routes();

Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::post('/create', [HomeController::class, 'store'])->name('store');

Route::get('/admin/hero', [AdminHomeController::class, 'index'])->name('admin.hero');
Route::put('/admin/hero/update', [AdminHomeController::class, 'store'])->name('admin.hero.store');

Route::get('/admin/lingkup', [AdminHomeController::class, 'lingkup'])->name('admin.lingkup');
Route::post('/admin/lingkup/store', [AdminHomeController::class, 'lingkup_store'])->name('admin.lingkup.store');
Route::put('/admin/lingkup/update', [AdminHomeController::class, 'lingkup_update'])->name('admin.lingkup.update');
Route::put('/admin/lingkup_gambar/update', [AdminHomeController::class, 'lingkup_gambar_update'])->name('admin.lingkup_gambar.update');

Route::get('/admin/nilai', [AdminHomeController::class, 'nilai'])->name('admin.nilai');
Route::post('/admin/nilai/store', [AdminHomeController::class, 'nilai_store'])->name('admin.nilai.store');
Route::put('/admin/nilai/update', [AdminHomeController::class, 'nilai_update'])->name('admin.nilai.update');
Route::put('/admin/nilai_gambar/update', [AdminHomeController::class, 'nilai_gambar_update'])->name('admin.nilai_gambar.update');

Route::get('/admin/tentang-kami', [AdminTentangController::class, 'index'])->name('admin.tentang-kami');
Route::put('/admin/tentang-kami/update', [AdminTentangController::class, 'update'])->name('admin.tentang-kami.update');
Route::put('/admin/tentang-kami/visimisi/update', [AdminTentangController::class, 'visimisi_update'])->name('admin.visimisi.update');

Route::get('/admin/tentang-kami/layanan', [AdminTentangController::class, 'layanan'])->name('admin.tentang-kami.layanan');
Route::post('/admin/tentang-kami/layanan/point/store', [AdminTentangController::class, 'point_store'])->name('admin.tentang-kami.layanan.point.store');
Route::put('/admin/tentang-kami/layanan/layanan/update', [AdminTentangController::class, 'layanan_update'])->name('admin.tentang-kami.layanan.update');
Route::put('/admin/tentang-kami/layanan/point/update', [AdminTentangController::class, 'point_update'])->name('admin.tentang-kami.layanan.point.update');
Route::post('/admin/tentang-kami/layanan/point/delete', [AdminTentangController::class, 'point_destroy'])->name('admin.tentang-kami.layanan.point.delete');

Route::get('/admin/kategori', [AdminKategoriController::class, 'index'])->name('admin.kategori');
Route::put('/admin/kategori/update', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');

Route::get('/admin/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');
Route::post('/admin/berita/store', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
Route::post('/admin/berita/destroy', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');
Route::put('/admin/berita/update', [AdminBeritaController::class, 'update'])->name('admin.berita.update');

Route::get('/admin/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel');
Route::post('/admin/artikel/store', [AdminArtikelController::class, 'store'])->name('admin.artikel.store');
Route::post('/admin/artikel/destroy', [AdminArtikelController::class, 'destroy'])->name('admin.artikel.destroy');
Route::put('/admin/artikel/update', [AdminArtikelController::class, 'update'])->name('admin.artikel.update');

Route::get('/admin/shop', [AdminShopController::class, 'index'])->name('admin.shop');
Route::post('/admin/shop/store', [AdminShopController::class, 'store'])->name('admin.shop.store');
Route::post('/admin/shop/destroy', [AdminShopController::class, 'destroy'])->name('admin.shop.destroy');
Route::put('/admin/shop/update', [AdminShopController::class, 'update'])->name('admin.shop.update');

Route::get('/admin/kuisioner/', [AdminKuisionerController::class, 'index'])->name('admin.kuisioner');
Route::get('/admin/kuisioner/show/{id}', [AdminKuisionerController::class, 'index_params'])->name('admin.kuisionerparams');
Route::post('/admin/kuisioner/store', [AdminKuisionerController::class, 'store'])->name('admin.kuisioner.store');
Route::post('/admin/kuisioner/destroy', [AdminKuisionerController::class, 'destroy'])->name('admin.kuisioner.destroy');
Route::put('/admin/kuisioner/update', [AdminKuisionerController::class, 'update'])->name('admin.kuisioner.update');

Route::get('/admin/kuisioner/kategori', [AdminKuisionerController::class, 'kategori_index'])->name('admin.kuisioner.kategori');
Route::post('/admin/kuisioner/kategori/store', [AdminKuisionerController::class, 'kategori_store'])->name('admin.kuisioner.kategori.store');
Route::post('/admin/kuisioner/kategori/destroy', [AdminKuisionerController::class, 'kategori_destroy'])->name('admin.kuisioner.kategori.destroy');
Route::put('/admin/kuisioner/kategori/update', [AdminKuisionerController::class, 'kategori_update'])->name('admin.kuisioner.kategori.update');

Route::get('/admin/kuisioner/subkategori', [AdminKuisionerController::class, 'subkategori_index'])->name('admin.kuisioner.subkategori');
Route::post('/admin/kuisioner/subkategori/store', [AdminKuisionerController::class, 'subkategori_store'])->name('admin.kuisioner.subkategori.store');
Route::post('/admin/kuisioner/subkategori/destroy', [AdminKuisionerController::class, 'subkategori_destroy'])->name('admin.kuisioner.subkategori.destroy');
Route::put('/admin/kuisioner/subkategori/update', [AdminKuisionerController::class, 'subkategori_update'])->name('admin.kuisioner.subkategori.update');

Route::get('/admin/kuisioner/pilihan/{id}', [AdminKuisionerController::class, 'pilihan_index'])->name('admin.kuisioner.pilihan');
Route::post('/admin/kuisioner/pilihan/store', [AdminKuisionerController::class, 'pilihan_store'])->name('admin.kuisioner.pilihan.store');
Route::post('/admin/kuisioner/pilihan/destroy', [AdminKuisionerController::class, 'pilihan_destroy'])->name('admin.kuisioner.pilihan.destroy');
Route::put('/admin/kuisioner/pilihan/update', [AdminKuisionerController::class, 'pilihan_update'])->name('admin.kuisioner.pilihan.update');

Route::get('/admin/kuisioner/hasil/kategori/', [AdminKuisionerController::class, 'hasil_kategori_index'])->name('admin.hasil.kategori');
Route::post('/admin/kuisioner/hasil/kategori/store', [AdminKuisionerController::class, 'hasil_kategori_store'])->name('admin.hasil.kategori.store');
Route::post('/admin/kuisioner/hasil/kategori/destroy', [AdminKuisionerController::class, 'hasil_kategori_destroy'])->name('admin.hasil.kategori.destroy');
Route::put('/admin/kuisioner/hasil/kategori/update', [AdminKuisionerController::class, 'hasil_kategori_update'])->name('admin.hasil.kategori.update');

Route::get('/admin/kuisioner/hasil/kuisioner/', [AdminKuisionerController::class, 'hasil_kuisioner_index'])->name('admin.hasil.kuisioner');
Route::get('/admin/kuisioner/hasil/kuisioner/show/{id}', [AdminKuisionerController::class, 'hasil_kuisioner_per_index'])->name('admin.hasil.kuisioner.per');
Route::post('/admin/kuisioner/hasil/kusioner/destroy', [AdminKuisionerController::class, 'hasil_kuisioner_destroy'])->name('admin.hasil.kuisioner.destroy');


Route::get('/admin/setting/', [AdminSettingController::class, 'index'])->name('admin.setting');
Route::put('/admin/setting/update', [AdminSettingController::class, 'update'])->name('admin.setting.update');

Route::get('/admin/informasi/{id}', [AdminInformasiController::class, 'show'])->name('admin.informasi');
Route::put('/admin/informasi/update', [AdminInformasiController::class, 'update'])->name('admin.informasi.update');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
