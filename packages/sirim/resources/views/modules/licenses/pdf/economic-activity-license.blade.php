<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                height: 100%;
                width: 100%;
            }
            #watermark {
                position: fixed;
                bottom: 0px;
                right: 0px;
                width: 720px;
                height: 1030px;
                opacity: 1;
                z-index: 1;
            }
            .container {
                position: relative;
                overflow: hidden;
                width: 100%;
                height: 90%;
                z-index: 9;
            }
            .taxpayer-info {
                position: absolute;
                top: 110px;
                left: 0px;
            }
            .activity {
                font-size: 10px;
                margin-top: 5px;
            }
            .dates-container {
                position: absolute;
                top: 340px;
                left: 280px;
            }
            .correlative {
                position: absolute;
                font-weight: bold;
                font-size: 42px;
                top: 276px;
                left: 360px;
            }
            .row {
                margin-bottom: 0.8em;
            }
            .endofyear {
                top: 195px;
            }
           body {
                font-family: sans-serif, serif;
            }
            li {
                list-style-type: none;
            }
        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('/assets/images/licenses/licencia.jpg') }}" height="100%" width="100%"/>
        </div>
        <div class="container">
            <div class="correlative">
                {{ $licenseCorrelative }}
            </div>
            <div class="dates-container">
                <div class="dates row">{{ $license->emission_date }}</div>
                <div class="dates row endofyear">{{ $license->expiration_date }}</div>
            <div>
            <div class="taxpayer-info">
                <div class="taxpayer-information row">{{ $num }}</div>
                <div class="taxpayer-information row">{{ $taxpayer->name }}</div>
                <div class="taxpayer-information row">{{ $taxpayer->rif }}</div>
                <div class="taxpayer-information row">{{ $representation }}</div>
                <div class="taxpayer-information row">{{ $taxpayer->fiscal_address }}</div>
                <div class="taxpayer-information row">
                   @foreach($license->economicActivities as $activity)
                        <li class="activity">{{ $activity->code.' - '.$activity->name }}</li>
                   @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
