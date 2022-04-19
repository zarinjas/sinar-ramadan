<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use App\Models\Distribution;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class PenyaluranListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $distributions = Distribution::latest()->filters()->paginate(10);
        return [
            'distributions' => $distributions
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Penyaluran';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Penyaluran')
                ->icon('plus')
                ->route('platform.penyaluran.create'),
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
            Layout::table('distributions', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Distribution $distribution)
                {
                    return "<span class='text-muted'># {$distribution->id}</span>"; 
                }),

                TD::make('distribution_name', 'Nama Penyaluran'),

                TD::make('group_id', 'Daerah')
                    ->sort()
                    ->render(function (Distribution $distribution)
                    {
                        return $distribution->group->district;
                    }),

                TD::make('location', 'Lokasi'),

                TD::make('receiver', 'Penerima (Bil. Keluarga)'),

                TD::make('distribute_amount', 'Jumlah Penyaluran')
                    ->width(200)
                    ->render(function (Distribution $distribution) {
                        return 'RM ' . $distribution->distribute_amount;
                    }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Distribution $distribution) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.penyaluran.edit', $distribution->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $distribution->id,
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
        $distribution = Distribution::findOrFail($request->get('id'));

        $distribution->delete();

        Toast::info(__('Penyaluran dihapus'));

        return redirect()->route('platform.penyaluran.list');
    }
}
