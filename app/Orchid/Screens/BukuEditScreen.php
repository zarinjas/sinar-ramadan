<?php

namespace App\Orchid\Screens;

use App\Models\Book;
use App\Models\Category;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class BukuEditScreen extends Screen
{
    /**
     * @var Book
     */
    public $book;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Book $book): iterable
    {
        $book->with(['thumbnail', 'pdf']);
        return [
            'book'  => $book,
            'pdf'   => $book->pdf
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->book->exists ? 'Ubah Buku' : 'Tambah Buku';
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
                ->canSee($this->book->exists),

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
                Input::make('book.book_name')
                    ->title('Tajuk')
                    ->required()
                    ->placeholder(__('Tajuk Buku'))
                    ->horizontal(),

                TextArea::make('book.book_description')
                    ->type('text')
                    ->title(__('Deskripsi'))
                    ->placeholder(__('Deskripsi Buku'))
                    ->horizontal(),

                Select::make('book.category_id')
                    ->fromModel(Category::class, 'category_name', 'id')
                    ->empty('Pilih Kategori')
                    ->title(__('Kategori'))
                    ->help('Jika tiada Kategori pilihan. Sila tambah dahulu di Program / Kategori')
                    ->horizontal(),

                CheckBox::make('book.is_redirect')
                    ->sendTrueOrFalse()
                    ->title('Redirect')
                    ->placeholder('Ke Halaman Lain')
                    ->help('Tandakan jika buku di paparkan ke halaman lain')
                    ->horizontal(),
                
                Input::make('book.book_url')
                    ->title('Url')
                    ->placeholder(__('Url Buku'))
                    ->help('Masukkan url jika buku ke halaman lain')
                    ->horizontal(),

                Upload::make('book.book_pdf')
                    ->title('Pdf')
                    ->maxFiles(1)
                    ->acceptedFiles('application/pdf')
                    ->horizontal(),
                
                Picture::make('book.book_thumbnail')
                    ->title(__('Thumbnail'))
                    ->targetId()
                    ->horizontal(),
            ]),

            //TODO Change pdf upload to livewire
            // Layout::view('admin.orchid-custom.pdf-upload'),
        ];
    }

    /**
     * @param Book $book
     * @param Request    $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Book $book, Request $request)
    {
        $request->validate([
            'book.book_name'             => 'required',
            'book.category_id'           => 'required|exists:categories,id',
            'book.book_description'      => 'nullable',
            'book.book_url'              => 'nullable|url'
        ]);

        $book->fill($request->get('book'));
        if(isset($request->book['book_pdf'])) {
            $book->book_pdf = $request->book['book_pdf'][0];
        }
        $book->save();

        $book->attachment()->syncWithoutDetaching(
            $request->input('book.book_thumbnail', [])
        );

        // $book->attachment()->syncWithoutDetaching(
        //     $request->input('pdf.id', [])
        // );

        Toast::info(__('Buku berjaya disimpan'));

        return redirect()->route('platform.buku.list');
    }

    /**
     * @param Book $book
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function remove(Book $book)
    {
        $book->delete();

        Toast::info(__('Buku dihapus'));

        return redirect()->route('platform.buku.list');
    }
}
