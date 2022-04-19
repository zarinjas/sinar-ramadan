<?php

namespace App\Orchid\Layouts\Sumbangan;

use Orchid\Screen\Layouts\Chart;

class SumbanganChartBarLayout extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Jumlah Penyumbang';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'penyumbang';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
