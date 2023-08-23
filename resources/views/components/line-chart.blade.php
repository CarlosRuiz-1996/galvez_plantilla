<!-- resources/views/components/line-chart.blade.php -->
@props(['data'])

@php
    $defaultData = [
        'labels' => [],
        'values' => [],
    ];

    $data = array_merge($defaultData, $data);
@endphp

<div class="border rounded shadow p-4">
    <canvas id="lineChart"></canvas>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('lineChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($data['labels']) !!},
                    datasets: [{
                        label: 'Ingresos',
                        data: {!! json_encode($data['values']) !!},
                        backgroundColor: 'rgba(255, 130, 71, 1)',
                        borderColor: 'rgba(61, 0, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

