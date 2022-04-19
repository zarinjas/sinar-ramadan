<?php

namespace App\Orchid\Screens\Sumbangan;

use Orchid\Screen\TD;
use Orchid\Screen\Screen;
use App\Models\Billplz\Bill;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\DropDown;

class PenyumbangListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $bills = Bill::latest()->filters()->paginate(15);
        return [
            'bills' => $bills
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Semua Penyumbang';
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
            Layout::table('bills',[
                TD::make('id', 'ID')
                ->render(function (Bill $bill)
                {
                    return "<span class='text-muted'># {$bill->id}</span>"; 
                }),

                TD::make('bill_id', 'Resit ID'),

                TD::make('donator_name', 'Penyumbang')
                ->render(function (Bill $bill) {
                    if(!$bill->is_anonymous) {
                        return $bill->donator_name;
                    }
                    return "HAMBA ALLAH";
                }),

                TD::make('Bayaran')
                ->render(function (Bill $bill) {
                    return 'RM ' . $bill->paid_amount;
                }),

                TD::make('Tarikh Bayaran')
                ->render(function (Bill $bill) {
                    $date = date_create($bill->paid_at);
                    $paid_format = date_format($date, "j M Y");
                    return "<span>{$paid_format}</span>";
                }),

                TD::make()
                ->align(TD::ALIGN_CENTER)
                ->render(function (Bill $bill) {
                    return DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $bill->id,
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
        $bill = Bill::findOrFail($request->get('id'));

        $bill->delete();

        Toast::info(__('Penyumbang dihapus'));

        return redirect()->route('platform.sumbangan.penyumbang.list');
    }
}
