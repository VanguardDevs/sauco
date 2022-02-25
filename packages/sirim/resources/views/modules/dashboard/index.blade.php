@extends('layouts.template')

@section('title', 'Inicio')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <!--begin:: Widgets/Activity-->
        <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-widget17">
                    <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #D4AF37; padding-bottom: 100px">
                        <div class="kt-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <div style="text-align:center; color:aliceblue">
                                <h1>Holi, Alcaldía 👋</h1>
                                <h3>Espero que tengan un excelente día, y disfruten de los carnavales.</h3>
                                <h3>Por mi parte haré lo posible por disfrutar estas fechas, </br>sin olvidar que debo seguir <i>grinding till I get gold, for myself and all of you :)</i></h3>
                                <h3>Anyway, disfruten el tracklist..</h3>
                                </br>
                                <h4>Atte.: <a href="https://twitter.com/jodaz_" target='_blank'>@jodaz_</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget17__stats" style='display: flex; padding-bottom: 2rem; justify-content: space-around; align-items:center;'>
                        <iframe class="video-article" width="400" height="315" src="https://www.youtube.com/embed/46JQ5UbD5m0"></iframe>
                        <iframe class="video-article" width="400" height="315" src="https://www.youtube.com/embed/Vf40xZpNMDw"></iframe>
                        <iframe class="video-article" width="400" height="315" src="https://www.youtube.com/embed/YSbheqbUYS0"></iframe>
                    </div>
                    <p style="text-align:center; color:black">PD.: Mañana cumplo 24, inviten unas 🍺 que mi pinche salario de 24bs no da para nada. Gracias por todo, los quiero.</p>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Activity-->
    </div>
</div>
@endsection
