<?php

declare(strict_types=1);

use App\Orchid\Screens\AkaunBankEditScreen;
use App\Orchid\Screens\AkaunBankListScreen;
use App\Orchid\Screens\BukuEditScreen;
use App\Orchid\Screens\BukuListScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\HeaderEditScreen;
use App\Orchid\Screens\HeaderListScreen;
use App\Orchid\Screens\PengumpulanEditScreen;
use App\Orchid\Screens\PengumpulanListScreen;
use App\Orchid\Screens\PenyaluranEditScreen;
use App\Orchid\Screens\PenyaluranListScreen;
use App\Orchid\Screens\PerhubunganEditScreen;
use App\Orchid\Screens\PerhubunganListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Program\GalleryEditScreen;
use App\Orchid\Screens\Program\GalleryListScreen;
use App\Orchid\Screens\Program\KategoriEditScreen;
use App\Orchid\Screens\Program\KategoriListScreen;
use App\Orchid\Screens\Program\ProgramEditScreen;
use App\Orchid\Screens\Program\ProgramListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Sumbangan\DoaPenyumbangListScreen;
use App\Orchid\Screens\Sumbangan\OrganisasiEditScreen;
use App\Orchid\Screens\Sumbangan\OrganisasiListScreen;
use App\Orchid\Screens\Sumbangan\PenyumbangListScreen;
use App\Orchid\Screens\Sumbangan\SumbanganEditScreen;
use App\Orchid\Screens\Sumbangan\SumbanganIndexScreen;
use App\Orchid\Screens\Sumbangan\SumbanganListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
// Route::screen('example', ExampleScreen::class)
//     ->name('platform.example')
//     ->breadcrumbs(function (Trail $trail) {
//         return $trail
//             ->parent('platform.index')
//             ->push('Example screen');
//     });

// Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
// Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
// Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
// Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
// Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
// Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');
Route::group(['prefix' => 'sumbangan', 'as' => 'platform.'], function() {

    // Sumbangan
    Route::screen('/', SumbanganIndexScreen::class)
        ->name('sumbangan.index')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__('Sumbangan'), route('platform.sumbangan.index'));
        });

    Route::screen('semua', SumbanganListScreen::class)
        ->name('sumbangan.list')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.sumbangan.index')
                ->push(__('Sumbangan'), route('platform.sumbangan.list'));
        });

    Route::screen('/create', SumbanganEditScreen::class)
        ->name('sumbangan.create')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.sumbangan.index')
                ->push(__('Tambah Sumbangan'), route('platform.sumbangan.create'));
        });

    Route::screen('/{sumbangan}/edit', SumbanganEditScreen::class)
        ->name('sumbangan.edit')
        ->breadcrumbs(function (Trail $trail, $collection) {
            return $trail
                ->parent('platform.sumbangan.index')
                ->push(__('Ubah Sumbangan'), route('platform.sumbangan.edit', $collection));
        });


    // Organisasi
    Route::screen('organisasi', OrganisasiListScreen::class)
        ->name('sumbangan.organisasi.list')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.sumbangan.index')
                ->push(__('Organisasi'), route('platform.sumbangan.organisasi.list'));
        });

    Route::screen('organisasi/create', OrganisasiEditScreen::class)
        ->name('sumbangan.organisasi.create')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.sumbangan.organisasi.list')
                ->push(__('Tambah Organisasi'), route('platform.sumbangan.organisasi.create'));
        });

    Route::screen('/organisasi/{organisasi}/edit', OrganisasiEditScreen::class)
        ->name('sumbangan.organisasi.edit')
        ->breadcrumbs(function (Trail $trail, $credential) {
            return $trail
                ->parent('platform.sumbangan.organisasi.list')
                ->push(__('Ubah Sumbangan'), route('platform.sumbangan.organisasi.edit', $credential));
        });

    // Penyumbang
    // Route::screen('penyumbang', PenyumbangListScreen::class)
    //     ->name('sumbangan.penyumbang.list')
    //     ->breadcrumbs(function (Trail $trail) {
    //         return $trail
    //             ->parent('platform.sumbangan.index')
    //             ->push(__('Penyumbang'), route('platform.sumbangan.penyumbang.list'));
    //     });
    
    // Doa penyumbang
    Route::screen('doa-penyumbang', DoaPenyumbangListScreen::class)
        ->name('sumbangan.doa-penyumbang.list')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.sumbangan.index')
                ->push(__('Doa Penyumbang'), route('platform.sumbangan.doa-penyumbang.list'));
        });
});


//program
Route::group(['prefix' => 'program', 'as' => 'platform.'], function() {

    // Program
    Route::screen('semua', ProgramListScreen::class)
        ->name('program.list')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.index')
                ->push(__('Program'), route('platform.program.list'));
        });

    Route::screen('/create', ProgramEditScreen::class)
        ->name('program.create')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.program.list')
                ->push(__('Tambah Program'), route('platform.program.create'));
        });

    Route::screen('/{program}/edit', ProgramEditScreen::class)
        ->name('program.edit')
        ->breadcrumbs(function (Trail $trail, $program) {
            return $trail
                ->parent('platform.program.list')
                ->push(__('Ubah Program'), route('platform.program.edit', $program));
        });

    // Galeri
    Route::screen('galeri', GalleryListScreen::class)
        ->name('program.galeri.list')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.program.list')
                ->push(__('Galeri Program'), route('platform.program.galeri.list'));
        });

    Route::screen('galeri/create', GalleryEditScreen::class)
        ->name('program.galeri.create')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->parent('platform.program.galeri.list')
                ->push(__('Tambah Galeri Program'), route('platform.program.galeri.create'));
        });

    Route::screen('galeri/{galeri}/edit', GalleryEditScreen::class)
        ->name('program.galeri.edit')
        ->breadcrumbs(function (Trail $trail, $gallery) {
            return $trail
                ->parent('platform.program.galeri.list')
                ->push(__('Ubah Galeri Program'), route('platform.program.galeri.edit', $gallery));
        });

});

// Pengumpulan
Route::screen('pengumpulan', PengumpulanListScreen::class)
    ->name('platform.pengumpulan.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Pengumpulan'), route('platform.pengumpulan.list'));
    });

Route::screen('pengumpulan/create', PengumpulanEditScreen::class)
    ->name('platform.pengumpulan.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.pengumpulan.list')
            ->push(__('Tambah Pengumpulan'), route('platform.pengumpulan.create'));
    });

Route::screen('pengumpulan/{group}/edit', PengumpulanEditScreen::class)
    ->name('platform.pengumpulan.edit')
    ->breadcrumbs(function (Trail $trail, $group) {
        return $trail
            ->parent('platform.pengumpulan.list')
            ->push(__('Ubah Pengumpulan'), route('platform.pengumpulan.edit', $group));
    });

// Akaun Bank
Route::screen('pengumpulan/account', AkaunBankListScreen::class)
    ->name('platform.pengumpulan.account.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.pengumpulan.list')
            ->push(__('Akaun Bank'), route('platform.pengumpulan.account.list'));
    });

Route::screen('pengumpulan/account/create', AkaunBankEditScreen::class)
    ->name('platform.pengumpulan.account.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.pengumpulan.account.list')
            ->push(__('Tambah Akaun Bank'), route('platform.pengumpulan.account.create'));
    });

Route::screen('pengumpulan/account/{account}/edit', AkaunBankEditScreen::class)
    ->name('platform.pengumpulan.account.edit')
    ->breadcrumbs(function (Trail $trail, $account) {
        return $trail
            ->parent('platform.pengumpulan.account.list')
            ->push(__('Ubah Akaun Bank'), route('platform.pengumpulan.account.edit', $account));
    });

// Perhubungan
Route::screen('pengumpulan/contact', PerhubunganListScreen::class)
    ->name('platform.pengumpulan.contact.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.pengumpulan.list')
            ->push(__('Contact'), route('platform.pengumpulan.contact.list'));
    });

Route::screen('pengumpulan/contact/create', PerhubunganEditScreen::class)
    ->name('platform.pengumpulan.contact.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.pengumpulan.contact.list')
            ->push(__('Tambah Contact'), route('platform.pengumpulan.contact.create'));
    });

Route::screen('pengumpulan/contact/{contact}/edit', PerhubunganEditScreen::class)
    ->name('platform.pengumpulan.contact.edit')
    ->breadcrumbs(function (Trail $trail, $contact) {
        return $trail
            ->parent('platform.pengumpulan.contact.list')
            ->push(__('Ubah Contact'), route('platform.pengumpulan.contact.edit', $contact));
    });

Route::screen('penyumbang', PenyumbangListScreen::class)
    ->name('platform.penyumbang.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Penyumbang'), route('platform.penyumbang.list'));
    });

// Penyaluran
Route::screen('penyaluran', PenyaluranListScreen::class)
    ->name('platform.penyaluran.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Penyaluran'), route('platform.penyaluran.list'));
    });

Route::screen('penyaluran/create', PenyaluranEditScreen::class)
    ->name('platform.penyaluran.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.penyaluran.list')
            ->push(__('Tambah Penyaluran'), route('platform.penyaluran.create'));
    });

Route::screen('penyaluran/{distribution}/edit', PenyaluranEditScreen::class)
    ->name('platform.penyaluran.edit')
    ->breadcrumbs(function (Trail $trail, $distribution) {
        return $trail
            ->parent('platform.penyaluran.list')
            ->push(__('Ubah Penyaluran'), route('platform.penyaluran.edit', $distribution));
    });

// Buku
Route::screen('buku', BukuListScreen::class)
->name('platform.buku.list')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(__('Buku'), route('platform.buku.list'));
});

Route::screen('buku/create', BukuEditScreen::class)
->name('platform.buku.create')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.buku.list')
        ->push(__('Tambah Buku'), route('platform.buku.create'));
});

Route::screen('buku/{book}/edit', BukuEditScreen::class)
->name('platform.buku.edit')
->breadcrumbs(function (Trail $trail, $book) {
    return $trail
        ->parent('platform.buku.list')
        ->push(__('Ubah Buku'), route('platform.buku.edit', $book));
});

// Category Buku
Route::screen('buku/kategori', KategoriListScreen::class)
->name('platform.buku.kategori.list')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.buku.list')
        ->push(__('Kategori Buku'), route('platform.buku.kategori.list'));
});

Route::screen('buku/kategori/create', KategoriEditScreen::class)
->name('platform.buku.kategori.create')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.buku.kategori.list')
        ->push(__('Tambah Kategori Buku'), route('platform.buku.kategori.create'));
});

Route::screen('buku/kategori/{kategori}/edit', KategoriEditScreen::class)
->name('platform.buku.kategori.edit')
->breadcrumbs(function (Trail $trail, $category) {
    return $trail
        ->parent('platform.buku.kategori.list')
        ->push(__('Ubah Kategori Buku'), route('platform.buku.kategori.edit', $category));
});

//Layout
Route::group(['prefix' => 'layout', 'as' => 'platform.'], function() {
    // Header
    Route::screen('header', HeaderListScreen::class)
    ->name('layout.header.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Header'), route('platform.layout.header.list'));
    });

    Route::screen('header/create', HeaderEditScreen::class)
    ->name('layout.header.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.layout.header.list')
            ->push(__('Tambah Header'), route('platform.layout.header.create'));
    });

    Route::screen('header/{header}/edit', HeaderEditScreen::class)
    ->name('layout.header.edit')
    ->breadcrumbs(function (Trail $trail, $header) {
        return $trail
            ->parent('platform.layout.header.list')
            ->push(__('Ubah Header'), route('platform.layout.header.edit', $header));
    });
});