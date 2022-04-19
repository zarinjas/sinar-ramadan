<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Support\Color;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Actions\Menu;
use Orchid\Platform\ItemPermission;
use Orchid\Screen\Actions\DropDown;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Program')
                ->title('Utama')
                ->icon('star')
                ->list([
                    Menu::make('Galeri')->icon('picture')->route('platform.program.galeri.list'),
                ])
                ->route('platform.program.list'),

            // Menu::make('Sumbangan')
            //     ->icon('money')
            //     ->list([
            //         Menu::make('Semua Sumbangan')->icon('list')->route('platform.sumbangan.list'),
            //         Menu::make('Organisasi')->icon('organization')->route('platform.sumbangan.organisasi.list'),
            //         Menu::make('Penyumbang')->icon('heart')->route('platform.sumbangan.penyumbang.list'),
            //         Menu::make('Doa-doa Penyumbang')->icon('speech')->route('platform.sumbangan.doa-penyumbang.list'),
            //     ])
            //     ->route('platform.sumbangan.index'),

            Menu::make('Pengumpulan')
                ->icon('pointer')
                ->list([
                    Menu::make('Akaun Bank')->icon('browser')->route('platform.pengumpulan.account.list'),
                    Menu::make('Contact')->icon('phone')->route('platform.pengumpulan.contact.list'),
                ])
                ->route('platform.pengumpulan.list'),
            
            Menu::make('Penyumbang')
                ->icon('heart')
                ->route('platform.penyumbang.list'),

            Menu::make('Penyaluran')
                ->icon('present')
                ->route('platform.penyaluran.list'),

            Menu::make('Buku')
                ->icon('book-open')
                ->route('platform.buku.list')
                ->list([
                    Menu::make('Kategori Buku')->icon('bag')->route('platform.buku.kategori.list'),
                ])
                ->divider(),

            Menu::make('Layout')
                ->title('Customize')
                ->icon('layers')
                ->list([
                    Menu::make('Header')
                        ->icon('screen-desktop')
                        ->route('platform.layout.header.list'),
                ]),
            
            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
