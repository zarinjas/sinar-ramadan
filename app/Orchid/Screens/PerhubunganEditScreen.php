<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use App\Models\Contact;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;

class PerhubunganEditScreen extends Screen
{
    /**
     * @var Contact
     */
    public $contact;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Contact $contact): iterable
    {
        $contact->with('group');
        return [
            'contact' => $contact
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->contact->exists ? 'Ubah Contact' : 'Tambah Contact';
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
                ->canSee($this->contact->exists),

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
                Input::make('contact.contact_name')
                    ->title('Nama')
                    ->required()
                    ->placeholder(__('Nama Contact'))
                    ->horizontal(),

                Input::make('contact.contact_no')
                    ->title('No Contact')
                    ->required()
                    ->placeholder(__('No Tel Contact'))
                    ->horizontal(),

                Select::make('contact.group_id')
                    ->fromModel(Group::class, 'group_name', 'id')
                    ->empty('Pilih Pengumpulan')
                    ->title(__('Pengumpulan'))
                    ->required()
                    ->horizontal(),
            ]),
        ];
    }

    /**
     * @param Contact $contact
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Contact $contact, Request $request)
    {
        $request->validate([
            'contact.contact_name'       => 'required',
            'contact.contact_no'         => 'required',
            'contact.group_id'           => 'required',
        ]);

        $contact->fill($request->get('contact'))->save();

        Toast::info(__('Contact berjaya disimpan'));

        return redirect()->route('platform.pengumpulan.contact.list');
    }

    /**
     * @param Contact $contact
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Contact $contact)
    {
        $contact->delete();

        Toast::info(__('Contact dihapus'));

        return redirect()->route('platform.pengumpulan.contact.list');
    }
}
