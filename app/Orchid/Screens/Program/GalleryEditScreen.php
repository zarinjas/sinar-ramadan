<?php

namespace App\Orchid\Screens\Program;

use App\Models\Gallery;
use App\Models\Program;
use Orchid\Screen\Screen;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;

class GalleryEditScreen extends Screen
{
    /**
     * @var Gallery
     */
    public $gallery;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Gallery $gallery): iterable
    {
        $gallery->with(['program', 'photos', 'videos']);
        return [
            'gallery'   => $gallery,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->gallery->exists ? 'Ubah Galeri' : 'Tambah Galeri';
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
                ->canSee($this->gallery->exists),

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
                Input::make('gallery.gallery_name')
                    ->title('Tajuk')
                    ->placeholder(__('Tajuk Galeri'))
                    ->horizontal(),

                TextArea::make('gallery.gallery_description')
                    ->type('text')
                    ->title(__('Deskripsi'))
                    ->placeholder(__('Deskripsi Galeri'))
                    ->horizontal(),

                Select::make('gallery.program_id')
                    ->fromModel(Program::class, 'program_title', 'id')
                    ->empty('Pilih Program')
                    ->title(__('Program'))
                    ->help('Pilih Program dihubungkan bersama galeri')
                    ->horizontal(),
            ]),

            Layout::rows([
                Upload::make('gallery.attachment')
                    ->title('Galeri Gambar')
                    ->multiple()
                    ->media()
                    ->groups('photos')
                    ->horizontal()
            ]),

            Layout::livewire('orchid-multiple-input')
            ->only('gallery'),
            
        ];
    }

    /**
     * @param Gallery $gallery
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Gallery $gallery, Request $request)
    {
        $request->validate([
            'gallery.gallery_name'             => 'required',
            'gallery.gallery_description'      => 'nullable',
            'gallery.program_id'               => ['nullable', Rule::unique(Gallery::class, 'program_id')->ignore($gallery)],
            'videos.*.video_name'              => 'required',
            'videos.*.youtube_id'              => 'required'
        ]);

        $gallery->fill($request->get('gallery'))->save();

        $gallery->attachment()->syncWithoutDetaching(
            $request->input('gallery.attachment', [])
        );

        if($request->videos) {
            if(count($request->videos) > 0) {
                foreach($request->videos as $key => $value) { 
                    $videos[] = [
                        'id'            => (isset($request->videos[$key]['id'])) ? $request->videos[$key]['id'] : null,
                        'video_name'    => $request->videos[$key]['video_name'],
                        'youtube_id'    => $request->videos[$key]['youtube_id'],
                        'gallery_id'    => $gallery->id,
                        'video_thumbnail' => $request->videos[$key]['video_thumbnail'],
                    ];
                }
                VideoGallery::upsert($videos, ['id'], ['video_name', 'youtube_id', 'gallery_id', 'video_thumbnail']);
            }
        }
    
        Toast::info(__('Galeri berjaya disimpan'));

        return redirect()->route('platform.program.galeri.list');
    }

    /**
     * @param Gallery $gallery
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Gallery $gallery)
    {
        $gallery->delete();

        Toast::info(__('Galeri dihapus'));

        return redirect()->route('platform.program.galeri.list');
    }
}
