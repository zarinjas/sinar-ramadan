<?php

namespace App\Orchid\Screens\Program;

use App\Models\Program;
use App\Models\Category;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Auth;

class ProgramEditScreen extends Screen
{
    /**
     * @var Program
     */
    public $program; 

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Program $program): iterable
    {
        $program->with(['category', 'author', 'galleries']);
        $user_id = Auth::id();
        return [
            'program' => $program,
            'user_id' => $user_id
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->program->exists ? 'Ubah Program' : 'Tambah Program';
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
                ->canSee($this->program->exists),

            Button::make(__('Draft'))
                ->icon('note')
                ->method('setDraft')
                ->canSee($this->program->exists),

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
                Input::make('program.program_title')
                    ->title('Tajuk')
                    ->horizontal(),

                Input::make('program.program_slug')
                    ->title('Slug')
                    ->horizontal(),

                Picture::make('program.thumbnail_id')
                    ->title(__('Thumbnail'))
                    ->targetId()
                    ->horizontal(),
            ])
            ->title('Detail Program'),

            Layout::rows([
                Quill::make('program.program_content')
                ->toolbar(["text", "color", "header", "list", "format", "media"])
                ->title('Konten Program')
            ]),

        ];
    }

    /**
     * @param Program $program
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Program $program, Request $request)
    {
        $request->validate([
            'program.program_title'             => 'required',
            'program.program_slug'              => ['required', 'max:50', Rule::unique(Program::class, 'program_slug')->ignore($program)],
            'program.thumbnail_id'              => 'nullable',
        ]);

        
        $program->fill($request->get('program'));

        if(is_null($program->user_id)) {
            $program->user_id = Auth::id();
        }
        $program->is_publish = true;
        $program->save();

        $program->attachment()->syncWithoutDetaching(
            $request->input('program.thumbnail_id', [])
        );

        $program->attachment()->syncWithoutDetaching(
            $request->input('program.attachment', [])
        );

        Toast::info(__('Program berjaya disimpan'));

        return redirect()->route('platform.program.list');
    }

    /**
     * @param Program $program
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Program $program)
    {
        $program->delete();

        Toast::info(__('Program dihapus'));

        return redirect()->route('platform.program.list');
    }

    /**
     * @param Program $program
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function setDraft(Program $program)
    {
        $program->is_publish = false;
        $program->save();

        Toast::info(__('Program di draft'));

        return redirect()->route('platform.program.list');
    }
}
