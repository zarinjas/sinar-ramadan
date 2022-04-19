<?php

namespace App\Orchid\Layouts\Program;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\TextArea;

class KategoriEditLayout extends Rows
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
            Input::make('category.category_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Nama Kategori'))
                ->placeholder(__('Masukkan Nama Kategori')),

            Input::make('category.category_slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Slug Kategori'))
                ->placeholder(__('Masukkan Slug Kategori')),

            TextArea::make('category.category_description')
                ->type('text')
                ->title(__('Deskripsi'))
                ->placeholder(__('Deskripsi Kategori')),
        ];
    }
}
