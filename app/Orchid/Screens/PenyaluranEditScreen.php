<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use Orchid\Screen\Screen;
use App\Models\Distribution;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class PenyaluranEditScreen extends Screen
{
    /**
     * @var Distribution
     */
    public $distribution; 

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Distribution $distribution): iterable
    {
        return [
            'distribution' => $distribution
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->distribution->exists ? 'Ubah Penyaluran' : 'Tambah Penyaluran';
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
                ->canSee($this->distribution->exists),

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
                Input::make('distribution.distribution_name')
                    ->title('Nama')
                    ->required()
                    ->placeholder(__('Nama Penyaluran'))
                    ->horizontal(),

                Select::make('distribution.group_id')
                    ->fromModel(Group::class, 'district', 'id')
                    ->empty('Pilih Daerah')
                    ->title(__('Daerah'))
                    ->required()
                    ->horizontal(),

                TextArea::make('distribution.location')
                    ->type('text')
                    ->title(__('Lokasi'))
                    ->placeholder(__('Lokasi Penyaluran'))
                    ->horizontal(),

                Input::make('distribution.receiver')
                    ->title('Jumlah Penerima')
                    ->placeholder(__('Jumlah Penerima Penyaluran'))
                    ->horizontal(),

                Input::make('distribution.distribute_amount')
                    ->title('Jumlah')
                    ->placeholder(__('Jumlah Penyaluran'))
                    ->horizontal(),
            ]),
        ];
    }

    /**
     * @param Distribution $distribution
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Distribution $distribution, Request $request)
    {
        $request->validate([
            'distribution.distribution_name'  => 'required',
            'distribution.group_id'           => ['required', 'exists:groups,id'],
            'distribution.location'           => 'nullable|max:200',
            'distribution.receiver'           => 'nullable|integer',
            'distribution.distribute_amount'  => 'nullable|numeric'
        ]);

        $distribution->fill($request->get('distribution'))->save();

        Toast::info(__('Penyaluran berjaya disimpan'));

        return redirect()->route('platform.penyaluran.list');
    }

    /**
     * @param Distribution $distribution
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Distribution $distribution)
    {
        $distribution->delete();

        Toast::info(__('Penyaluran dihapus'));

        return redirect()->route('platform.penyaluran.list');
    }
}
