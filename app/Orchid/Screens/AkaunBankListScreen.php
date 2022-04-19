<?php

namespace App\Orchid\Screens;

use Orchid\Screen\TD;
use App\Models\Account;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class AkaunBankListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $accounts = Account::latest()->filters()->paginate(10);
        return [
            'accounts' => $accounts
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Akaun Bank';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Akaun Bank')
                ->icon('plus')
                ->route('platform.pengumpulan.account.create'),
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
            Layout::table('accounts', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Account $account) {
                    return "<span class='text-muted'># {$account->id}</span>"; 
                }),

                TD::make('account_bank', 'Bank'),

                TD::make('account_no', 'No Account'),

                TD::make('group_id', 'Pengumpulan')
                    ->sort()
                    ->render(function (Account $account)
                    {
                        return $account->group->group_name;
                    }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Account $account) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.pengumpulan.account.edit', $account->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $account->id,
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
        $account = Account::findOrFail($request->get('id'));

        $account->delete();

        Toast::info(__('Pengumpulan dihapus'));

        return redirect()->route('platform.pengumpulan.account.list');
    }
}
