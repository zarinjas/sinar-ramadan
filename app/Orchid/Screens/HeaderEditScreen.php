<?php

namespace App\Orchid\Screens;

use App\Models\Header;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;

class HeaderEditScreen extends Screen
{
    /**
     * @var Header
     */
    public $header;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Header $header): iterable
    {
        $header->with('thumbnail');
        return [
            'header'    => $header
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->header->exists ? 'Ubah Header' : 'Tambah Header';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->header->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            Layout::rows([
                Input::make('header.header_name')
                    ->title('Tajuk')
                    ->required()
                    ->placeholder(__('Tajuk Header'))
                    ->horizontal(),
                
                Input::make('header.header_url')
                    ->title('Pautan')
                    ->placeholder(__('Pautan Header'))
                    ->horizontal(),

                Picture::make('header.header_thumbnail')
                    ->title(__('Thumbnail'))
                    ->targetId()
                    ->horizontal(),
            ])
        ];
    }

    /**
     * @param Header $header
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Header $header, Request $request)
    {
        $request->validate([
            'header.header_name'         => 'required',
            'header.header_url'          => 'nullable',
        ]);

        $header->fill($request->get('header'))->save();

        $header->attachment()->syncWithoutDetaching(
            $request->input('header.header_thumbnail', [])
        );

        Toast::info(__('Header berjaya disimpan'));

        return redirect()->route('platform.layout.header.list');
    }

    /**
     * @param Header $header
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Header $header)
    {
        $header->delete();

        Toast::info(__('Header dihapus'));

        return redirect()->route('platform.layout.header.list');
    }
}
