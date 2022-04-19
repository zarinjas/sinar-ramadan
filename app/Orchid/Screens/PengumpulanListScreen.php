<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Facades\Config;

class PengumpulanListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $groups = Group::latest()->filters()->paginate(10);
        return [
            'groups' => $groups
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Pengumpulan';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Pengumpulan')
                ->icon('plus')
                ->route('platform.pengumpulan.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('groups', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Group $group) {
                    $url = Config::get('global.public_image_path') . "no-image-default.jpg";
                    
                    if(!empty($group->group_thumbnail)) {
                        $url = $group->thumbnail->relativeUrl;
                    }

                    return view('admin.orchid-custom.table-image', 
                    [
                        'url' => $url, 
                        'alt' => $group->group_name, 
                        'id' => $group->id
                    ]);
                }),

                TD::make('group_name', 'Nama Pengumpulan'),

                TD::make('group_url', 'Pautan'),

                TD::make('state', 'Negeri')
                    ->sort()
                    ->render(function (Group $group)
                    {
                        return $group->state->state_name;
                    }),

                TD::make('district', 'Daerah')
                    ->sort(),

                TD::make('show_in_homepage', 'Jenis Pengumpulan')
                    ->render(function (Group $group) {
                        return ($group->is_main) ? 'Pusat' : 'Negeri';
                    }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Group $group) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.pengumpulan.edit', $group->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $group->id,
                                ]),
                        ]);
                }),
            ])
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        $group = Group::findOrFail($request->get('id'));

        $group->delete();

        Toast::info(__('Pengumpulan dihapus'));

        return redirect()->route('platform.pengumpulan.list');
    }
}
