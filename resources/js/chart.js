import {
    Chart,
    registerables
} from 'chart.js';
Chart.register(...registerables);

//passing data from html data-attributes
var nameKssb = $('#kssbChartData').data('name');
var labelsKssb = $('#kssbChartData').data('labels');
var valuesKssb = $('#kssbChartData').data('values');

var ctx = document.getElementById('kssbChart').getContext('2d');

//
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(255, 99, 132, 1)');
gradient.addColorStop(.68, 'rgba(255, 255, 255, 0)');

const data = {
    labels: labelsKssb,
    datasets: [{
        label: nameKssb,
        backgroundColor: gradient,
        borderColor: 'rgb(255, 99, 132)',
        data: valuesKssb,
        fill: true,
        lineTension: 0.3,
        pointStyle: 'circle',
        pointRadius: 3,
        pointHoverRadius: 4,
        pointHitRadius: 30,
        pointBorderWidth: 2,
        pointBorderColor: 'rgb(255,255,255)'
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
        },
        animations: {
            tension: {

            }
        },
    }
};

const kssbChart = new Chart(
    ctx,
    config
);