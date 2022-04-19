<?php

namespace App\Orchid\Layouts\Sumbangan;

use App\Models\Billplz\Credential;
use App\View\Components\OrchidCustom\Image;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layout;

class SumbanganBillplzLayout extends Rows
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

            Input::make('collection.collection_title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Tajuk'))
                ->placeholder(__('Tajuk Sumbangan')),

            TextArea::make('collection.collection_description')
                ->type('text')
                ->required()
                ->title(__('Deskripsi'))
                ->placeholder(__('Deskripsi Sumbangan')),
        ];
    }
}
