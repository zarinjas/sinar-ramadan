<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Facades\Config;

class BukuListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $books = Book::latest()->filters()->paginate(10);
        return [
            'books' => $books
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Buku';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Tambah Buku')
                ->icon('plus')
                ->route('platform.buku.create'),
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
            Layout::table('books', [
                TD::make('id', 'ID')
                ->width('150')
                ->sort()
                ->render(function (Book $book) {
                    $url = Config::get('global.public_image_path') . "no-image-default.jpg";
                    
                    if(!empty($book->book_thumbnail)) {
                        $url = $book->thumbnail->relativeUrl;
                    }

                    return view('admin.orchid-custom.table-image', 
                        [
                            'url' => $url, 
                            'alt' => $book->book_name, 
                            'id' => $book->id
                        ]);
                }),

                TD::make('book_name', 'Tajuk Buku')
                    ->width('300')
                    ->sort(),

                TD::make('book_description', 'Deskripsi')
                    ->render(function (Book $book) {
                        return Str::limit($book->book_description, 200);
                    }),

                TD::make('is_redirect', 'Jenis')
                    ->render(function (Book $book) {
                        return ($book->is_redirect) ? 'Url' : 'Pdf';
                    }),

                TD::make('category_id', 'Category Id')
                    ->render(function (Book $book) {
                        return $book->category->category_name;
                    }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Book $book) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.buku.edit', $book->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $book->id,
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
        $book = Book::findOrFail($request->get('id'));

        $book->delete();

        Toast::info(__('Sumbangan dihapus'));

        return redirect()->route('platform.buku.list');
    }
}
