<?php

namespace App\Orchid\Screens\Program;

use Orchid\Screen\TD;
use App\Models\Gallery;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class GalleryListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $galleries = Gallery::latest()->filters()->paginate(10);
        return [
            'galleries'    => $galleries
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Galeri';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Galeri')
                ->icon('plus')
                ->route('platform.program.galeri.create'),
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
            Layout::table('galleries', [

                TD::make('id', 'ID')
                    ->width('150')
                    ->render(function (Gallery $gallery)
                    {
                        return "<span class='text-muted'># {$gallery->id}</span>"; 
                    }),

                TD::make('gallery_name', 'Galeri')
                    ->width('450'),

                TD::make('gallery_description', 'Deskripsi')
                ->render(function (Gallery $gallery) {
                    return Str::limit($gallery->gallery_description, 200);
                }),

                TD::make('program_id', 'Program')
                    ->render(function (Gallery $gallery) {
                        return $gallery->program->program_title;
                    }),

                TD::make()
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Gallery $gallery) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                    ->route('platform.program.galeri.edit', $gallery->id)
                                    ->icon('pencil'),

                                Button::make(__('Delete'))
                                    ->icon('trash')
                                    ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                    ->method('remove', [
                                        'id' => $gallery->id,
                                    ]),
                            ]);
                        })
            ]),
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        $gallery = Gallery::findOrFail($request->get('id'));

        $gallery->delete();

        Toast::info(__('Galeri dihapus'));

        return redirect()->route('platform.program.galeri.list');
    }
}
