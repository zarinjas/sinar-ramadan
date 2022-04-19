<?php

namespace App\Orchid\Layouts\Sumbangan;

use Orchid\Screen\Field;
use Orchid\Screen\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use App\Models\Billplz\Credential;
use Orchid\Screen\Fields\Relation;
use App\View\Components\OrchidCustom\Image;

class SumbanganEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('collection.billplz_collection_id')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('ID Sumbangan'))
                ->placeholder(__('Masukkan ID Sumbangan')),

            Select::make('collection.credential_id')
                ->fromModel(Credential::class, 'credential_name', 'id')
                ->empty('Pilih Organisasi')
                ->title(__('Organisasi'))
                ->help('Jika tiada Organisasi pilihan. Sila tambah dahulu di Sumbangan / Organisasi'),
        ];
    }
}
