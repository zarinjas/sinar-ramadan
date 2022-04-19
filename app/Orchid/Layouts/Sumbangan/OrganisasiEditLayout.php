<?php

namespace App\Orchid\Layouts\Sumbangan;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use App\View\Components\OrchidCustom\Image;
use Orchid\Screen\Fields\Picture;

class OrganisasiEditLayout extends Rows
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
            Input::make('credential.credential_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Nama'))
                ->placeholder(__('Nama Organisasi')),

            TextArea::make('credential.credential_description')
                ->type('text')
                ->title(__('Deskripsi'))
                ->placeholder(__('Deskripsi Organisasi')),

            Input::make('credential.api_key')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Secret Key'))
                ->placeholder(__('Secret Key Organisasi')),

            Input::make('credential.x_signature')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('X Signature'))
                ->placeholder(__('X Signature Organisasi')), 

            Picture::make('credential.credential_logo')
                ->title(__('Logo Organisasi'))
                ->width(150)
                ->height(150)
                ->targetId(),
        ];
    }
}
