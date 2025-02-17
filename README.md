
# Wrapper for Chart.js v2

Simple package to facilitate and automate the use of charts
using the [Chart.js](http://www.chartjs.org/) v2 library from Nick Downie.

# Setup:
```
composer require bfg/chartjs
```

# Usage:

You can request to Service Container the service responsible for building the charts
and passing through fluent interface the chart settings.

```php
$service = app()->chartjs
    ->name()
    ->type()
    ->size()
    ->labels()
    ->datasets()
    ->options();
```

For now the builder needs the name of the chart, the type of chart that can be anything that is supported by chartjs and the other custom configurations like labels, datasets, size and options.

In the dataset interface you can pass any configuration and option to your chart.
All options available in chartjs documentation are supported.
Just write the configuration with php array notations and its work!

# Advanced ChartJs options

Since the current version allows it to add simple json string based options, it is not possible to generate options like:

```php
    options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    displayFormats: {
                        quarter: 'MMM YYYY'
                    }
                }
            }]
        }
    }
```

Using the method optionsRaw(string) its possible to add a the options in raw format:

Passing string format like a json
```php
        $chart->optionsRaw("{
            legend: {
                display:false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display:false
                    }  
                }]
            }
        }");
```

Or, if you prefer, you can pass a php array format

```php
$chart->optionsRaw([
    'legend' => [
        'display' => true,
        'labels' => [
            'fontColor' => '#000'
        ]
    ],
    'scales' => [
        'xAxes' => [
            [
                'stacked' => true,
                'gridLines' => [
                    'display' => true
                ]
            ]
        ]
    ]
]);
```


# Examples

1 - Line Chart / Radar Chart:
```php
// ExampleController.php

$chartjs = app()->chartjs
        ->name('lineChartTest') // Not required
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->datasets([
            [
                "label" => "My First dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [65, 59, 80, 81, 56, 55, 40],
            ],
            [
                "label" => "My Second dataset",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [12, 33, 44, 44, 55, 23, 40],
            ]
        ])
        ->options([]);

return view('example', compact('chartjs'));


 // Or
 
 $chartjs = app()->chartjs
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
        ->simpleDatasets('My First dataset', [65, 59, 80, 81, 56, 55, 40])
        ->simpleDatasets('My Second dataset', [12, 33, 44, 44, 55, 23, 40]);

 // example.blade.php

<div style="width:75%;">
    {!! $chartjs->render() !!}
</div>
```


2 - Bar Chart:
```php
// ExampleController.php

$chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['Label x', 'Label y'])
         ->datasets([
             [
                 "label" => "My First dataset",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                 'data' => [69, 59]
             ],
             [
                 "label" => "My First dataset",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
                 'data' => [65, 12]
             ]
         ])
         ->options([]);

return view('example', compact('chartjs'));


 // example.blade.php

<div style="width:75%;">
    {!! $chartjs->render() !!}
</div>
```


3 - Pie Chart / Doughnut Chart:
```php
// ExampleController.php

$chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Label x', 'Label y'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [69, 59]
            ]
        ])
        ->options([]);

return view('example', compact('chartjs'));


 // example.blade.php

<div style="width:75%;">
    {!! $chartjs->render() !!}
</div>
```

# License
LaravelChartJs is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
