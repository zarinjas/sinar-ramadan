<?php

namespace App\Orchid\Screens\Sumbangan;

use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Models\Billplz\Credential;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Sumbangan\OrganisasiEditLayout;


class OrganisasiEditScreen extends Screen
{
    /**
     * @var Credential
     */
    public $credential;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Credential $credential): iterable
    {
        $credential->load(['collections', 'bills']);
        return [
            'credential'    => $credential,
            'url'           => $credential->logo->relativeUrl,
            'alt'           => $credential->credential_name
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->credential->exists ? 'Ubah Organisasi' : 'Tambah Organisasi';
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
                ->canSee($this->credential->exists),

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
            Layout::block(OrganisasiEditLayout::class)
                ->title(__('Informasi Billplz'))
                ->description(__('Masukkan informasi daripada Account Billplz.</br>
                Rujukan: 
                <a target="_blank" href="https://help.billplz.com/article/54-how-to-get-the-billplz-secret-key">
                    https://help.billplz.com/article/54-how-to-get-the-billplz-secret-key
                </a>'))
                ->commands([
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save'),
                ]),
        ];
    }

    /**
     * @param Credential $credential
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Credential $credential, Request $request)
    {
        $request->validate([
            'credential.credential_name'        => ['required', 'max:50', Rule::unique(Credential::class, 'credential_name')->ignore($credential)],
            'credential.credential_description' => 'max:500',
            'credential.api_key'                => 'required',
            'credential.x_signature'            => 'required',
        ]);

        $credential->fill($request->get('credential'))->save();

        $credential->attachment()->syncWithoutDetaching(
            $request->input('credential.credential_logo', [])
        );

        if(!isset($credential['id'])) {
            dd('test');
            Toast::info(__('Organisasi disimpan'));
        }
        Toast::info(__('Organisasi diubah'));

        return redirect()->route('platform.sumbangan.organisasi.list');
    }

    /**
     * @param Credential $credential
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Credential $credential)
    {
        $credential->delete();

        Toast::info(__('Organisasi dihapus'));

        return redirect()->route('platform.sumbangan.organisasi.list');
    }
}
