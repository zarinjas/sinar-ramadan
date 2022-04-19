<div class="chart-container">
    <canvas id="kssbChart"></canvas>
    @php
        $labels = json_encode($sumbangan['labels']);
        $values = json_encode($sumbangan['values']);
    @endphp
    <div id="kssbChartData" data-name='{{ $sumbangan['name'] }}' data-labels='{{ $labels }}' data-values='{{ $values }}'></div>
</div>