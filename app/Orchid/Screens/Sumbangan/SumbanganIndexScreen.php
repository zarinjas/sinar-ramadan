<?php

namespace App\Orchid\Screens\Sumbangan;

use Carbon\Carbon;
use Orchid\Screen\Screen;
use App\Models\Billplz\Bill;
use App\Models\Billplz\Collection;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Sumbangan\SumbanganChartLayout;
use App\Orchid\Layouts\Sumbangan\SumbanganChartBarLayout;

class SumbanganIndexScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $collections = Collection::all();

        $start = Carbon::now()->subDay(6);
        $end = Carbon::now()->subDay(0);
        $sumbangan = [];

        foreach ($collections as $collection) {
            $sumbangan[] = Bill::where('collection_id', $collection->id)->sumByDays('paid_amount',$start,$end, 'paid_at')->showMinDaysOfWeek()->toChart($collection->collection_title);
        }

        $penyumbang = Bill::countByDays($start, $end, 'paid_at')->showMinDaysOfWeek()->toChart('Penyumbang');
        
        return [
            'penyumbang'      => [$penyumbang],
            'sumbangan'       => $sumbangan
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Sumbangan';
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
            Layout::columns([
                SumbanganChartLayout::class,
                SumbanganChartBarLayout::class
            ]),
        ];
    }
}
