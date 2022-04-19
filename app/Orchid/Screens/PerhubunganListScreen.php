<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use App\Models\Contact;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class PerhubunganListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $contacts = Contact::latest()->filters()->paginate(10);
        return [
            'contacts' => $contacts
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Contact';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Contact')
                ->icon('plus')
                ->route('platform.pengumpulan.contact.create'),
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
            Layout::table('contacts', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Contact $contact) {
                    return "<span class='text-muted'># {$contact->id}</span>"; 
                }),

                TD::make('contact_name', 'Nama'),

                TD::make('contact_no', 'No Tel'),

                TD::make('group_id', 'Pengumpulan')
                    ->sort()
                    ->render(function (Contact $contact)
                    {
                        return $contact->group->group_name;
                    }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Contact $contact) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.pengumpulan.contact.edit', $contact->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $contact->id,
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
        $contact = Contact::findOrFail($request->get('id'));

        $contact->delete();

        Toast::info(__('Pengumpulan dihapus'));

        return redirect()->route('platform.pengumpulan.contact.list');
    }
}
