<?php

namespace App\Orchid\Screens\Program;

use Orchid\Screen\TD;
use App\Models\Program;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Facades\Config;

class ProgramListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $programs = Program::latest()->filters()->paginate(10);
        // $programs->with('category');
        return [
            'programs' => $programs
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Program';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Program')
                ->icon('plus')
                ->route('platform.program.create'),
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

            Layout::table('programs', [
                TD::make('id', 'ID')
                    ->width('150')
                    ->render(function (Program $program) {
                        $url = Config::get('global.public_image_path') . "no-image-default.jpg";
                    
                        if(!empty($program->thumbnail_id)) {
                            $url = $program->thumbnail->relativeUrl;
                        }

                        return view('admin.orchid-custom.table-image', 
                        [
                            'url' => $url, 
                            'alt' => $program->program_title, 
                            'id'  => $program->id
                        ]);
                    }),

                TD::make('program_title', 'Title')
                    ->width('450'),

                TD::make('author', 'Penulis')
                    ->render(function (Program $program) {
                        return $program->author->name;
                    }),

                TD::make('is_publish', 'Status')
                    ->render(function (Program $program) {
                        return ($program->is_publish) ? 'Publish' : 'Draft';
                    }),

                TD::make('created_at', 'Masa Terbitan')
                    ->render(function (Program $program) {
                        $date = date_create($program->created_at);
                        $paid_format = date_format($date, "j M Y (g:i A)");
                        return "<span>{$paid_format}</span>";
                    }),

                TD::make()
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Program $program) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                    ->route('platform.program.edit', $program->id)
                                    ->icon('pencil'),

                                Button::make(__('Delete'))
                                    ->icon('trash')
                                    ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                    ->method('remove', [
                                        'id' => $program->id,
                                    ]),
                            ]);
                }),
            ]),

        ];
    }

    /**
    * @param Request $request
    */
    public function remove(Request $request)
    {
        $program = Program::findOrFail($request->get('id'));

        $program->delete();

        Toast::info(__('Program dihapus'));

        return redirect()->route('platform.program.list');
    }
}
