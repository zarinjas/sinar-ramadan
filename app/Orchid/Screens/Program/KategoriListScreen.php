<?php

namespace App\Orchid\Screens\Program;

use Orchid\Screen\TD;
use App\Models\Category;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class KategoriListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $categories = Category::latest()->filters()->paginate(10);

        return [
            'categories'    => $categories
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Kategori';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Kategori')
                ->icon('plus')
                ->route('platform.buku.kategori.create'),
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

            Layout::table('categories', [
                TD::make('id', 'ID')
                    ->width('150')
                    ->render(function (Category $category)
                    {
                        return "<span class='text-muted'># {$category->id}</span>"; 
                    }),


                TD::make('category_name', 'Kategori')
                    ->width('450'),

                TD::make('category_description', 'Deskripsi'),

                TD::make('created_at', 'Masa Terbitan')
                    ->render(function (Category $category) {
                        $date = date_create($category->created_at);
                        $paid_format = date_format($date, "j M Y (g:i A)");
                        return "<span>{$paid_format}</span>";
                    }),

                TD::make()
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Category $category) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                Link::make(__('Edit'))
                                    ->route('platform.buku.kategori.edit', $category->id)
                                    ->icon('pencil'),

                                Button::make(__('Delete'))
                                    ->icon('trash')
                                    ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                    ->method('remove', [
                                        'id' => $category->id,
                                    ]),
                            ]);
                }),
            ]),

        ];
    }

    /**
    * @param Request $request
    */
    public function remove(Request $request)
    {
        $category = Category::findOrFail($request->get('id'));

        $category->delete();

        Toast::info(__('Kategori dihapus'));

        return redirect()->route('platform.buku.kategori.list');
    }
}
