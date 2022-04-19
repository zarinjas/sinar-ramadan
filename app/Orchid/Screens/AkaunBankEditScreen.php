<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use App\Models\Account;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;

class AkaunBankEditScreen extends Screen
{
    /**
     * @var Account
     */
    public $account;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Account $account): iterable
    {
        $account->with('group');
        return [
            'account' => $account
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->account->exists ? 'Ubah Akaun Bank' : 'Tambah Akaun Bank';
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
                ->canSee($this->account->exists),

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
                Input::make('account.account_bank')
                    ->title('Nama')
                    ->required()
                    ->placeholder(__('Nama Bank'))
                    ->horizontal(),

                Input::make('account.account_no')
                    ->title('No Akaun')
                    ->required()
                    ->placeholder(__('No Akaun Bank'))
                    ->horizontal(),

                Select::make('account.group_id')
                    ->fromModel(Group::class, 'group_name', 'id')
                    ->empty('Pilih Pengumpulan')
                    ->title(__('Pengumpulan'))
                    ->required()
                    ->horizontal(),
            ]),
        ];
    }

    /**
     * @param Account $account
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Account $account, Request $request)
    {
        $request->validate([
            'account.account_bank'       => 'required',
            'account.account_no'         => 'required|numeric',
            'account.group_id'           => 'required',
        ]);

        $account->fill($request->get('account'))->save();

        Toast::info(__('Akaun Bank berjaya disimpan'));

        return redirect()->route('platform.pengumpulan.account.list');
    }

    /**
     * @param Account $account
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Account $account)
    {
        $account->delete();

        Toast::info(__('Akaun Bank dihapus'));

        return redirect()->route('platform.pengumpulan.account.list');
    }
}
