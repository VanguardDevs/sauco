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
                height: 1050px;
                opacity: 1;
                z-index: 1;
            }
            .container {
                position: relative;
                overflow: hidden;
                width: 100%;
                height: 100%;
                z-index: 9;
            }
            .taxpayer-info {
                position: absolute;
                top: 280px; 
                left: 140px;
            }
            .activity {
                font-size: 10px;
                margin-top: 5px;
            }
            .dates {
                position: absolute;
                top: 165px;
                left: 140px;
            }
            .correlative {
                position: absolute;
                font-weight: bold;
                font-size: 30px;
                top: 270px;
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
        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('assets/images/licenses/economic-activity-license.jpg') }}" height="100%" width="100%"/> 
        </div>
        <div class="container">
            <div class="correlative">
                {{ $licenseCorrelative }}
            </div>
            <div class="dates">
                <div class="dates row">{{ $license->emission_date }}</div>
                <div class="dates row endofyear">{{ $endOfYear }}</div>
            <div>
            <div class="taxpayer-info">
                <div class="taxpayer-information row">{{ $num }}</div>
                <div class="taxpayer-information row">{{ $taxpayer->name }}</div>
                <div class="taxpayer-information row">{{ $taxpayer->rif }}</div>
                <div class="taxpayer-information row">{{ $taxpayer->rif }}</div>
                <div class="taxpayer-information row">{{ $representation }}</div>
                <div class="taxpayer-information row">
                   @foreach($taxpayer->economicActivities as $activity)
                        <label class="activity">{{ $activity->code.' - '.$activity->name }}</label>
                   @endforeach 
                </div>
            </div>
        </div>
    </body>
</html>
