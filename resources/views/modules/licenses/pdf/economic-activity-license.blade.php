<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->

        <style>
            body {
                background-image: url("{{ asset('assets/images/licenses/economic-activity-license.jpg') }}");
                background-size:   cover;                      /* <------ */
                background-repeat: no-repeat;
                background-position: center center;
            }
            @page {
                size: A4;
                margin: 0;
            }
            @media print {
                html, body {
                    width: 210mm;
                    height: 297mm;
                }
            }
            /* #content {
                height: 100vh;
                width: 100%;
            }
            #img {
                background-image: url("{{ asset('assets/images/licenses/economic-activity-license.jpg') }}");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            } */
        </style>
    </head>

    <body>
        {{-- <div id="content">
            <div id="img"> --}}
                {{-- <div id="correlative">
                    {{ $licenseCorrelative }}
                </div>
                <div id="dates">
                    <div>
                        <p>{{ $license->emission_date }}
                    </div>
                    </div>
                        <p>{{ $endOfYear }}</p>
                    </div>
                </div>

                <div class="taxpayer_info">
                    <div>
                        <p>{{ $licenseNum }}
                    </div>
                    </div>
                        <p>{{ $license->taxpayer->representations->first()->person->name }}</p>
                    </div>
                    </div>
                        <p>{{ $license->taxpayer->fiscal_address }}</p>
                    </div>
                    @foreach ($license->taxpayer->economicActivities as $activity)
                        </div>
                            <p>{{ $activity->code.' - '.$activity->name }}</p>
                        </div>
                    @endforeach
                </div> --}}
            {{-- </div>
        </div> --}}
    </body>
</html>
