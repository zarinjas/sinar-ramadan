<?php

namespace App\Orchid\Screens\Sumbangan;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Models\Billplz\Credential;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Facades\Config;

class OrganisasiListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $credentials = Credential::latest()->filters()->paginate(10);
        
        return [
            'credentials' => $credentials
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Organisasi';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Organisasi')
                ->icon('plus')
                ->route('platform.sumbangan.organisasi.create'),
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
            Layout::table('credentials', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Credential $credential) {
                    $url = Config::get('global.public_image_path') . "no-image-default.jpg";
                    
                    if(!empty($credential->credential_logo)) {
                        $url = $credential->logo->relativeUrl;
                    }

                    return view('admin.orchid-custom.table-image', 
                    [
                        'url' => $url, 
                        'alt' => $credential->credential_name, 
                        'id' => $credential->id
                    ]);
                }),

                TD::make('credential_name', 'Nama Organisasi')
                ->width('200')
                ->filter(),

                TD::make('credential_description', 'Deskripsi')
                ->width('350')
                ->filter(),

                TD::make('Credentials')
                    ->render(function (Credential $credential) {
                        return "<span>API: {$credential->api_key}</span></br>
                                <span>X Signature: {$credential->x_signature}</span>";
                    }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Credential $credential) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.sumbangan.organisasi.edit', $credential->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $credential->id,
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
        $collection = Credential::findOrFail($request->get('id'));

        $collection->delete();

        Toast::info(__('Sumbangan dihapus'));

        return redirect()->route('platform.sumbangan.organisasi.list');
    }
}
