<?php

namespace App\Orchid\Screens\Sumbangan;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;
use App\Models\Billplz\CommentByBill;

class DoaPenyumbangListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $comments = CommentByBill::latest()->filters()->paginate(10);
        return [
            'comments' => $comments
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Doa Penyumbang';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('comments',[
                TD::make('id', 'ID')
                ->width(100)
                ->sort()
                ->filter()
                ->render(function (CommentByBill $comment)
                {
                    return "<span class='text-muted'># {$comment->id}</span>"; 
                }),

                TD::make('Daripada')
                ->filter()
                ->render(function (CommentByBill $comment) {
                    if(!$comment->bill->is_anonymous) {
                        return $comment->bill->donator_name;
                    }
                    return "HAMBA ALLAH";
                }),

                TD::make('Tabung')
                ->filter()
                ->render(function (CommentByBill $comment) {
                    if($comment->collection->id) {
                        return $comment->collection->collection_title;
                    }
                }),

                TD::make('Doa')
                ->width(600)
                ->render(function (CommentByBill $comment) {
                    $doa = Str::limit($comment->comment_content, 200);
                    return "<span class='fst-italic'><q>{$doa}</q></span>";
                }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->render(function (CommentByBill $comment) {
                    return DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $comment->id,
                            ])
                    ]);
                })
            ])
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        $comment = CommentByBill::findOrFail($request->get('id'));

        $comment->delete();

        Toast::info(__('Doa Penyumbang dihapus'));

        return redirect()->route('platform.sumbangan.doa-penyumbang.list');
    }
}
