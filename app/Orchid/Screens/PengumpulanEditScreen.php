<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use App\Models\State;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class PengumpulanEditScreen extends Screen
{
    /**
     * @var Group
     */
    public $group; 

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Group $group): iterable
    {
        return [
            'group' => $group
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->group->exists ? 'Ubah Pengumpulan' : 'Tambah Pengumpulan';
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
                ->canSee($this->group->exists),

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
                Input::make('group.group_name')
                    ->title('Nama')
                    ->required()
                    ->placeholder(__('Nama Pengumpulan'))
                    ->horizontal(),

                Input::make('group.group_url')
                    ->title('Url')
                    ->placeholder(__('Url Pengumpulan'))
                    ->horizontal(),

                Select::make('group.state_id')
                    ->fromModel(State::class, 'state_name', 'id')
                    ->empty('Pilih Negeri')
                    ->title(__('Negeri'))
                    ->required()
                    ->horizontal(),

                Input::make('group.district')
                    ->title('Daerah')
                    ->required()
                    ->placeholder(__('Daerah Pengumpulan'))
                    ->horizontal(),

                TextArea::make('group.address')
                    ->type('text')
                    ->title(__('Alamat'))
                    ->placeholder(__('Alamat Pengumpulan'))
                    ->horizontal(),

                CheckBox::make('group.is_main')
                    ->sendTrueOrFalse()
                    ->title('Jenis Pengumpulan')
                    ->placeholder('Pengumpulan Utama')
                    ->help('Tandakan jika pengumpulan dari pengumpulan Abim Pusat')
                    ->horizontal(),
                
                Picture::make('group.group_thumbnail')
                    ->title(__('Thumbnail'))
                    ->targetId()
                    ->horizontal(),
            ]),
        ];
    }

    /**
     * @param Group $group
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Group $group, Request $request)
    {
        $request->validate([
            'group.group_name'         => 'required',
            'group.group_url'          => 'nullable|url',
            'group.state_id'           => 'nullable',
            'group.district'           => 'required|max:120',
            'group.address'            => 'nullable|max:500'
        ]);

        $group->fill($request->get('group'))->save();

        $group->attachment()->syncWithoutDetaching(
            $request->input('group.group_thumbnail', [])
        );

        Toast::info(__('Pengumpulan berjaya disimpan'));

        return redirect()->route('platform.pengumpulan.list');
    }

    /**
     * @param Group $group
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Group $group)
    {
        $group->delete();

        Toast::info(__('Pengumpulan dihapus'));

        return redirect()->route('platform.pengumpulan.list');
    }
}
