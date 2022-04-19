<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use App\Models\Header;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Facades\Config;

class HeaderListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $headers = Header::latest()->filters()->paginate(10);
        return [
            'headers' => $headers
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Header';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Header')
                ->icon('plus')
                ->route('platform.layout.header.create'),
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
            Layout::table('headers', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Header $header) {
                    $url = Config::get('global.public_image_path') . "no-image-default.jpg";
                    
                    if(!empty($header->header_thumbnail)) {
                        $url = $header->thumbnail->relativeUrl;
                    }

                    return view('admin.orchid-custom.table-image', 
                    [
                        'url' => $url, 
                        'alt' => $header->header_name, 
                        'id' => $header->id
                    ]);
                }),

                TD::make('header_name', 'Header')
                ->sort(),

                TD::make('header_url', 'Pautan'),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Header $header) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.layout.header.edit', $header->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $header->id,
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
        $header = Header::findOrFail($request->get('id'));

        $header->delete();

        Toast::info(__('Header dihapus'));

        return redirect()->route('platform.layout.header.list');
    }
}
