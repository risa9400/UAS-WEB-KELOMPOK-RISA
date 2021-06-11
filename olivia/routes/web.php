<?php

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

//route admin
Route::group(['middleware' => ['auth', 'checkRole:1']],function() {
    Route::prefix('admin')->group(function () {
        Route::get('logout', 'Admin\AdminPageController@logout');
        Route::get('akun', 'Admin\AkunController@index');
        Route::post('akun', 'Admin\AkunController@update');
        Route::get('/', 'Admin\AdminPageController@dashboard')->name('dashboard');
        Route::get('berita', 'Admin\AdminPageController@berita')->name('berita');
        Route::get('artikel', 'Admin\AdminPageController@artikel')->name('artikel');
        Route::get('sejarah', 'Admin\AdminPageController@sejarah')->name('sejarah');
        //slider
        Route::prefix('slider')->group(function () {
            Route::get('/', 'Admin\Home\SliderController@index');
            Route::get('data', 'Admin\Home\SliderController@getSliderDataTable');
            Route::post('/', 'Admin\Home\SliderController@store');
            Route::get('datatable', 'Admin\Home\SliderController@loadDataTable');
            Route::get('edit/{id}', 'Admin\Home\SliderController@edit');
            Route::post('update/{id}', 'Admin\Home\SliderController@update');
            Route::get('delete/{id}', 'Admin\Home\SliderController@destroy');
        });
        //info grafis
        Route::prefix('infografis')->group(function () {
            Route::get('/', 'Admin\Home\GrafisController@index');
            Route::get('data', 'Admin\Home\GrafisController@getGrafisDataTable');
            Route::post('/', 'Admin\Home\GrafisController@store');
            Route::get('datatable', 'Admin\Home\GrafisController@loadDataTable');
            Route::get('edit/{id}', 'Admin\Home\GrafisController@edit');
            Route::post('update/{id}', 'Admin\Home\GrafisController@update');
            Route::get('delete/{id}', 'Admin\Home\GrafisController@destroy');
        });
        //berita
        Route::prefix('berita')->group(function () {
            Route::get('data', 'Admin\Home\BeritaController@getBeritaDataTable');
            Route::post('/', 'Admin\Home\BeritaController@store');
            Route::get('datatable', 'Admin\Home\BeritaController@loadDataTable');
            Route::get('edit/{id}', 'Admin\Home\BeritaController@edit');
            Route::post('update/{id}', 'Admin\Home\BeritaController@update');
            Route::get('delete/{id}', 'Admin\Home\BeritaController@destroy');
        });
        //lomba
        Route::prefix('lomba')->group(function () {
            Route::get('/', 'Admin\Home\LombaController@index');
            Route::get('data', 'Admin\Home\LombaController@getLombaDataTable');
            Route::get('datatable', 'Admin\Home\LombaController@loadDataTable');
            Route::post('/', 'Admin\Home\LombaController@store');
            Route::get('edit/{id}', 'Admin\Home\LombaController@edit');
            Route::post('update/{id}', 'Admin\Home\LombaController@update');
            Route::get('delete/{id}', 'Admin\Home\LombaController@destroy');
        });
        //artikel
        Route::prefix('artikel')->group(function () {
            Route::get('/', 'Admin\Home\ArtikelController@index');
            Route::get('data', 'Admin\Home\ArtikelController@getArtikelDataTable');
            Route::get('datatable', 'Admin\Home\BeritaController@loadDataTable');
            // Route::post('/', 'Admin\Home\AdminAHome\rtikelController@store');
            // Route::get('edit/{id}', 'Admin\AdminArtikelController@edit');
            // Route::post('update/{id}', 'Admin\AdminArtikelController@update');
            // Route::get('delete/{id}', 'Admin\AdminArtikelController@destroy');
        });

         //Pengumuman
         Route::prefix('pengumuman')->group(function () {
            Route::get('/', 'Admin\AdminPageController@pengumuman');
            Route::get('data', 'Admin\Home\PengumumanController@getPengumumanDataTable');
            Route::get('datatable', 'Admin\Home\PengumumanController@loadDataTable');
            Route::post('/', 'Admin\Home\PengumumanController@store');
            Route::get('edit/{id}', 'Admin\Home\PengumumanController@edit');
            Route::post('update/{id}', 'Admin\Home\PengumumanController@update');
            Route::get('delete/{id}', 'Admin\Home\PengumumanController@destroy');
        });

        //Sejarah
        Route::prefix('sejarah')->group(function () {
            Route::get('/', 'Admin\AdminPageController@sejarah');
            Route::get('data', 'Admin\Profil\SejarahController@getSejarahDataTable');
            Route::get('datatable', 'Admin\Profil\SejarahController@loadDataTable');
            Route::post('/', 'Admin\Profil\SejarahController@store');
            Route::get('edit/{id}', 'Admin\Profil\SejarahController@edit');
            Route::post('update/{id}', 'Admin\Profil\SejarahController@update');
            Route::get('delete/{id}', 'Admin\Profil\SejarahController@destroy');
            Route::get('aktif/{id}', 'Admin\Profil\SejarahController@aktifkan');
            Route::get('nonaktif/{id}', 'Admin\Profil\SejarahController@nonAktifkan');
        });
        

        //STRUKTUR ORGANISASI
        Route::prefix('struktur')->group(function () {
            Route::get('/', 'Admin\AdminPageController@struktur');
            Route::get('data', 'Admin\Profil\StrukturController@getStrukturDataTable');
            Route::get('datatable', 'Admin\Profil\StrukturController@loadDataTable');
            Route::post('/', 'Admin\Profil\StrukturController@store');
            Route::get('edit/{id}', 'Admin\Profil\StrukturController@edit');
            Route::post('update/{id}', 'Admin\Profil\StrukturController@update');
            Route::get('delete/{id}', 'Admin\Profil\StrukturController@destroy');
        });
        //info struktur
        Route::prefix('info-struktur')->group(function () {
            Route::get('/', 'Admin\AdminPageController@infoStruktur');
            Route::get('data', 'Admin\Profil\InfoStrukturController@getInfoStrukturDataTable');
            Route::get('datatable', 'Admin\Profil\InfoStrukturController@loadDataTable');
            Route::post('/', 'Admin\Profil\InfoStrukturController@store');
            Route::get('edit/{id}', 'Admin\Profil\InfoStrukturController@edit');
            Route::post('update/{id}', 'Admin\Profil\InfoStrukturController@update');
            Route::get('delete/{id}', 'Admin\Profil\InfoStrukturController@destroy');
        });
         //VISI DAN MISI
         Route::prefix('visimisi')->group(function () {
            Route::get('/', 'Admin\AdminPageController@visimisi');
            Route::get('data', 'Admin\Profil\visimisiController@getVisimisiDataTable');
            Route::get('datatable', 'Admin\Profil\visimisiController@loadDataTable');
            Route::post('/', 'Admin\Profil\visimisiController@store');
            Route::get('edit/{id}', 'Admin\Profil\visimisiController@edit');
            Route::post('update/{id}', 'Admin\Profil\visimisiController@update');
            Route::get('delete/{id}', 'Admin\Profil\visimisiController@destroy');
            Route::get('aktif/{id}', 'Admin\Profil\visimisiController@aktifkan');
            Route::get('nonaktif/{id}', 'Admin\Profil\visimisiController@nonAktifkan');
        });
        //TUGAS DAN Fungsi
        Route::prefix('tugasfungsi')->group(function () {
            Route::get('/', 'Admin\AdminPageController@tugasfungsi');
            Route::get('data', 'Admin\Profil\TugasFungsiController@getTugasFungsiDataTable');
            Route::get('datatable', 'Admin\Profil\TugasFungsiController@loadDataTable');
            Route::post('/', 'Admin\Profil\TugasFungsiController@store');
            Route::get('edit/{id}', 'Admin\Profil\TugasFungsiController@edit');
            Route::post('update/{id}', 'Admin\Profil\TugasFungsiController@update');
            Route::get('delete/{id}', 'Admin\Profil\TugasFungsiController@destroy');
            Route::get('aktif/{id}', 'Admin\Profil\TugasFungsiController@aktifkan');
            Route::get('nonaktif/{id}', 'Admin\Profil\TugasFungsiController@nonAktifkan');
        });
        //Foto
        Route::prefix('foto')->group(function () {
            Route::get('/', 'Admin\Galeri\FotoController@index');
            Route::get('data', 'Admin\Galeri\FotoController@getFotoDataTable');
            Route::get('datatable', 'Admin\Galeri\FotoController@loadDataTable');
            Route::post('/', 'Admin\Galeri\FotoController@store');
            Route::get('edit/{id}', 'Admin\Galeri\FotoController@edit');
            Route::post('update/{id}', 'Admin\Galeri\FotoController@update');
            Route::get('delete/{id}', 'Admin\Galeri\FotoController@destroy');
        });
        //VIDEO
        Route::prefix('video')->group(function () {
            Route::get('/', 'Admin\AdminPageController@video');
            Route::get('data', 'Admin\Galeri\VideoController@getVideoDataTable');
            Route::get('datatable', 'Admin\Galeri\VideoController@loadDataTable');
            Route::post('/', 'Admin\Galeri\VideoController@store');
            Route::get('edit/{id}', 'Admin\Galeri\VideoController@edit');
            Route::post('update/{id}', 'Admin\Galeri\VideoController@update');
            Route::get('delete/{id}', 'Admin\Galeri\VideoController@destroy');
        });
         //Pertanyaan User(other Question)
        Route::prefix('tanya')->group(function () {
            Route::get('/', 'Admin\AdminPageController@pertanyaan');
            Route::get('data', 'Admin\Footer\PertanyaanUserController@getAllPertanyaan');
            Route::get('datatable', 'Admin\Footer\PertanyaanUserController@loadDataTable');
            Route::post('kirim', 'Admin\Footer\PertanyaanUserController@jawabPertanyaan');
            Route::get('show/{id}', 'Admin\Footer\PertanyaanUserController@show');
            Route::get('tes', function() {
                // dd(session('email'));
                $data = session('email');
                dd($data['pertanyaan']);
                return session('email');
            });
            // Route::post('update/{id}', 'Admin\AdminArtikelController@update');
            // Route::get('delete/{id}', 'Admin\AdminArtikelController@destroy');
        });
        //FAQ
        Route::prefix('faq')->group(function () {
            Route::get('/', 'Admin\AdminPageController@faq');
            Route::get('data', 'Admin\Footer\FaqController@getFAQDataTable');
            Route::get('datatable', 'Admin\Footer\FaqController@loadDataTable');
            Route::post('/', 'Admin\Footer\FaqController@store');
            Route::get('edit/{id}', 'Admin\Footer\FaqController@edit');
            Route::post('update/{id}', 'Admin\Footer\FaqController@update');
            Route::get('delete/{id}', 'Admin\Footer\FaqController@destroy');
        });
         //SOCIAL MEDIA
         Route::prefix('sosialmedia')->group(function () {
            Route::get('/', 'Admin\AdminPageController@socialmedia');
            Route::get('data', 'Admin\Footer\socialmediaController@getSocialDataTable');
            Route::get('datatable', 'Admin\Footer\socialmediaController@loadDataTable');
            Route::post('/', 'Admin\Footer\socialmediaController@store');
            Route::get('edit/{id}', 'Admin\Footer\socialmediaController@edit');
            Route::post('update/{id}', 'Admin\Footer\socialmediaController@update');
            Route::get('delete/{id}', 'Admin\Footer\socialmediaController@destroy');
        });
    });
    
});

//Route guest
Route::get('/', 'User\UserPageController@index')->name('home');
Route::prefix('profile')->group(function () {
    Route::get('/', 'User\UserProfileController@index')->name('profile');
    Route::get('get-sejarah', 'User\UserProfileController@getSejarah');
});
Route::prefix('berita')->group(function () {
    Route::get('/', 'User\UserBeritaController@index')->name('berita');
    Route::get('{id}', 'User\UserBeritaController@show');
});
Route::get('pengumuman', 'User\UserPengumumanController@pengumuman')->name('pengumuman');
Route::get('pengumuman/{id}', 'User\UserPengumumanController@show');
Route::prefix('galeri')->group(function () {
    Route::get('/', 'User\UserGaleriController@index')->name('galeri');
    // Route::get('show', 'User\UserGaleriController@getFoto');
});
Route::get('video', 'User\UserGaleriController@video')->name('video');
//foto
Route::prefix('faq')->group(function () {
    Route::get('/', 'User\UserPageController@faq')->name('faq');
    Route::get('show', 'User\UserFAQController@getFAQ');
    Route::post('kirim', 'User\UserFAQController@store');
});

//route level user
Route::group(['middleware' => ['auth', 'checkRole:2', 'verified']],function() {
    Route::prefix('user')->group(function () {
        Route::get('/', 'User\AkunController@index');
        Route::post('/', 'User\AkunController@simpanDataPeserta');
        Route::get('data', 'User\AkunController@getDataPeserta');
        Route::get('lomba', 'User\AkunController@getDataLomba');
        Route::post('berkas', 'User\AkunController@storeBerkas');
    });
});

Route::post('daftar', 'Auth\RegisterController@create');

Route::get('search', 'User\UserPageController@search');

Route::get('tes', function () {
    return view('tes');
});

Route::get('coba', 'CobaController@coba');

Auth::routes();

Auth::routes(['verify' => true]);
  
Route::get('/home', 'HomeController@index')->name('home');

Route::any('/{all}', function(){
    return view('error404');
})->where('all', '.*');
