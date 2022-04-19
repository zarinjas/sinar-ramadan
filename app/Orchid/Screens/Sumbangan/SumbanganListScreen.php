<?php

namespace App\Orchid\Screens\Sumbangan;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Models\Billplz\Collection;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class SumbanganListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $collections = Collection::latest()->filters()->paginate(10);

        return [
            'collections' => $collections,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Sumbangan';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Link::make('Tambah Sumbangan')
                ->icon('plus')
                ->route('platform.sumbangan.create'),

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

            Layout::table('collections', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Collection $collection) {
                    return view('admin.orchid-custom.table-image', 
                    [
                        'url' => $collection->avatar_url, 
                        'alt' => $collection->collection_title, 
                        'id' => $collection->id
                    ]);
                }),

                TD::make('collection_title', 'Tajuk')
                ->width('300')
                ->sort()
                ->render(function (Collection $collection)
                {
                    return "<span class=''>{$collection->collection_title}</span>";
                }),

                TD::make('collection_description', 'Deskripsi')
                ->render(function (Collection $collection) {
                    return Str::limit($collection->collection_description, 200);
                }),

                TD::make('billplz_collection_id', 'ID Billplz')
                ->width('150')
                ->filter(TD::FILTER_TEXT),

                TD::make('Organisasi')
                ->width('150')
                ->filter(TD::FILTER_TEXT)
                ->render(function (Collection $collection) {
                    return $collection->credential->credential_name;
                }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Collection $collection) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.sumbangan.edit', $collection->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $collection->id,
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
        $collection = Collection::findOrFail($request->get('id'));

        $collection->delete();

        Toast::info(__('Sumbangan dihapus'));

        return redirect()->route('platform.sumbangan.list');
    }
}
