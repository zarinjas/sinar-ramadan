<?php

namespace App\Orchid\Screens\Program;

use App\Models\Category;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Program\KategoriEditLayout;

class KategoriEditScreen extends Screen
{
    /**
     * @var Category
     */
    public $category; 

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $category->with('program');

        return [
            'category'  => $category
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Ubah Kategori' : 'Tambah Kategori';
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
                ->canSee($this->category->exists),

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
            Layout::block(KategoriEditLayout::class)
                ->title(__('Kategori'))
                ->description(__('Informasi kategori'))
                ->commands([
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save'),
                ]),
        ];
    }

     /**
     * @param Category $category
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Category $category, Request $request)
    {
        $request->validate([
            'category.category_name'            => 'required',
            'category.category_slug'            => ['required', 'max:150', Rule::unique(Category::class, 'category_slug')->ignore($category)],
            'categori.category_description'     => 'nullable',
        ]);

        
        $category->fill($request->get('category'))->save();

        Toast::info(__('Kategori berjaya disimpan'));

        return redirect()->route('platform.buku.kategori.list');
    }

    /**
     * @param Category $category
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Category $category)
    {
        $category->delete();

        Toast::info(__('Kategori dihapus'));

        return redirect()->route('platform.buku.kategori.list');
    }
}
