# Laravel 5 Booking Calendar
## About
This is the rewritten [Gantt Class](https://github.com/bastianallgeier/gantti) by *bastianallgeier* to fit my needs , e.g. to show multiple events (bookings) per resource, looking 3 months into the past and Laravel 5.7 compatibility.

## Screenshot

![Screenshot](https://raw.githubusercontent.com/ognjenm/reservations-calendar/master/calendar.png)

## Installation

`$ composer require repat/nachofassini-reservations-calendar`

Composer will download the package. After the package is downloaded, open config/app.php and add the service provider and alias as below:

```php
'providers' => array(
    ...
    \Ognjenm\ReservationsCalendar\ReservationsCalendarServiceProvider::class,
),

'aliases' => array(
    ...
    'ResCalendar' => \Ognjenm\ReservationsCalendar\Facades\ResCalendar::class,
),
```

Finally you need to publish a configuration file by running the following Artisan command.

`$ php artisan vendor:publish --tag=public --force`

Include CSS in your view

```html
<link href="{{ asset('vendor/ognjenm/calendar.css') }}" rel="stylesheet" type="text/css">

```

### Examples

#### Prepare data
```php
$data[] = [
    'label' => 'Soba 1',
    'info' => '2+1',
    'class' => 'blue',
    'events' => [
        [
            'label' => 'Ognjen Miletic',
            'tooltip' => '<h5>Potvrdjena rezervacija</h5><br><p>od: 19.06.2015</p><p>do: 23.06.2015</p><p>Ukupno: 578 EUR</p>',
            'url' => 'http://google.com',
            'start' => '2015-06-19',
            'end' => '2015-06-23',
            'class' => '',
            'icon' => 'fa-arrow-down'
        ],
        [
            'label' => 'Madona i ekipa',
            'tooltip' => '<h5>Potvrdjena rezervacija</h5><br><p>od: 19.06.2015</p><p>do: 23.06.2015</p><p>Ukupno: 1578 EUR</p>',
            'start' => '2015-06-10',
            'end' => '2015-06-19',
            'class' => 'checkout',
            'icon' => 'fa-sign-out'
        ],
        [
            'label' => 'Jovan Jovanovic Zmaj',
            'start' => '2015-06-23',
            'end' => '2015-06-30',
            'class' => 'uncomfirmed',
            'icon' => 'fa-question'
        ],
        [
            'label' => 'Nikola Nikolic',
            'tooltip' => '<h5>This is some html</h5>',
            'url' => 'http://google.com',
            'start' => '2015-06-30',
            'end' => '2015-07-15',
            'class' => 'stay'
        ],
    ]
];

```

#### Render Calendar in View
```php
{!! ResCalendar::render($data, ['title' => 'Hotel']) !!}
```
